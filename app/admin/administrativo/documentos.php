<?php
/**
 * app/admin/administrativo/documentos.php
 * Gestor Documental - Administración de archivos adjuntos
 *
 * Funcionalidades:
 * - Listado global de todos los documentos con paginación
 * - Filtros por crédito, rango de fechas y tipo de archivo
 * - KPIs: total documentos, distribución por tipo
 * - Subida de documentos (drag & drop / selector)
 * - Descarga y eliminación de documentos
 * - Vista previa de imágenes
 *
 * Tablas principales:
 * - tbl15_archivo_adjunto
 * - tbl15_info_factura_venta
 *
 * Dependencias:
 * - dayq_archivo_service.php
 * - dayq_utilidades.php
 *
 * @see changelog/CAMBIOS_20260724.md
 */
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/includes/dayq_db_service.php';
require_once __DIR__ . '/includes/dayq_archivo_service.php';
require_once __DIR__ . '/includes/dayq_utilidades.php';

$db_service = new DayqDbService($conectar);
$archivo_service = new DayqArchivoService($conectar);

// ─── AJAX: Buscador de créditos (modal Subir Documento) ───
$ajax = dayq_get_str('ajax', '');
if ($ajax === 'buscar_creditos') {
    header('Content-Type: application/json; charset=UTF-8');
    $termino = dayq_get_str('q', '');
    $items = $db_service->buscarCreditosParaSelector($termino, 15);
    echo json_encode(['success' => true, 'items' => $items]);
    exit;
}

$pagina = dayq_get_int('page', 1);
$fecha_desde = dayq_get_str('fecha_desde', '');
$fecha_hasta = dayq_get_str('fecha_hasta', '');
$tipo_filtro = dayq_get_str('tipo', '');
$buscar = dayq_get_str('buscar', '');
$cod_credito = dayq_get_int('cod_credito', 0);
$accion = dayq_get_str('accion', '');

// ─── Descargar archivo / Vista previa ───
if ($accion === 'descargar') {
    $cod_archivo = dayq_get_int('id', 0);
    $es_preview = dayq_get_str('preview', '') === '1';
    if ($cod_archivo > 0) {
        $archivo_service = new DayqArchivoService($conectar);
        $ruta_fisica = $archivo_service->obtenerRutaArchivo($cod_archivo);
        $doc = $archivo_service->getDocumento($cod_archivo);
        if ($ruta_fisica && file_exists($ruta_fisica) && $doc) {
            if ($es_preview) {
                $ext = strtolower(pathinfo($doc['nombre_archivo_adjunto'], PATHINFO_EXTENSION));
                $mime_types = array(
                    'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png', 'gif' => 'image/gif',
                    'webp' => 'image/webp', 'bmp' => 'image/bmp',
                    'pdf' => 'application/pdf',
                );
                $content_type = isset($mime_types[$ext]) ? $mime_types[$ext] : 'application/octet-stream';
                header('Content-Type: ' . $content_type);
                header('Content-Length: ' . filesize($ruta_fisica));
                header('Cache-Control: public, max-age=3600');
                readfile($ruta_fisica);
            } else {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $doc['nombre_archivo_adjunto'] . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($ruta_fisica));
                readfile($ruta_fisica);
            }
            exit;
        }
    }
    header('Location: ?m=documentos&err=' . rawurlencode('Archivo no encontrado'));
    exit;
}

// ─── Subir archivo (POST) ───
$subir_msg = '';
$subir_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && dayq_post('action') === 'subir_archivo') {
    $cod_credito_subida = (int) dayq_post('cod_info_factura_venta');
    $tipo_doc = dayq_post('tipo_documento', 'Documento');

    if ($cod_credito_subida <= 0) {
        $subir_err = 'Debe seleccionar un crédito';
    } elseif (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        $subir_err = 'Error al subir el archivo. Código: ' . (isset($_FILES['archivo']['error']) ? $_FILES['archivo']['error'] : 'desconocido');
    } else {
        $resultado = $archivo_service->guardarArchivoCredito(
            $cod_credito_subida,
            $_FILES['archivo']['tmp_name'],
            $_FILES['archivo']['name'],
            $tipo_doc
        );
        if ($resultado['exito']) {
            $subir_msg = 'Archivo subido correctamente';
        } else {
            $subir_err = $resultado['error'];
        }
    }
}

// ─── Eliminar archivo (POST) ───
if ($_SERVER['REQUEST_METHOD'] === 'POST' && dayq_post('action') === 'eliminar_archivo') {
    $cod_archivo_elim = (int) dayq_post('cod_archivo');
    if ($cod_archivo_elim > 0) {
        if ($archivo_service->eliminarArchivo($cod_archivo_elim)) {
            $subir_msg = 'Archivo eliminado correctamente';
        } else {
            $subir_err = 'Error al eliminar el archivo';
        }
    }
}

// ─── Construir filtros ───
$filtros = [];
if ($cod_credito > 0) $filtros['cod_info_factura_venta'] = $cod_credito;
if ($fecha_desde) $filtros['fecha_desde'] = $fecha_desde;
if ($fecha_hasta) $filtros['fecha_hasta'] = $fecha_hasta;
if ($tipo_filtro) $filtros['tipo_archivo'] = $tipo_filtro;
if ($buscar) $filtros['buscar'] = $buscar;

// ─── Datos ───
$por_pagina = 15;
$total_docs = $archivo_service->totalDocumentos($filtros);
$total_paginas = $total_docs > 0 ? (int) ceil($total_docs / $por_pagina) : 1;
$pagina = min($pagina, max($total_paginas, 1));
$documentos = $archivo_service->listarDocumentos($pagina, $por_pagina, $filtros);

// Tipos de archivo para el filtro
$tipos_archivo = $archivo_service->getTiposArchivo();

// KPIs
$todos_docs = $archivo_service->totalDocumentos();
$r_tipos = $conectar->query("SELECT nombre_tipo_extencion_archivo, COUNT(*) AS cnt 
    FROM tbl15_archivo_adjunto GROUP BY nombre_tipo_extencion_archivo ORDER BY cnt DESC LIMIT 5");
$distribucion_tipos = [];
if ($r_tipos) {
    while ($row = $r_tipos->fetch_assoc()) {
        $distribucion_tipos[] = $row;
    }
}

$dayq_page_title = 'Gestor Documental';
include __DIR__ . '/layout_header.php';
?>

<div class="dayq-container">
    <div class="dayq-topbar">
        <h1 class="dayq-topbar-title"><i class="fa-solid fa-folder-open"></i> Gestor Documental</h1>
        <button class="dayq-help-btn" onclick="showModuleGuide('documentos')" title="Guía del gestor documental"><i class="fa-solid fa-circle-question"></i></button>
        <div class="dayq-topbar-actions" style="flex-wrap: wrap; gap: 6px;">
            <input type="text" id="buscar" placeholder="Buscar archivo o crédito..." value="<?php echo htmlspecialchars($buscar); ?>"
                style="padding: 8px 12px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; min-width: 160px;">
            <input type="number" id="cod_credito" placeholder="ID Crédito..." value="<?php echo $cod_credito > 0 ? $cod_credito : ''; ?>"
                style="padding: 8px 12px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px; width: 110px;">
            <input type="date" id="fecha_desde" value="<?php echo $fecha_desde; ?>"
                style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
            <input type="date" id="fecha_hasta" value="<?php echo $fecha_hasta; ?>"
                style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
            <select id="tipo_filtro" style="padding: 8px; background: var(--card2); border: 1px solid var(--border); border-radius: 6px; color: var(--text); font-size: 12px;">
                <option value="">Todos los tipos</option>
                <?php foreach ($tipos_archivo as $ta): ?>
                    <option value="<?php echo htmlspecialchars($ta); ?>" <?php echo $tipo_filtro === $ta ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($ta); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="dayq-btn dayq-btn-primary" onclick="buscarDocumentos()"><i class="fa-solid fa-search"></i> Filtrar</button>
            <button class="dayq-btn" style="background: var(--accent); color: white;" onclick="abrirModalSubir()">
                <i class="fa-solid fa-upload"></i> Subir
            </button>
        </div>
    </div>

    <?php if ($subir_msg): ?>
        <div class="dayq-msg dayq-msg-success" style="margin-bottom: 12px; padding: 10px 14px; background: rgba(0, 200, 150, 0.12); border: 1px solid rgba(0, 200, 150, 0.25); border-radius: 6px; color: var(--green); font-size: 12px;">
            <i class="fa-solid fa-check-circle"></i> <?php echo htmlspecialchars($subir_msg); ?>
        </div>
    <?php endif; ?>
    <?php if ($subir_err): ?>
        <div class="dayq-msg dayq-msg-error" style="margin-bottom: 12px; padding: 10px 14px; background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.25); border-radius: 6px; color: var(--red); font-size: 12px;">
            <i class="fa-solid fa-exclamation-circle"></i> <?php echo htmlspecialchars($subir_err); ?>
        </div>
    <?php endif; ?>

    <!-- KPIs -->
    <div class="kpi-grid" style="margin-bottom: 24px;">
        <div class="kpi-card">
            <div class="kpi-label"><i class="fa-solid fa-file"></i> Total Documentos</div>
            <div class="kpi-value" style="color: var(--accent);"><?php echo number_format($todos_docs); ?></div>
            <div class="kpi-sub">En el sistema</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-label"><i class="fa-solid fa-filter"></i> Resultados</div>
            <div class="kpi-value" style="color: var(--green);"><?php echo number_format($total_docs); ?></div>
            <div class="kpi-sub">Con filtros actuales</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-label"><i class="fa-solid fa-image"></i> Tipo Principal</div>
            <div class="kpi-value" style="color: var(--yellow); font-size: 14px;">
                <?php echo isset($distribucion_tipos[0]) ? htmlspecialchars($distribucion_tipos[0]['nombre_tipo_extencion_archivo']) : '—'; ?>
            </div>
            <div class="kpi-sub"><?php echo isset($distribucion_tipos[0]) ? $distribucion_tipos[0]['cnt'] . ' archivos' : ''; ?></div>
        </div>
        <div class="kpi-card">
            <div class="kpi-label"><i class="fa-solid fa-credit-card"></i> Créditos con Docs</div>
            <div class="kpi-value" style="color: var(--purple);">
                <?php
                $r_cred_con_docs = $conectar->query("SELECT COUNT(DISTINCT cod_info_factura_venta) AS total FROM tbl15_archivo_adjunto WHERE cod_info_factura_venta IS NOT NULL");
                echo $r_cred_con_docs ? number_format((int)$r_cred_con_docs->fetch_assoc()['total']) : '0';
                ?>
            </div>
            <div class="kpi-sub">Con al menos 1 adjunto</div>
        </div>
    </div>

    <!-- Tabla de documentos -->
    <div class="dayq-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
            <h3 class="dayq-section-title" style="margin-bottom: 0;"><i class="fa-solid fa-list"></i> Documentos</h3>
            <span style="font-size: 11px; color: var(--text3);">
                <?php if ($total_docs > 0): ?>
                    Mostrando <?php echo (($pagina - 1) * $por_pagina) + 1; ?>–<?php echo min($pagina * $por_pagina, $total_docs); ?> de <?php echo number_format($total_docs); ?>
                <?php endif; ?>
            </span>
        </div>

        <div class="dayq-table-wrap">
            <table class="dayq-table" id="tabla-documentos">
                <thead>
                    <tr>
                        <th style="width: 40px;">ID</th>
                        <th>Archivo</th>
                        <th>Tipo</th>
                        <th>Crédito</th>
                        <th>Cliente</th>
                        <th>Línea</th>
                        <th style="width: 100px;">Fecha</th>
                        <th style="width: 100px; text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($documentos) > 0): ?>
                        <?php foreach ($documentos as $doc): 
                            $ext = strtolower(pathinfo($doc['nombre_archivo_adjunto'], PATHINFO_EXTENSION));
                            $es_imagen = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp']);
                            $icono = $es_imagen ? 'fa-solid fa-file-image' : (in_array($ext, ['pdf']) ? 'fa-solid fa-file-pdf' : 'fa-solid fa-file');
                            $color_icono = $es_imagen ? '#4f8ef7' : (in_array($ext, ['pdf']) ? '#ef4444' : '#64748b');
                        ?>
                        <tr>
                            <td style="color: var(--text3); font-size: 11px;">#<?php echo $doc['cod_archivo_adjunto']; ?></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <i class="<?php echo $icono; ?>" style="color: <?php echo $color_icono; ?>; font-size: 16px;"></i>
                                    <div>
                                        <div style="font-weight: 600; font-size: 12px; max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo htmlspecialchars($doc['nombre_archivo_adjunto']); ?>
                                        </div>
                                        <?php if ($es_imagen): ?>
                                            <a href="#" onclick="vistaPrevia(event, <?php echo $doc['cod_archivo_adjunto']; ?>)" style="font-size: 10px; color: var(--accent); text-decoration: none;">
                                                <i class="fa-solid fa-eye"></i> Vista previa
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="chip" style="font-size: 10px;">
                                    <?php echo htmlspecialchars(isset($doc['tipo_archivo']) ? $doc['tipo_archivo'] : 'Documento'); ?>
                                </span>
                            </td>
                            <td>
                                <a href="?m=credito_detalle&id=<?php echo $doc['cod_info_factura_venta']; ?>" style="color: var(--accent); font-size: 12px; text-decoration: none;">
                                    #<?php echo (int)$doc['cod_info_factura_venta']; ?><?php if (!empty($doc['cod_factura']) && $doc['cod_factura'] !== '0'): ?> <small style="color: var(--text3); font-weight: 400;">/ F:<?php echo htmlspecialchars($doc['cod_factura']); ?></small><?php endif; ?>
                                </a>
                            </td>
                            <td style="font-size: 11px; color: var(--text);">
                                <?php echo htmlspecialchars(isset($doc['cliente']) ? $doc['cliente'] : '-'); ?>
                            </td>
                            <td style="font-size: 11px; color: var(--text2);">
                                <?php echo htmlspecialchars(isset($doc['linea']) ? $doc['linea'] : '-'); ?>
                            </td>
                            <td style="font-size: 11px; color: var(--text3);">
                                <?php echo dayq_formato_fecha_hora($doc['fecha_creacion']); ?>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 4px; justify-content: center;">
                                    <a href="?m=documentos&accion=descargar&id=<?php echo $doc['cod_archivo_adjunto']; ?>" 
                                       class="dayq-btn" style="padding: 4px 8px; font-size: 10px;" title="Descargar">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <button class="dayq-btn" style="padding: 4px 8px; font-size: 10px; color: var(--red);"
                                        onclick="confirmarEliminar(<?php echo $doc['cod_archivo_adjunto']; ?>, '<?php echo htmlspecialchars(addslashes($doc['nombre_archivo_adjunto']), ENT_QUOTES); ?>')"
                                        title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px; color: var(--text3);">
                                <i class="fa-solid fa-folder-open" style="font-size: 28px; display: block; margin-bottom: 8px; opacity: 0.4;"></i>
                                No hay documentos<?php echo $total_docs > 0 ? ' con los filtros actuales' : ' registrados'; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <?php if ($total_paginas > 1): ?>
            <div class="dayq-pagination" style="margin-top: 12px;">
                <?php if ($pagina > 1): ?>
                    <a href="?m=documentos&page=1&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>&tipo=<?php echo urlencode($tipo_filtro); ?>&cod_credito=<?php echo $cod_credito; ?>">&laquo;</a>
                    <a href="?m=documentos&page=<?php echo $pagina - 1; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>&tipo=<?php echo urlencode($tipo_filtro); ?>&cod_credito=<?php echo $cod_credito; ?>">&lsaquo;</a>
                <?php endif; ?>
                <?php $inicio = max(1, $pagina - 2); $fin = min($total_paginas, $pagina + 2); ?>
                <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                    <?php if ($i === $pagina): ?>
                        <span class="active"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?m=documentos&page=<?php echo $i; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>&tipo=<?php echo urlencode($tipo_filtro); ?>&cod_credito=<?php echo $cod_credito; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if ($pagina < $total_paginas): ?>
                    <a href="?m=documentos&page=<?php echo $pagina + 1; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>&tipo=<?php echo urlencode($tipo_filtro); ?>&cod_credito=<?php echo $cod_credito; ?>">&rsaquo;</a>
                    <a href="?m=documentos&page=<?php echo $total_paginas; ?>&buscar=<?php echo urlencode($buscar); ?>&fecha_desde=<?php echo urlencode($fecha_desde); ?>&fecha_hasta=<?php echo urlencode($fecha_hasta); ?>&tipo=<?php echo urlencode($tipo_filtro); ?>&cod_credito=<?php echo $cod_credito; ?>">&raquo;</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Gráfica de distribución por tipo -->
    <?php if (count($distribucion_tipos) > 0): ?>
    <div class="dayq-section" style="margin-top: 16px;">
        <h3 class="dayq-section-title"><i class="fa-solid fa-chart-pie"></i> Distribución por Tipo de Archivo</h3>
        <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
            <svg width="120" height="120" viewBox="0 0 120 120">
                <?php
                $circ = 2 * M_PI * 45;
                $offset_donut = 0;
                $colores = ['#4f8ef7', '#00c896', '#f7c948', '#ff8c42', '#6c5ce7', '#a78bfa', '#ef4444'];
                $di = 0;
                foreach ($distribucion_tipos as $dt):
                    $pct = $todos_docs > 0 ? (int)$dt['cnt'] / $todos_docs : 0;
                    $dash = $pct * $circ;
                    $color = $colores[$di % count($colores)];
                ?>
                <circle cx="60" cy="60" r="45" fill="none" stroke="<?php echo $color; ?>" stroke-width="16"
                    stroke-dasharray="<?php echo round($dash, 1); ?> <?php echo round($circ - $dash, 1); ?>"
                    stroke-dashoffset="-<?php echo round($offset_donut, 1); ?>" transform="rotate(-90 60 60)"/>
                <?php
                    $offset_donut += $dash;
                    $di++;
                endforeach;
                ?>
                <text x="60" y="64" text-anchor="middle" fill="var(--text)" font-size="12" font-weight="700" font-family="DM Mono, monospace">
                    <?php echo $todos_docs; ?>
                </text>
            </svg>
            <div style="flex: 1; min-width: 200px;">
                <?php
                $di = 0;
                foreach ($distribucion_tipos as $dt):
                    $pct = $todos_docs > 0 ? round(((int)$dt['cnt'] / $todos_docs) * 100, 1) : 0;
                    $color = $colores[$di % count($colores)];
                ?>
                <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 5px; font-size: 11px;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: <?php echo $color; ?>; flex-shrink: 0;"></span>
                    <span style="flex: 1; color: var(--text2);"><?php echo htmlspecialchars($dt['nombre_tipo_extencion_archivo']); ?></span>
                    <span style="font-weight: 700;"><?php echo $dt['cnt']; ?></span>
                    <span style="color: var(--text3); font-size: 10px;">(<?php echo $pct; ?>%)</span>
                </div>
                <?php $di++; endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Subir Documento -->
<div id="modalSubir" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.55); z-index: 1000; align-items: center; justify-content: center;" onclick="cerrarModalSubir(event)">
    <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 0; width: 480px; max-width: 94%; box-shadow: 0 20px 60px rgba(0,0,0,0.4);" onclick="event.stopPropagation()">
        <div style="display: flex; align-items: center; gap: 10px; padding: 16px 20px; border-bottom: 1px solid var(--border);">
            <div style="width: 34px; height: 34px; border-radius: 10px; background: rgba(79,142,247,0.15); display: flex; align-items: center; justify-content: center; font-size: 16px; color: var(--accent);">
                <i class="fa-solid fa-upload"></i>
            </div>
            <div>
                <h3 style="margin: 0; font-size: 14px; font-weight: 700;">Subir Documento</h3>
                <p style="margin: 1px 0 0; font-size: 11px; color: var(--text3);">Adjunta un archivo a un crédito</p>
            </div>
            <button type="button" onclick="document.getElementById('modalSubir').style.display='none'" style="margin-left: auto; background: transparent; border: none; color: var(--text3); cursor: pointer; font-size: 18px; padding: 4px;" title="Cerrar"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form method="post" action="?m=documentos" enctype="multipart/form-data" style="padding: 20px;" onsubmit="return validarFormSubir()">
            <input type="hidden" name="action" value="subir_archivo">
            <div style="display: grid; gap: 14px;">
                <div>
                    <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px; font-weight: 600;">Buscar Crédito *</label>
                    <div style="position: relative;">
                        <input type="text" id="buscador_credito" autocomplete="off"
                            placeholder="Buscar por ID, factura, cliente o comercio..."
                            style="width: 100%; padding: 10px 36px 10px 14px; background: var(--card2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 13px;"
                            oninput="buscarCreditosInput()" onfocus="buscarCreditosInput()">
                        <i class="fa-solid fa-magnifying-glass" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--text3); font-size: 13px; pointer-events: none;"></i>
                        <div id="resultados_credito" style="display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; background: var(--card); border: 1px solid var(--border); border-radius: 8px; max-height: 240px; overflow-y: auto; z-index: 50; box-shadow: 0 12px 40px rgba(0,0,0,0.4);"></div>
                    </div>
                    <input type="hidden" name="cod_info_factura_venta" id="cod_info_factura_venta_hidden" value="">
                    <div id="credito_seleccionado" style="display: none; margin-top: 8px; padding: 8px 12px; background: rgba(79,142,247,0.08); border: 1px solid rgba(79,142,247,0.25); border-radius: 8px; font-size: 11px; color: var(--text);"></div>
                    <div id="error_credito" style="display: none; margin-top: 6px; font-size: 11px; color: var(--red);">
                        <i class="fa-solid fa-circle-exclamation"></i> Debe seleccionar un crédito de la lista antes de subir el archivo.
                    </div>
                </div>
                <div>
                    <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px; font-weight: 600;">Tipo de Documento</label>
                    <select name="tipo_documento"
                        style="width: 100%; padding: 10px 14px; background: var(--card2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 13px;">
                        <option value="Documento">Documento</option>
                        <option value="Soporte">Soporte</option>
                        <option value="Factura">Factura</option>
                        <option value="Voucher">Voucher</option>
                        <option value="Identificación">Identificación</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 11px; color: var(--text3); margin-bottom: 4px; font-weight: 600;">Archivo *</label>
                    <div id="dropzone" style="border: 2px dashed var(--border); border-radius: 8px; padding: 24px; text-align: center; cursor: pointer; transition: all 0.2s; background: var(--card2);"
                        onclick="document.getElementById('fileInput').click()">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size: 28px; color: var(--accent); display: block; margin-bottom: 6px;"></i>
                        <p style="margin: 0; font-size: 12px; color: var(--text2);">Haz clic para seleccionar o arrastra un archivo aquí</p>
                        <p id="file-name" style="margin: 4px 0 0; font-size: 11px; color: var(--green); display: none;"></p>
                    </div>
                    <input type="file" name="archivo" id="fileInput" required style="display: none;" onchange="mostrarNombreArchivo(this)">
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 18px; padding-top: 16px; border-top: 1px solid var(--border);">
                <button type="button" class="dayq-btn" onclick="document.getElementById('modalSubir').style.display='none'">Cancelar</button>
                <button type="submit" class="dayq-btn dayq-btn-primary" style="background: var(--accent); color: white;">
                    <i class="fa-solid fa-upload"></i> Subir Archivo
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Vista Previa -->
<div id="modalVistaPrevia" class="dayq-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1100; align-items: center; justify-content: center;" onclick="cerrarVistaPrevia(event)">
    <div style="max-width: 90%; max-height: 90%;" onclick="event.stopPropagation()">
        <button style="position: absolute; top: 16px; right: 16px; background: rgba(0,0,0,0.4); border: none; color: white; font-size: 24px; cursor: pointer; width: 40px; height: 40px; border-radius: 50%;" onclick="document.getElementById('modalVistaPrevia').style.display='none'">&times;</button>
        <img id="imgVistaPrevia" src="" alt="Vista previa" style="max-width: 100%; max-height: 90vh; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.5);">
    </div>
</div>

<!-- Formulario oculto para eliminar -->
<form id="formEliminar" method="post" action="?m=documentos" style="display: none;">
    <input type="hidden" name="action" value="eliminar_archivo">
    <input type="hidden" name="cod_archivo" id="eliminar_cod_archivo" value="">
</form>

<style>
.detail-table {
    width: 100%;
    border-collapse: collapse;
}
.detail-table td {
    padding: 7px 0;
    border-bottom: 1px solid rgba(42,51,80,0.4);
    font-size: 12px;
}
.detail-table tr:last-child td {
    border-bottom: none;
}
.detail-label {
    color: var(--text3);
    width: 40%;
}
.detail-val {
    font-weight: 600;
    color: var(--text);
    text-align: right;
}
#dropzone:hover {
    border-color: var(--accent);
    background: rgba(79,142,247,0.05);
}
#dropzone.dragover {
    border-color: var(--accent);
    background: rgba(79,142,247,0.1);
}
</style>

<script>
function buscarDocumentos() {
    const buscar = document.getElementById('buscar').value;
    const desde = document.getElementById('fecha_desde').value;
    const hasta = document.getElementById('fecha_hasta').value;
    const tipo = document.getElementById('tipo_filtro').value;
    const codCredito = document.getElementById('cod_credito').value;
    let url = '?m=documentos';
    if (buscar) url += '&buscar=' + encodeURIComponent(buscar);
    if (desde) url += '&fecha_desde=' + desde;
    if (hasta) url += '&fecha_hasta=' + hasta;
    if (tipo) url += '&tipo=' + encodeURIComponent(tipo);
    if (codCredito) url += '&cod_credito=' + encodeURIComponent(codCredito);
    window.location.href = url;
}

function abrirModalSubir() {
    // Reset del buscador de crédito cada vez que se abre el modal
    if (typeof limpiarSeleccionCredito === 'function') limpiarSeleccionCredito();
    document.getElementById('modalSubir').style.display = 'flex';
}

function cerrarModalSubir(e) {
    if (e && e.target !== e.currentTarget) return;
    document.getElementById('modalSubir').style.display = 'none';
}

function mostrarNombreArchivo(input) {
    const nameEl = document.getElementById('file-name');
    if (input.files && input.files.length > 0) {
        nameEl.textContent = '✓ ' + input.files[0].name;
        nameEl.style.display = 'block';
    } else {
        nameEl.style.display = 'none';
    }
}

function confirmarEliminar(id, nombre) {
    if (confirm('¿Eliminar el archivo "' + nombre + '"?\nEsta acción no se puede deshacer.')) {
        document.getElementById('eliminar_cod_archivo').value = id;
        document.getElementById('formEliminar').submit();
    }
}

function vistaPrevia(event, id) {
    event.preventDefault();
    // Construir URL de descarga temporal para vista previa
    var img = document.getElementById('imgVistaPrevia');
    img.src = '?m=documentos&accion=descargar&id=' + id + '&preview=1&t=' + Date.now();
    document.getElementById('modalVistaPrevia').style.display = 'flex';
}

function cerrarVistaPrevia(e) {
    if (e.target === e.currentTarget) {
        document.getElementById('modalVistaPrevia').style.display = 'none';
    }
}

// ═══ Buscador de crédito (autocomplete) ═══
var _timerBusqueda = null;
var _resultadosActuales = [];
var _indiceSeleccionado = -1;

function escHtml(s) {
    var div = document.createElement('div');
    div.textContent = s == null ? '' : String(s);
    return div.innerHTML;
}

function fmtMoneda(n) {
    n = parseFloat(n) || 0;
    return '$' + n.toLocaleString('es-CO', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function buscarCreditosInput() {
    var input = document.getElementById('buscador_credito');
    var q = (input.value || '').trim();
    var cont = document.getElementById('resultados_credito');

    // Si ya había un crédito seleccionado y el usuario reescribe, se limpia la selección
    if (document.getElementById('cod_info_factura_venta_hidden').value) {
        limpiarSeleccionCredito();
    }

    document.getElementById('error_credito').style.display = 'none';
    clearTimeout(_timerBusqueda);
    if (q.length < 2) {
        cont.style.display = 'none';
        return;
    }
    _timerBusqueda = setTimeout(function() {
        var terminoBusqueda = q;
        fetch('?m=documentos&ajax=buscar_creditos&q=' + encodeURIComponent(q))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                // Ignorar respuestas obsoletas si el usuario siguió escribiendo
                if (terminoBusqueda !== (document.getElementById('buscador_credito').value || '').trim()) {
                    return;
                }
                if (!data || !data.success) { cont.style.display = 'none'; return; }
                _resultadosActuales = data.items || [];
                _indiceSeleccionado = -1;
                if (!_resultadosActuales.length) {
                    cont.innerHTML = '<div style="padding:10px 14px; color: var(--text3); font-size: 12px;">Sin resultados para "' + escHtml(q) + '"</div>';
                    cont.style.display = 'block';
                    return;
                }
                var html = '';
                for (var i = 0; i < _resultadosActuales.length; i++) {
                    var it = _resultadosActuales[i];
                    var codF = (it.cod_factura && it.cod_factura !== '0') ? ' · F:' + escHtml(it.cod_factura) : '';
                    html += '<div class="credito-opcion" data-idx="' + i + '" style="padding:9px 12px; cursor:pointer; border-bottom: 1px solid var(--border); display:flex; align-items:center; gap:10px;" onmouseenter="resaltarOpcion(' + i + ')">';
                    html += '<div style="flex:1; min-width:0;">';
                    html += '<div style="font-size:12px; font-weight:700; color: var(--accent);">#' + escHtml(it.cod_info_factura_venta) + '<span style="color:var(--text3); font-weight:400; font-size:11px;">' + codF + '</span></div>';
                    html += '<div style="font-size:11px; color: var(--text); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">' + escHtml(it.cliente || '-') + (it.comercio ? ' <span style="color:var(--text3);">· ' + escHtml(it.comercio) + '</span>' : '') + '</div>';
                    html += '</div>';
                    html += '<div style="text-align:right; flex-shrink:0;">';
                    html += '<div style="font-size:11px; font-weight:700;">' + fmtMoneda(it.valor) + '</div>';
                    html += '<span class="badge badge-info" style="font-size:9px;">' + escHtml(it.nombre_estado_factura || '-') + '</span>';
                    html += '</div>';
                    html += '</div>';
                }
                cont.innerHTML = html;
                cont.style.display = 'block';
                // Bind directo: el contenedor del modal hace event.stopPropagation(),
                // por lo que la delegación en document nunca recibe el clic.
                var opcionesRender = cont.querySelectorAll('.credito-opcion');
                for (var j = 0; j < opcionesRender.length; j++) {
                    (function(el, idx) {
                        el.addEventListener('click', function(ev) {
                            ev.preventDefault();
                            ev.stopPropagation();
                            if (_resultadosActuales[idx]) seleccionarCredito(_resultadosActuales[idx]);
                        });
                    })(opcionesRender[j], j);
                }
            })
            .catch(function() { cont.style.display = 'none'; });
    }, 250);
}

function resaltarOpcion(idx) {
    _indiceSeleccionado = idx;
    var opciones = document.querySelectorAll('#resultados_credito .credito-opcion');
    for (var i = 0; i < opciones.length; i++) {
        opciones[i].style.background = (i === idx) ? 'rgba(79,142,247,0.12)' : 'transparent';
    }
}

function seleccionarCredito(item) {
    document.getElementById('cod_info_factura_venta_hidden').value = item.cod_info_factura_venta;
    var codF = (item.cod_factura && item.cod_factura !== '0') ? ' · F:' + escHtml(item.cod_factura) : '';
    var chip = document.getElementById('credito_seleccionado');
    chip.innerHTML = '<i class="fa-solid fa-circle-check" style="color: var(--green);"></i> ' +
        '<strong>Crédito #' + escHtml(item.cod_info_factura_venta) + '</strong>' + codF +
        ' · ' + escHtml(item.cliente || '-') +
        ' · <span class="badge badge-info" style="font-size:9px;">' + escHtml(item.nombre_estado_factura || '-') + '</span>' +
        ' <button type="button" onclick="limpiarSeleccionCredito()" style="margin-left:6px; background:none; border:none; color:var(--red); cursor:pointer; font-size:12px;" title="Quitar"><i class="fa-solid fa-xmark"></i></button>';
    chip.style.display = 'block';
    document.getElementById('resultados_credito').style.display = 'none';
    document.getElementById('buscador_credito').value = '';
    document.getElementById('buscador_credito').setAttribute('readonly', 'readonly');
    document.getElementById('error_credito').style.display = 'none';
}

function limpiarSeleccionCredito() {
    document.getElementById('cod_info_factura_venta_hidden').value = '';
    document.getElementById('credito_seleccionado').style.display = 'none';
    document.getElementById('credito_seleccionado').innerHTML = '';
    var input = document.getElementById('buscador_credito');
    input.value = '';
    input.removeAttribute('readonly');
    input.focus();
}

function validarFormSubir() {
    var cod = document.getElementById('cod_info_factura_venta_hidden').value;
    if (!cod) {
        document.getElementById('error_credito').style.display = 'block';
        var input = document.getElementById('buscador_credito');
        input.removeAttribute('readonly');
        input.focus();
        return false;
    }
    return true;
}

// Cerrar resultados al hacer clic fuera del buscador (a nivel documento)
document.addEventListener('click', function(e) {
    var cont = document.getElementById('resultados_credito');
    var input = document.getElementById('buscador_credito');
    if (cont && cont.style.display === 'block' && input && !input.contains(e.target) && !cont.contains(e.target)) {
        cont.style.display = 'none';
    }
});

// Cerrar resultados al hacer clic dentro del modal pero fuera del buscador
// (el contenedor del modal hace stopPropagation, así que el listener de document no lo ve)
document.addEventListener('DOMContentLoaded', function() {
    var modalCard = document.querySelector('#modalSubir > div');
    var input = document.getElementById('buscador_credito');
    var cont = document.getElementById('resultados_credito');
    var chip = document.getElementById('credito_seleccionado');
    if (modalCard && input && cont) {
        modalCard.addEventListener('click', function(e) {
            if (cont.style.display === 'block' &&
                !input.contains(e.target) &&
                !cont.contains(e.target) &&
                !(chip && chip.contains(e.target))) {
                cont.style.display = 'none';
            }
        });
    }
});

// Navegación con teclado (flechas + Enter)
document.addEventListener('DOMContentLoaded', function() {
    var input = document.getElementById('buscador_credito');
    if (!input) return;
    input.addEventListener('keydown', function(e) {
        var cont = document.getElementById('resultados_credito');
        if (cont.style.display !== 'block' || !_resultadosActuales.length) return;
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            _indiceSeleccionado = Math.min(_indiceSeleccionado + 1, _resultadosActuales.length - 1);
            resaltarOpcion(_indiceSeleccionado);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            _indiceSeleccionado = Math.max(_indiceSeleccionado - 1, 0);
            resaltarOpcion(_indiceSeleccionado);
        } else if (e.key === 'Enter') {
            e.preventDefault();
            var idxEnter = _indiceSeleccionado >= 0 ? _indiceSeleccionado : 0;
            if (_resultadosActuales[idxEnter]) {
                seleccionarCredito(_resultadosActuales[idxEnter]);
            }
        } else if (e.key === 'Escape') {
            e.preventDefault();
            e.stopPropagation();
            cont.style.display = 'none';
        }
    });
});

// Drag & drop
document.addEventListener('DOMContentLoaded', function() {
    var dropzone = document.getElementById('dropzone');
    var fileInput = document.getElementById('fileInput');
    
    if (dropzone && fileInput) {
        dropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.add('dragover');
        });
        dropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.remove('dragover');
        });
        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.remove('dragover');
            if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                mostrarNombreArchivo(fileInput);
            }
        });
    }
    
    // Keyboard: Escape para cerrar modales
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('modalSubir').style.display = 'none';
            document.getElementById('modalVistaPrevia').style.display = 'none';
        }
    });
});
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
