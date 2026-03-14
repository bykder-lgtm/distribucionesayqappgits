<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../conexiones/conexione.php');
include_once('pagination.php');

if (!isset($_SESSION['cod_administrador'])) { echo '<div class="empty-state"><h3>Sesión expirada</h3><p>Por favor, vuelve a iniciar sesión.</p></div>'; exit; }

$cod_administrador = $_SESSION['cod_administrador'];

// Parámetros de paginación
$registros_por_pagina = 30;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina <= 0) $pagina = 1;
$inicio = ($pagina - 1) * $registros_por_pagina;

// Obtener parámetros de búsqueda
$busqueda = isset($_GET['busqueda']) ? trim(mysqli_real_escape_string($conectar, $_GET['busqueda'])) : '';
$filtro_doc = isset($_GET['filtro_doc']) ? mysqli_real_escape_string($conectar, $_GET['filtro_doc']) : '';
$sort = isset($_GET['sort']) ? mysqli_real_escape_string($conectar, $_GET['sort']) : 'id_desc';
$cod_coordinador_filtro = isset($_GET['cod_coordinador']) ? (int)$_GET['cod_coordinador'] : 0;
$cod_aliado_get = isset($_GET['cod_administrador']) ? trim(mysqli_real_escape_string($conectar, $_GET['cod_administrador'])) : '';

$cod_asesor = isset($_GET['cod_asesor']) ? (int)$_GET['cod_asesor'] : 0;
$cod_depto = isset($_GET['cod_departamento']) ? (int)$_GET['cod_departamento'] : 0;
$cod_muni = isset($_GET['cod_municipio']) ? (int)$_GET['cod_municipio'] : 0;
$fecha_registro = isset($_GET['fecha_registro']) ? mysqli_real_escape_string($conectar, $_GET['fecha_registro']) : '';
$fecha_doc_filtro = isset($_GET['fecha_documentacion']) ? mysqli_real_escape_string($conectar, $_GET['fecha_documentacion']) : '';

$where = "WHERE a.cod_seguridad = '23' AND a.cod_estado != 0 AND a.cod_estado_activacion_usuario != 3 AND (a.cod_lider = '$cod_administrador' OR a.cod_coordinador IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador') OR a.cod_asesor IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador'))";

if (!empty($cod_aliado_get)) { $where .= " AND a.cod_administrador = '$cod_aliado_get'"; }

if (!empty($busqueda)) { $where .= " AND (a.cod_administrador = '$busqueda' OR a.cod_administrador LIKE '$busqueda' OR a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%' OR a.nit_razon_social LIKE '%$busqueda%' OR a.nombre_razon_social LIKE '%$busqueda%' OR a.barrio_tercero LIKE '%$busqueda%')"; }
if ($cod_coordinador_filtro > 0) { $where .= " AND a.cod_coordinador = '$cod_coordinador_filtro'"; }
if ($cod_asesor > 0) { $where .= " AND a.cod_asesor = '$cod_asesor'"; }
if ($cod_depto > 0) { $where .= " AND a.cod_departamento = '$cod_depto'"; }
if ($cod_muni > 0) { $where .= " AND a.cod_municipio = '$cod_muni'"; }
if (!empty($fecha_registro)) { $where .= " AND DATE(a.fecha) = '$fecha_registro'"; }
if (!empty($fecha_doc_filtro)) { $where .= " AND DATE(a.fecha_documentacion) = '$fecha_doc_filtro'"; }

if ($filtro_doc == '1') {
    $where .= " AND (a.url_documentacion_rut_aliado != '' OR a.url_documentacion_camaracomercio_aliado != '' OR (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '2') {
    $where .= " AND (a.url_documentacion_rut_aliado != '' AND a.url_documentacion_camaracomercio_aliado != '' AND (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '3') {
    $where .= " AND (a.url_documentacion_rut_aliado = '' AND a.url_documentacion_camaracomercio_aliado = '' AND (a.url_documentacion_cedula_aliado IS NULL OR a.url_documentacion_cedula_aliado = ''))";
}

// Conteo total
$sql_conteo = "SELECT COUNT(*) as total FROM tbl15_administrador a $where";
$res_conteo = mysqli_query($conectar, $sql_conteo);
if (!$res_conteo) { echo "Error en conteo: " . mysqli_error($conectar); exit; }
$total_registros = mysqli_fetch_assoc($res_conteo)['total'];
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Conteo firmados (filtrado)
$sql_firmados = "SELECT COUNT(DISTINCT f.cod_aliado_estrategico) as total FROM tbl15_firma_digital_documento f INNER JOIN tbl15_administrador a ON f.cod_aliado_estrategico = a.cod_administrador $where AND f.cod_estado_firma_signature = 1";
$res_firmados = mysqli_query($conectar, $sql_firmados);
$total_firmados = ($res_firmados) ? mysqli_fetch_assoc($res_firmados)['total'] : 0;

// Conteo documentos (filtrado por aliados con al menos un documento)
$sql_docs = "SELECT COUNT(*) as total FROM tbl15_administrador a $where AND (
(url_documentacion_rut_aliado != '' AND url_documentacion_rut_aliado IS NOT NULL) OR 
(url_documentacion_camaracomercio_aliado != '' AND url_documentacion_camaracomercio_aliado IS NOT NULL) OR 
(url_documentacion_cedula_aliado != '' AND url_documentacion_cedula_aliado IS NOT NULL))";
$res_docs = mysqli_query($conectar, $sql_docs);
$total_docs_cargados = ($res_docs) ? mysqli_fetch_assoc($res_docs)['total'] : 0;

// Inyectar datos de estadísticas para que el JS los capture
echo '<div id="stats-data" style="display:none;" data-total="'.$total_registros.'" data-firmados="'.$total_firmados.'" data-docs="'.$total_docs_cargados.'"></div>';
// Selección
$order_by = "a.cod_administrador DESC";
if ($sort == 'id_asc') { $order_by = "a.cod_administrador ASC"; }
elseif ($sort == 'nombre_asc') { $order_by = "a.nombres_apellidos_tercero ASC"; }
elseif ($sort == 'nombre_desc') { $order_by = "a.nombres_apellidos_tercero DESC"; }
elseif ($sort == 'fecha_desc') { $order_by = "a.fecha_hora DESC"; }
elseif ($sort == 'fecha_asc') { $order_by = "a.fecha_hora ASC"; }
elseif ($sort == 'doc_fecha_desc') { $order_by = "a.fecha_documentacion DESC"; }
elseif ($sort == 'doc_fecha_asc') { $order_by = "a.fecha_documentacion ASC"; }

$sql = "SELECT a.*, ase.nombres_apellidos_tercero as nombre_asesor, dep.nombre_departamento, mun.nombre_municipio FROM tbl15_administrador a
LEFT JOIN tbl15_administrador ase ON a.cod_asesor = ase.cod_administrador LEFT JOIN tbl15_departamento dep ON a.cod_departamento = dep.cod_departamento
LEFT JOIN tbl15_municipio mun ON a.cod_municipio = mun.cod_municipio $where ORDER BY $order_by LIMIT $inicio, $registros_por_pagina";
$resultado = mysqli_query($conectar, $sql);
if (!$resultado) { echo "Error en consulta: " . mysqli_error($conectar); exit; }

if ($total_registros > 0):

    while ($row = mysqli_fetch_assoc($resultado)):
        $nombre_completo = !empty($row['nombres_apellidos_tercero']) ? $row['nombres_apellidos_tercero'].' ('.$row['nombres'].' '.$row['apellidos'].')' : trim($row['nombres'].' '.$row['apellidos']);
        $cod_estado = $row['cod_estado_activacion_usuario'];
        if ($cod_estado == '1') { $estado_texto = 'Activo'; $estado_bg = 'rgba(139, 92, 246, 0.2)'; $estado_color = '#8b5cf6'; } elseif ($cod_estado == '2') { $estado_texto = 'En Espera'; $estado_bg = 'rgba(245, 158, 11, 0.2)'; $estado_color = '#f59e0b'; } else { $estado_texto = 'Inactivo'; $estado_bg = 'rgba(239, 68, 68, 0.2)'; $estado_color = '#ef4444'; }
        
        $cod_aliado = $row['cod_administrador'];
        
        $res_tiendas = mysqli_query($conectar, "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_aliado_estrategico = '$cod_aliado'");
        $total_tiendas_aliado = ($res_tiendas) ? mysqli_fetch_assoc($res_tiendas)['total'] : 0;
        
        $res_bancos = mysqli_query($conectar, "SELECT COUNT(*) as total FROM tbl15_banco_cuenta WHERE cod_aliado_estrategico = '$cod_aliado' AND cod_estado = '1'");
        $total_bancos_aliado = ($res_bancos) ? mysqli_fetch_assoc($res_bancos)['total'] : 0;

        $tiene_rut = !empty($row['url_documentacion_rut_aliado']);
        $tiene_camara = !empty($row['url_documentacion_camaracomercio_aliado']);
        $tiene_cedula = isset($row['url_documentacion_cedula_aliado']) && !empty($row['url_documentacion_cedula_aliado']);
        $total_docs = ($tiene_rut ? 1 : 0) + ($tiene_camara ? 1 : 0) + ($tiene_cedula ? 1 : 0);
        ?>
        <div class="ally-card animate-in" style="opacity: 1; transform: translateY(0);">
            <div class="ally-header">
                <div class="ally-info">
                    <div class="ally-name"><?php echo ucwords(strtolower($nombre_completo)); ?></div>
                    <div class="ally-doc">CC: <?php echo $row['cedula']; ?></div>
                </div>
                <span class="ally-role" style="background: <?php echo $estado_bg; ?>; color: <?php echo $estado_color; ?>;">
                    <?php echo $estado_texto; ?>
                </span>
            </div>
            
            <div class="ally-details">
                <div class="ally-detail">
                    <i class="fa-solid fa-phone" style="color: #8b5cf6;"></i>
                    <span><?php echo !empty($row['telefono']) ? $row['telefono'] : '---'; ?></span>
                </div>
                
                <div class="ally-detail">
                    <i class="fa-solid fa-user-tie" style="color: #8b5cf6;"></i>
                    <span title="Asesor">Asesor: <?php echo !empty($row['nombre_asesor']) ? ucwords(strtolower($row['nombre_asesor'])) : '---'; ?></span>
                </div>

                <div class="ally-detail">
                    <i class="fa-solid fa-location-dot" style="color: #ef4444;"></i>
                    <span><?php echo !empty($row['nombre_municipio']) ? ucwords(strtolower($row['nombre_municipio'])) . (!empty($row['nombre_departamento']) ? ', ' . ucwords(strtolower($row['nombre_departamento'])) : '') : '---'; ?></span>
                </div>
                
                <div class="ally-detail">
                    <i class="fa-solid fa-envelope" style="color: #8b5cf6;"></i>
                    <span><?php echo !empty($row['correo']) ? strtolower($row['correo']) : '---'; ?></span>
                </div>
                
                <div class="ally-detail">
                    <i class="fa-solid fa-key" style="color: #3b82f6;"></i>
                    <span>Barrio: <?php echo !empty($row['barrio_tercero']) ? ucwords(strtolower($row['barrio_tercero'])) : '---'; ?></span>
                </div>

                <div class="ally-detail">
                    <i class="fa-solid fa-user-gear" style="color: #8b5cf6;"></i>
                    <span>User: <?php echo !empty($row['cuenta']) ? $row['cuenta'] : '---'; ?></span>
                </div>

                <div class="ally-detail">
                    <i class="fa-solid fa-calendar-days" style="color: #f59e0b;"></i>
                    <span title="Fecha Registro">Reg: <?php echo !empty($row['fecha']) ? date('d/m/Y', strtotime($row['fecha'])) : '---'; ?></span>
                </div>

                <div class="ally-detail">
                    <i class="fa-solid fa-file-invoice" style="color: #8b5cf6;"></i>
                    <span title="Fecha Documentación">Doc: <?php echo (!empty($row['fecha_documentacion']) && $row['fecha_documentacion'] != '0000-00-00 00:00:00') ? date('d/m/Y', strtotime($row['fecha_documentacion'])) : '---'; ?></span>
                </div>

                <?php 
                $tiene_firma = !empty($row['url_img_firma_prof_ori']);
                $documentos_completos = ($tiene_rut && $tiene_camara && $tiene_cedula);
                ?>
                <div class="ally-detail">
                    <i class="fa-solid fa-signature" style="color: #ef4444;"></i>
                    <span>Firma: <?php echo $tiene_firma ? 'Cargada' : 'Pendiente'; ?></span>
                </div>

                <div class="ally-detail">
                    <i class="fa-solid fa-folder-open" style="color: #f59e0b;"></i>
                    <span>Docs: <?php echo $documentos_completos ? 'Completos' : ($total_docs > 0 ? 'Parcial ('.$total_docs.'/3)' : 'Pendiente'); ?></span>
                </div>
            </div>

            <div class="ally-stats">
                <div class="ally-stat-item" onclick="abrirModalVerTiendas(<?php echo $row['cod_administrador']; ?>, '<?php echo addslashes($row['nombres_apellidos_tercero']); ?>')">
                    <span class="ally-stat-number"><?php echo $total_tiendas_aliado; ?></span>
                    <span class="ally-stat-label">Tiendas</span>
                </div>
                <div class="ally-stat-item" onclick="abrirModalVerCuentas(<?php echo $row['cod_administrador']; ?>, '<?php echo addslashes($row['nombres_apellidos_tercero']); ?>')">
                    <span class="ally-stat-number"><?php echo $total_bancos_aliado; ?></span>
                    <span class="ally-stat-label">Cuentas</span>
                </div>
            </div>

            <div class="ally-quick-actions">
                <button class="btn-quick-action btn-tienda" onclick="abrirModalRegistrarTienda(<?php echo $row['cod_administrador']; ?>, '<?php echo addslashes($row['nombres_apellidos_tercero']); ?>')">
                    <i class="fa-solid fa-store"></i> +Tienda
                </button>
                <button class="btn-quick-action btn-banco" onclick="abrirModalAgregarBanco(<?php echo $row['cod_administrador']; ?>)">
                    <i class="fa-solid fa-university"></i> +Banco
                </button>
            </div>


            <div class="ally-actions">
                <a href="ver_detalle_aliado_lider_movil.php?cod_administrador=<?php echo $row['cod_administrador']; ?>" class="action-btn view"><i class="fa-solid fa-eye"></i> Detalles</a>
                <button class="action-btn edit" onclick="abrirModalEditar(<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>)"><i class="fa-solid fa-edit"></i> Editar</button>
                
                <?php if ($total_docs == 3): ?>
                <button class="action-btn share-complete" onclick="compartirDocumentacion(<?php echo $row['cod_administrador']; ?>)"><i class="fa-solid fa-circle-check"></i> Docs <span class="docs-badge"><?php echo $total_docs; ?>/3</span></button>
                <?php elseif ($total_docs > 0): ?>
                <button class="action-btn share-partial" onclick="compartirDocumentacion(<?php echo $row['cod_administrador']; ?>)"><i class="fa-solid fa-file-circle-exclamation"></i> Docs <span class="docs-badge"><?php echo $total_docs; ?>/3</span></button>
                <?php else: ?>
                <button class="action-btn share" disabled style="opacity: 0.5; cursor: not-allowed;"><i class="fa-solid fa-share-nodes"></i> Compartir</button>
                <?php endif; ?>
                
                <button class="action-btn archive" onclick="archivarEntidad(<?php echo $row['cod_administrador']; ?>, '<?php echo addslashes($row['nombres_apellidos_tercero']); ?>', 'Aliado')">
                    <i class="fa-solid fa-box-archive"></i> Archivar
                </button>
            </div>
        </div>
        <?php
    endwhile;
    
    // Renderizar paginación al final
    echo '<div class="pagination-wrapper-ajax" style="grid-column: 1/-1; margin-top: 1rem;">';
    echo paginate('', $pagina, $total_paginas, 2);
    echo '</div>';
else: ?>
    <div class="empty-state" style="grid-column: 1/-1;"><i class="fa-solid fa-users-slash"></i><h3>No hay aliados</h3><p>No se encontraron registros para los filtros seleccionados.</p></div>
<?php endif; ?>
