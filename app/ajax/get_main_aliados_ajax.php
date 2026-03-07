<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../conexiones/conexione.php');
include_once('pagination.php');

if (!isset($_SESSION['cod_administrador'])) {
    echo '<div class="empty-state"><h3>Sesión expirada</h3><p>Por favor, vuelve a iniciar sesión.</p></div>';
    exit;
}

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

$where = "WHERE a.cod_seguridad = '23' AND (a.cod_lider = '$cod_administrador' OR a.cod_coordinador IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador') OR a.cod_asesor IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador'))";

if (!empty($cod_aliado_get)) { $where .= " AND a.cod_administrador = '$cod_aliado_get'"; }

if (!empty($busqueda)) { $where .= " AND (a.cod_administrador = '$busqueda' OR a.cod_administrador LIKE '$busqueda' OR a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%' OR a.nit_razon_social LIKE '%$busqueda%' OR a.nombre_razon_social LIKE '%$busqueda%' OR a.barrio_tercero LIKE '%$busqueda%')"; }
if ($cod_coordinador_filtro > 0) { $where .= " AND a.cod_coordinador = '$cod_coordinador_filtro'"; }
if ($cod_asesor > 0) { $where .= " AND a.cod_asesor = '$cod_asesor'"; }
if ($cod_depto > 0) { $where .= " AND a.cod_departamento = '$cod_depto'"; }
if ($cod_muni > 0) { $where .= " AND a.cod_municipio = '$cod_muni'"; }

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

// Selección
$order_by = "a.cod_administrador DESC";
if ($sort == 'id_asc') { $order_by = "a.cod_administrador ASC"; }
elseif ($sort == 'nombre_asc') { $order_by = "a.nombres_apellidos_tercero ASC"; }
elseif ($sort == 'nombre_desc') { $order_by = "a.nombres_apellidos_tercero DESC"; }
elseif ($sort == 'fecha_desc') { $order_by = "a.fecha_hora DESC"; }
elseif ($sort == 'fecha_asc') { $order_by = "a.fecha_hora ASC"; }

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
                <?php if(!empty($row['telefono'])): ?><div class="ally-detail"><i class="fa-solid fa-phone"></i><span><?php echo $row['telefono']; ?></span></div><?php endif; ?>
                <?php if(!empty($row['nombre_asesor'])): ?><div class="ally-detail"><i class="fa-solid fa-user-tie" style="color: #a78bfa;"></i><span title="Asesor"><?php echo ucwords(strtolower($row['nombre_asesor'])); ?></span></div><?php endif; ?>
                <?php if(!empty($row['correo'])): ?><div class="ally-detail" style="grid-column: 1 / -1;"><i class="fa-solid fa-envelope"></i><span><?php echo strtolower($row['correo']); ?></span></div><?php endif; ?>
                
                <?php if(!empty($row['nombre_municipio'])): ?>
                <div class="ally-detail"><i class="fa-solid fa-location-dot" style="color: #ef4444;"></i><span><?php echo ucwords(strtolower($row['nombre_municipio'])); ?><?php echo !empty($row['nombre_departamento']) ? ', '.ucwords(strtolower($row['nombre_departamento'])) : ''; ?></span></div>
                <?php endif; ?>
                
                <?php if(!empty($row['barrio_tercero'])): ?>
                <div class="ally-detail"><i class="fa-solid fa-map-pin" style="color: #3b82f6;"></i><span>Barrio: <?php echo ucwords(strtolower($row['barrio_tercero'])); ?></span></div>
                <?php endif; ?>

                <?php if(!empty($row['cuenta'])): ?><div class="ally-detail"><i class="fa-solid fa-user-gear"></i><span>User: <?php echo $row['cuenta']; ?></span></div><?php endif; ?>
                <?php if(!empty($row['fecha'])): ?><div class="ally-detail"><i class="fa-solid fa-calendar-day" style="color: #f59e0b;"></i><span><?php echo date('d/m/Y', strtotime($row['fecha'])); ?></span></div><?php endif; ?>
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
                <button class="btn-quick-action btn-tienda" onclick="window.location.href='lista_tienda_lider_movil.php?registrar_tienda=1&cod_aliado=<?php echo $row['cod_administrador']; ?>'">
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
