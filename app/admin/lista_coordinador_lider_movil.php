<?php 
$nombre_pagina          = "Mis Coordinadores";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_lider.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_lider.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($nombre) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<script src="../js/sha1.js"></script>
<!-- SweetAlert2 CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* ============================================ */
/* LISTA COORDINADORES LIDER - TEMA PÚRPURA/VIOLETA */
/* ============================================ */

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
    min-height: 100vh;
    overflow-x: hidden;
}

/* SweetAlert z-index fix para que aparezca encima de modales */
.swal-high-zindex {
    z-index: 99999 !important;
}

.page-container {
    padding: 1rem;
    padding-bottom: 100px;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

/* Header */
.page-header {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(139, 92, 246, 0.4);
}

.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.page-header h1 {
    color: white;
    font-size: 1.75rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 1;
}

.page-header p {
    color: rgba(255,255,255,0.8);
    font-size: 0.95rem;
    position: relative;
    z-index: 1;
}

.header-stats {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    position: relative;
    z-index: 1;
}

.header-stat {
    background: rgba(255,255,255,0.15);
    padding: 0.75rem 1rem;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.header-stat-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: white;
}

.header-stat-label {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.8);
    margin-top: 0.25rem;
}

/* Search Bar */
.search-bar {
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.2);
    border-radius: 15px;
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.search-bar i {
    color: #8b5cf6;
    font-size: 1.1rem;
}

.search-bar input {
    background: transparent;
    border: none;
    outline: none;
    color: white;
    font-size: 0.95rem;
    width: 100%;
}

.search-bar input::placeholder {
    color: rgba(255,255,255,0.4);
}

/* Add Button */
.add-btn {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
    border: none;
    padding: 0.9rem 1.5rem;
    border-radius: 15px;
    font-size: 0.95rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    cursor: pointer;
    margin-bottom: 1.5rem;
    box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    transition: all 0.3s ease;
    width: 100%;
}

.add-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(139, 92, 246, 0.4);
}

/* Coordinadores List */
.coordinadores-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* Coordinador Card */
.coordinador-card {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(79, 70, 229, 0.05) 100%);
    border: 1px solid rgba(139, 92, 246, 0.2);
    border-radius: 20px;
    padding: 1.25rem;
    transition: all 0.3s ease;
}

.coordinador-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 35px rgba(139, 92, 246, 0.25);
    border-color: rgba(139, 92, 246, 0.4);
}

.coordinador-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.coordinador-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    font-weight: 700;
    box-shadow: 0 6px 20px rgba(139, 92, 246, 0.3);
}

.coordinador-info {
    flex: 1;
    margin-left: 1rem;
}

.coordinador-name {
    color: white;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.coordinador-role {
    color: rgba(255,255,255,0.6);
    font-size: 0.85rem;
    background: rgba(139, 92, 246, 0.2);
    padding: 0.25rem 0.75rem;
    border-radius: 8px;
    display: inline-block;
    font-weight: 600;
}

.coordinador-status {
    padding: 0.35rem 0.85rem;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-active { background: rgba(16, 185, 129, 0.2); color: #10b981; }
.status-pending { background: rgba(251, 191, 36, 0.2); color: #fbbf24; }
.status-inactive { background: rgba(239, 68, 68, 0.2); color: #ef4444; }

/* Coordinador Details */
.coordinador-details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.detail-item {
    background: rgba(0,0,0,0.2);
    padding: 0.75rem;
    border-radius: 10px;
}

.detail-label {
    color: rgba(255,255,255,0.5);
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
    display: block;
    font-weight: 600;
}

.detail-value {
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
}

/* Coordinador Stats */
.coordinador-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(139, 92, 246, 0.2);
}

.stat-item {
    text-align: center;
    background: rgba(139, 92, 246, 0.1);
    padding: 0.75rem;
    border-radius: 10px;
}

.stat-value {
    font-size: 1.25rem;
    font-weight: 800;
    color: #8b5cf6;
    display: block;
}

.stat-label {
    color: rgba(255,255,255,0.6);
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0.25rem;
}

/* Actions */
.coordinador-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.action-btn {
    flex: 1;
    min-width: calc(50% - 0.25rem);
    padding: 0.75rem;
    border: none;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.action-btn.view {
    background: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
}

.action-btn.edit {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
}

.action-btn.stats {
    background: rgba(251, 191, 36, 0.2);
    color: #fbbf24;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1.5rem;
    background: rgba(139, 92, 246, 0.05);
    border: 2px dashed rgba(139, 92, 246, 0.2);
    border-radius: 20px;
    margin: 2rem 0;
}

.empty-state i {
    font-size: 4rem;
    color: rgba(139, 92, 246, 0.3);
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: white;
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: rgba(255,255,255,0.5);
    font-size: 0.95rem;
}

/* Bottom Navigation */
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-top: 1px solid rgba(139, 92, 246, 0.2);
    display: flex;
    justify-content: space-around;
    padding: 0.75rem 0;
    z-index: 1000;
    backdrop-filter: blur(20px);
}

.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: rgba(255,255,255,0.5);
    transition: all 0.3s ease;
    padding: 0.5rem 1rem;
    border-radius: 12px;
}

.nav-item:hover, .nav-item.active {
    color: #8b5cf6;
    text-decoration: none;
}

.nav-item.active {
    background: rgba(139, 92, 246, 0.1);
}

.nav-item i {
    font-size: 1.25rem;
    margin-bottom: 0.25rem;
}

.nav-item span {
    font-size: 0.75rem;
    font-weight: 600;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-in {
    animation: fadeIn 0.6s ease-out;
}

.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }
.delay-3 { animation-delay: 0.3s; }

/* Responsive */
@media (max-width: 768px) {
    .page-container {
        padding: 0.75rem;
        padding-bottom: 80px;
    }
    
    .page-header h1 {
        font-size: 1.5rem;
    }
    
    .coordinador-details {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    
    .coordinador-stats {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .page-container {
        padding: 0.5rem;
        padding-bottom: 70px;
    }
    
    .page-header {
        padding: 1.25rem;
        border-radius: 15px;
    }
    
    .page-header h1 {
        font-size: 1.35rem;
    }
    
    .coordinador-actions {
        flex-direction: row;
        flex-wrap: nowrap; /* Force them to stay side-by-side */
    }
    
    .action-btn {
        min-width: 0; 
        flex: 1;
        padding: 0.6rem 0.25rem;
        font-size: 0.75rem; /* Slightly smaller to fit text */
        gap: 0.25rem;
    }

    .action-btn i {
        font-size: 0.85rem;
    }
}
/* Pagination Styles */
.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    margin-top: 2rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.pagination-btn {
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    color: white;
    padding: 0.5rem 0.85rem;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination-btn:hover {
    background: rgba(139, 92, 246, 0.3);
    border-color: #8b5cf6;
    color: white;
}

.pagination-btn.active {
    background: #8b5cf6;
    border-color: #8b5cf6;
    color: white;
}

.pagination-btn.disabled {
    opacity: 0.5;
    pointer-events: none;
}

</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>
<?php
// Parámetros de paginación
$registros_por_pagina = 10;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina <= 0) $pagina = 1;
$inicio = ($pagina - 1) * $registros_por_pagina;

$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conectar, $_GET['busqueda']) : '';

// Consulta para contar el total de registros
$sql_conteo = "SELECT COUNT(DISTINCT a.cod_administrador) as total 
               FROM tbl15_administrador a 
               WHERE a.cod_lider = '$cod_administrador' AND a.cod_seguridad = '21'";
if (!empty($busqueda)) { $sql_conteo .= " AND (a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%')"; }
$resultado_conteo = mysqli_query($conectar, $sql_conteo);
$fila_conteo = mysqli_fetch_assoc($resultado_conteo);
$total_registros_global = $fila_conteo['total'];
$total_paginas = ceil($total_registros_global / $registros_por_pagina);

// Consulta de coordinadores asignados a este lider (cod_seguridad = '21' para coordinadores)
$sql = "SELECT a.cod_administrador, a.cedula, a.nombres, a.apellidos, a.cuenta, a.correo, a.telefono, a.nombres_apellidos_tercero, a.cod_estado_activacion_usuario, a.fecha_creacion, a.cod_lider,
(SELECT COUNT(*) FROM tbl15_administrador WHERE cod_coordinador = a.cod_administrador AND cod_seguridad = '22') as total_asesores,
(SELECT COUNT(*) FROM tbl15_administrador WHERE cod_coordinador = a.cod_administrador AND cod_seguridad = '23') as total_aliados,
(SELECT COUNT(*) FROM tbl15_tienda WHERE cod_aliado_estrategico IN (SELECT cod_administrador FROM tbl15_administrador WHERE cod_coordinador = a.cod_administrador AND cod_seguridad = '23')) as total_tiendas
FROM tbl15_administrador a 
WHERE a.cod_lider = '$cod_administrador' AND a.cod_seguridad = '21'";

if (!empty($busqueda)) { $sql .= " AND (a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%')"; }

$sql .= " ORDER BY a.cod_administrador DESC LIMIT $inicio, $registros_por_pagina";
$resultado = mysqli_query($conectar, $sql);
$total_registros_pagina = $resultado ? mysqli_num_rows($resultado) : 0;
?>

<main class="page-container">
<?php
// Consulta de líderes para la opción de cambiar líder
$sql_lideres = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '20' AND cod_estado_activacion_usuario = '1' ORDER BY nombres_apellidos_tercero ASC";
$res_lideres = mysqli_query($conectar, $sql_lideres);
?>

    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-users-gear"></i> Mis Coordinadores</h1>
        <p>Gestiona tu equipo de coordinadores</p>
        <div class="header-stats">
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $total_registros_global; ?></div>
                <div class="header-stat-label">Total Coordinadores</div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="search-bar animate-in delay-1">
        <i class="fa-solid fa-search"></i>
        <input type="text" id="searchInput" placeholder="Buscar coordinador..." value="<?php echo htmlspecialchars($busqueda); ?>" onkeyup="filtrar(this.value)">
    </div>

    <!-- Add Button -->
    <button class="add-btn animate-in delay-2" onclick="abrirModalRegistro()"><i class="fa-solid fa-user-plus"></i> Nuevo Coordinador</button>

    <!-- Coordinadores List -->
    <div class="coordinadores-list">
        <?php if ($total_registros_pagina > 0): ?>
            <?php while($row = mysqli_fetch_assoc($resultado)): 
                $iniciales = '';
                if (!empty($row['nombres'])) { $iniciales = strtoupper(substr($row['nombres'], 0, 1)); }
                if (!empty($row['apellidos'])) { $iniciales .= strtoupper(substr($row['apellidos'], 0, 1)); }
                if (empty($iniciales)) { $iniciales = 'CO'; }
                
                $estado_class = 'status-inactive';
                $estado_texto = 'Inactivo'; 
                if ($row['cod_estado_activacion_usuario'] == 1) { $estado_class = 'status-active'; $estado_texto = 'Activo'; } elseif ($row['cod_estado_activacion_usuario'] == 2) { $estado_class = 'status-pending'; $estado_texto = 'Pendiente'; }
            ?>
            <div class="coordinador-card animate-in">
                <div class="coordinador-header">
                    <div style="display: flex; align-items: flex-start; flex: 1;">
                        <div class="coordinador-avatar"><?php echo $iniciales; ?></div>
                        <div class="coordinador-info">
                            <div class="coordinador-name"><?php echo $row['nombres_apellidos_tercero']; ?></div>
                            <span class="coordinador-role"><i class="fa-solid fa-users-gear"></i> Coordinador</span>
                        </div>
                    </div>
                    <span class="coordinador-status <?php echo $estado_class; ?>"><?php echo $estado_texto; ?></span>
                </div>

                <div class="coordinador-details">
                    <div class="detail-item">
                        <span class="detail-label">Cédula</span>
                        <span class="detail-value"><?php echo $row['cedula']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Teléfono</span>
                        <span class="detail-value"><?php echo $row['telefono'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <span class="detail-label">Correo</span>
                        <span class="detail-value" style="font-size: 0.8rem;"><?php echo $row['correo'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Usuario</span>
                        <span class="detail-value"><?php echo $row['cuenta']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Fecha Registro</span>
                        <span class="detail-value"><?php echo !empty($row['fecha_creacion']) ? date('d/m/Y', strtotime($row['fecha_creacion'])) : 'N/A'; ?></span>
                    </div>
                </div>

                <div class="coordinador-stats">
                    <div class="stat-item" onclick="abrirModalStats(<?php echo $row['cod_administrador']; ?>, 'asesores')" style="cursor: pointer;">
                        <span class="stat-value"><?php echo $row['total_asesores']; ?></span>
                        <span class="stat-label">Asesores</span>
                    </div>
                    <div class="stat-item" onclick="abrirModalStats(<?php echo $row['cod_administrador']; ?>, 'aliados')" style="cursor: pointer;">
                        <span class="stat-value"><?php echo $row['total_aliados']; ?></span>
                        <span class="stat-label">Aliados</span>
                    </div>

                    <div class="stat-item" onclick="abrirModalStats(<?php echo $row['cod_administrador']; ?>, 'tiendas')" style="cursor: pointer;">
                        <span class="stat-value"><?php echo $row['total_tiendas']; ?></span>
                        <span class="stat-label">Tiendas</span>
                    </div>
                </div>

                <div class="coordinador-actions">
<!--
                    <button class="action-btn view" onclick="location.href='lista_asesor_lider_movil.php?cod_coordinador=<?php echo $row['cod_administrador']; ?>'">
                        <i class="fa-solid fa-user-tie"></i> Ver Asesores
                    </button>
                    <button class="action-btn stats" onclick="location.href='lista_aliado_lider_movil.php?cod_coordinador=<?php echo $row['cod_administrador']; ?>'">
                        <i class="fa-solid fa-users"></i> Ver Aliados
                    </button>
-->
                    <button class="action-btn edit" onclick='abrirModalEditar(<?php echo json_encode($row); ?>)'>
                        <i class="fa-solid fa-edit"></i> Editar
                    </button>
                </div>
            </div>
<?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-solid fa-users-slash"></i>
                <h3>No hay coordinadores</h3>
                <p>No se encontraron registros de coordinadores asignados</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <div class="pagination-container animate-in delay-3">
        <div style="width: 100%; text-align: center; color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-bottom: 0.75rem; font-weight: 500; background: rgba(139, 92, 246, 0.1); padding: 0.5rem; border-radius: 10px; border: 1px solid rgba(139, 92, 246, 0.2);">
            Mostrando <span style="color: #a78bfa; font-weight: 700;"><?php echo $total_registros_pagina; ?></span> de <span style="color: #a78bfa; font-weight: 700;"><?php echo $total_registros_global; ?></span> coordinadores
        </div>
        
        <?php if ($total_paginas > 1): ?>
            <?php 
            $params = $_GET;
            unset($params['pagina']);
            $query_string = http_build_query($params);
            $base_url = "lista_coordinador_lider_movil.php?" . ($query_string ? $query_string . "&" : "");
            ?>
            
            <a href="<?php echo $base_url; ?>pagina=<?php echo max(1, $pagina - 1); ?>" class="pagination-btn <?php echo ($pagina <= 1) ? 'disabled' : ''; ?>">
                <i class="fa-solid fa-chevron-left"></i>
            </a>

            <?php
            $rango = 2;
            for ($i = 1; $i <= $total_paginas; $i++):
                if ($i == 1 || $i == $total_paginas || ($i >= $pagina - $rango && $i <= $pagina + $rango)):
            ?>
                <a href="<?php echo $base_url; ?>pagina=<?php echo $i; ?>" class="pagination-btn <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php 
                elseif ($i == $pagina - $rango - 1 || $i == $pagina + $rango + 1):
                    echo '<span style="color: rgba(255,255,255,0.5);">...</span>';
                endif;
            endfor; 
            ?>

            <a href="<?php echo $base_url; ?>pagina=<?php echo min($total_paginas, $pagina + 1); ?>" class="pagination-btn <?php echo ($pagina >= $total_paginas) ? 'disabled' : ''; ?>">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        <?php endif; ?>
    </div>
</main>

<!-- Modal Registro Coordinador -->
<div class="modal-overlay" id="modalRegistroCoordinador" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); backdrop-filter: blur(8px); z-index: 5000; align-items: center; justify-content: center; padding: 1rem; overflow-y: auto;">
    <div class="modal-content" style="background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 20px; width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; position: relative; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
        <div class="modal-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); padding: 1.5rem; border-radius: 20px 20px 0 0; position: relative; display: flex; justify-content: space-between; align-items: center;">
            <h2 style="color: white; font-size: 1.25rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-user-plus"></i> Nuevo Coordinador</h2>
            <button class="modal-close" onclick="cerrarModalRegistro()" style="background: rgba(255,255,255,0.2); border: none; color: white; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body" style="padding: 1.5rem;">
            <form id="formRegistroCoordinador" onsubmit="registrarCoordinador(event)">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    
                    <div style="grid-column: 1 / -1;">
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Identificación (Cédula)</label>
                        <input type="number" name="identificacion_tercero" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>

                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Primer Nombre</label>
                        <input type="text" name="nombre1_tercero" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>
                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Segundo Nombre</label>
                        <input type="text" name="nombre2_tercero" class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>

                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Primer Apellido</label>
                        <input type="text" name="apellido1_tercero" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>
                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Segundo Apellido</label>
                        <input type="text" name="apellido2_tercero" class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Correo Electrónico</label>
                        <input type="email" name="correo_tercero" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>

                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Celular</label>
                        <input type="number" name="telefono1_tercero" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>
                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Sexo</label>
                        <select name="nombre_sexo" class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                            <option value="M" style="color: black;">Masculino</option>
                            <option value="F" style="color: black;">Femenino</option>
                            <option value="O" style="color: black;">Otro</option>
                        </select>
                    </div>

                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="submit-btn" style="width: 100%; background: #8b5cf6; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; font-size: 0.95rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                        <i class="fa-solid fa-save"></i> Guardar Coordinador
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Consultar Estadísticas -->
<div class="modal-overlay" id="modalStatsDetalles" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); backdrop-filter: blur(8px); z-index: 5000; align-items: center; justify-content: center; padding: 1rem; overflow-y: auto;">
    <div class="modal-content" style="background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 20px; width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; position: relative; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
        <div class="modal-header" id="modalStatsHeader" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); padding: 1.25rem; border-radius: 20px 20px 0 0; position: relative; display: flex; justify-content: space-between; align-items: center;">
            <h2 id="modalStatsTitle" style="color: white; font-size: 1.15rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 0.5rem;">Detalles</h2>
            <button class="modal-close" onclick="cerrarModalStats()" style="background: rgba(255,255,255,0.2); border: none; color: white; width: 34px; height: 34px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body" id="modalStatsContent" style="padding: 1.25rem; min-height: 200px;">
            <!-- Contenido dinámico via AJAX -->
            <div style="text-align: center; padding: 3rem; color: rgba(255,255,255,0.5);">
                <i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                <p>Cargando información...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Coordinador -->
<div class="modal-overlay" id="modalEditarCoordinador" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); backdrop-filter: blur(8px); z-index: 5000; align-items: center; justify-content: center; padding: 1rem; overflow-y: auto;">
    <div class="modal-content" style="background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 20px; width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; position: relative; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
        <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 1.5rem; border-radius: 20px 20px 0 0; position: relative; display: flex; justify-content: space-between; align-items: center;">
            <h2 style="color: white; font-size: 1.25rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-edit"></i> Editar Coordinador</h2>
            <button class="modal-close" onclick="cerrarModalEditar()" style="background: rgba(255,255,255,0.2); border: none; color: white; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body" style="padding: 1.5rem;">
            <form id="formEditarCoordinador" onsubmit="editarCoordinador(event)">
                <input type="hidden" name="cod_administrador_edit" id="cod_administrador_edit">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    
                    <div style="grid-column: 1 / -1;">
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Identificación (Cédula)</label>
                        <input type="number" name="cedula_edit" id="cedula_edit" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>

                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Primer Nombre</label>
                        <input type="text" name="nombres_edit" id="nombres_edit" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>
                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Apellidos</label>
                        <input type="text" name="apellidos_edit" id="apellidos_edit" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Correo Electrónico</label>
                        <input type="email" name="correo_edit" id="correo_edit" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>

                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Celular</label>
                        <input type="number" name="telefono1_edit" id="telefono1_edit" required class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                    </div>

                    <div>
                        <label style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: block;">Líder Asignado</label>
                        <select name="cod_lider_edit" id="cod_lider_edit" class="form-input" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.75rem; border-radius: 12px; font-size: 0.9rem;">
                            <?php 
                            mysqli_data_seek($res_lideres, 0);
                            while ($lider = mysqli_fetch_assoc($res_lideres)): 
                            ?>
                            <option value="<?php echo $lider['cod_administrador']; ?>" style="color: black;"><?php echo $lider['nombres_apellidos_tercero']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="submit-btn" style="width: 100%; background: #10b981; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; font-size: 0.95rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                        <i class="fa-solid fa-save"></i> Guardar Cambios
                    </button>
                    <button type="button" onclick="cerrarModalEditar()" style="width: 100%; background: transparent; color: rgba(255,255,255,0.5); border: 1px solid rgba(255,255,255,0.1); padding: 0.75rem; border-radius: 12px; cursor: pointer; font-weight: 600; margin-top: 0.5rem; transition: all 0.3s ease;">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
 <?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<script>
function filtrar(busqueda) { if (busqueda.length > 2 || busqueda.length === 0) { window.location.href = 'lista_coordinador_lider_movil.php?busqueda=' + encodeURIComponent(busqueda); } }

// Auto búsqueda después de 1 segundo de inactividad
let searchTimeout;
document.getElementById('searchInput').addEventListener('keyup', function(e) {
    const busqueda = this.value;
    if (e.key === 'Enter') { filtrar(busqueda); return; }
    searchTimeout = setTimeout(function() { if (busqueda.length > 2 || busqueda.length === 0) { filtrar(busqueda); } }, 1000);
});

// Modal Logic
function abrirModalRegistro() {
    document.getElementById('modalRegistroCoordinador').style.display = 'flex';
}

function cerrarModalRegistro() {
    document.getElementById('modalRegistroCoordinador').style.display = 'none';
    document.getElementById('formRegistroCoordinador').reset();
}

// Edit Modal Logic
function abrirModalEditar(datos) {
    document.getElementById('cod_administrador_edit').value = datos.cod_administrador;
    document.getElementById('cedula_edit').value = datos.cedula;
    document.getElementById('nombres_edit').value = datos.nombres;
    document.getElementById('apellidos_edit').value = datos.apellidos;
    document.getElementById('correo_edit').value = datos.correo;
    document.getElementById('telefono1_edit').value = datos.telefono;
    document.getElementById('cod_lider_edit').value = datos.cod_lider;
    
    document.getElementById('modalEditarCoordinador').style.display = 'flex';
}

function cerrarModalEditar() {
    document.getElementById('modalEditarCoordinador').style.display = 'none';
}

function editarCoordinador(e) {
    e.preventDefault();
    const form = document.getElementById('formEditarCoordinador');
    const formData = new FormData(form);

    Swal.fire({
        title: 'Actualizando Coordinador...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); },
        background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }
    });

    $.ajax({
        url: 'proceso_editar_coordinador_lider_movil_ajax.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success', title: '¡Actualización Exitosa!', text: response.message,
                    background: '#1a1f2e', color: 'white', confirmButtonColor: '#10b981', customClass: { container: 'swal-high-zindex' }
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error', title: 'Error', text: response.message,
                    background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' }
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor',
                background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' }
            });
        }
    });
}

// AJAX Registration
function registrarCoordinador(e) {
    e.preventDefault();
    
    const form = document.getElementById('formRegistroCoordinador');
    const formData = new FormData(form);

    Swal.fire({
        title: 'Registrando Coordinador...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); },
        background: '#1a1f2e',
        color: 'white',
        customClass: { container: 'swal-high-zindex' }
    });

    $.ajax({
        url: 'reg_coordinador_modal_lider_movil_ajax_reg.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success', title: '¡Registro Exitoso!', text: response.message, background: '#1a1f2e', color: 'white', showDenyButton: true,
                    showCancelButton: true, confirmButtonText: '<i class="fa-brands fa-whatsapp"></i> WhatsApp', denyButtonText: '<i class="fa-solid fa-envelope"></i> Email',
                    cancelButtonText: 'Cerrar', confirmButtonColor: '#25D366', denyButtonColor: '#8b5cf6', cancelButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // WhatsApp Notification
                        const connect_whatsapp = 'https://api.whatsapp.com/send?phone=57' + formData.get('telefono1_tercero') + '&text=Hola ' + formData.get('nombre1_tercero') + ', te damos la bienvenida como Coordinador. Tu usuario es: ' + formData.get('identificacion_tercero') + ' y tu contraseña es: ' + formData.get('identificacion_tercero');
                        window.open(connect_whatsapp, '_blank');
                        location.reload();
                    } else if (result.isDenied) {
                        // Email Notification (AJAX PHPMailer)
                        Swal.fire({
                            title: 'Enviando Correo...',
                            text: 'Por favor espere',
                            allowOutsideClick: false,
                            didOpen: () => { Swal.showLoading(); },
                            background: '#1a1f2e',
                            color: 'white',
                            customClass: { container: 'swal-high-zindex' }
                        });

                        const emailData = new FormData();
                        emailData.append('email_destino', formData.get('correo_tercero'));
                        emailData.append('nombre_asesor', formData.get('nombre1_tercero') + ' ' + formData.get('apellido1_tercero'));
                        emailData.append('usuario', formData.get('identificacion_tercero'));
                        emailData.append('contrasena', formData.get('identificacion_tercero'));

                        $.ajax({
                            url: 'enviar_email_bienvenida_asesor.php',
                            type: 'POST',
                            data: emailData,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(emailResponse) {
                                if (emailResponse.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '¡Correo Enviado!',
                                        text: emailResponse.message,
                                        background: '#1a1f2e',
                                        color: 'white',
                                        confirmButtonColor: '#8b5cf6',
                                        customClass: { container: 'swal-high-zindex' }
                                    }).then(() => {
                                        cerrarModalRegistro();
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al Enviar',
                                        text: emailResponse.message,
                                        background: '#1a1f2e',
                                        color: 'white',
                                        confirmButtonColor: '#ef4444',
                                        customClass: { container: 'swal-high-zindex' }
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error de Conexión',
                                    text: 'No se pudo conectar con el servidor de correo',
                                    background: '#1a1f2e',
                                    color: 'white',
                                    confirmButtonColor: '#ef4444',
                                    customClass: { container: 'swal-high-zindex' }
                                });
                            }
                        });
                    } else {
                        cerrarModalRegistro();
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                    background: '#1a1f2e',
                    color: 'white',
                    confirmButtonColor: '#ef4444',
                    customClass: { container: 'swal-high-zindex' }
                });
            }
        },
        error: function(xhr, status, error) {
            console.log('Error Response:', xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor. Línea de error: ' + error,
                background: '#1a1f2e',
                color: 'white',
                confirmButtonColor: '#ef4444',
                customClass: { container: 'swal-high-zindex' }
            });
        }
    });
}

function abrirModalStats(cod_coordinador, tipo) {
    const modal = document.getElementById('modalStatsDetalles');
    const content = document.getElementById('modalStatsContent');
    const title = document.getElementById('modalStatsTitle');
    const header = document.getElementById('modalStatsHeader');
    
    // Configurar título e ícono
    let icon = '';
    let label = '';
    let colorStart = '#8b5cf6';
    let colorEnd = '#7c3aed';

    if (tipo === 'asesores') {
        icon = '<i class="fa-solid fa-user-tie"></i>';
        label = 'Mis Asesores';
        colorStart = '#3b82f6';
        colorEnd = '#2563eb';
    } else if (tipo === 'aliados') {
        icon = '<i class="fa-solid fa-users"></i>';
        label = 'Mis Aliados';
        colorStart = '#8b5cf6';
        colorEnd = '#7c3aed';
    } else if (tipo === 'tiendas') {
        icon = '<i class="fa-solid fa-store"></i>';
        label = 'Mis Tiendas';
        colorStart = '#10b981';
        colorEnd = '#059669';
    }

    title.innerHTML = `${icon} ${label}`;
    header.style.background = `linear-gradient(135deg, ${colorStart} 0%, ${colorEnd} 100%)`;
    content.innerHTML = `
        <div style="text-align: center; padding: 3rem; color: rgba(255,255,255,0.5);">
            <i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 1rem;"></i>
            <p>Cargando información...</p>
        </div>
    `;
    modal.style.display = 'flex';

    $.ajax({
        url: 'get_stats_detalles_coordinador_ajax.php',
        type: 'POST',
        data: { cod_coordinador: cod_coordinador, tipo: tipo },
        success: function(response) {
            content.innerHTML = response;
        },
        error: function() {
            content.innerHTML = `
                <div style="text-align: center; padding: 2rem; color: #ef4444;">
                    <i class="fa-solid fa-circle-exclamation" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>No se pudo cargar la información</p>
                </div>
            `;
        }
    });
}

function cerrarModalStats() {
    document.getElementById('modalStatsDetalles').style.display = 'none';
}
</script>

</body>
</html>
