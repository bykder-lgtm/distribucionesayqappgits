<?php 
$nombre_pagina          = "Dashboard Asesor";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_asesor.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_asesor.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($nombre) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<!-- Favicon -->
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<!-- jQuery -->
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<!-- Chart.js para gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<script src="../js/sweetalert2.min_adm_tick.js"></script>
<style>
/* ============================================ */
/* DASHBOARD ASESOR - TEMA VERDE ESMERALDA     */
/* ============================================ */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
    min-height: 100vh;
}

.dashboard-container {
    padding: 1rem;
    padding-bottom: 100px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Header del Dashboard */
.dashboard-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(16, 185, 129, 0.4);
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.dashboard-header::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(52, 211, 153, 0.2) 0%, transparent 70%);
    border-radius: 50%;
}

.dashboard-header h1 {
    color: white;
    font-size: 1.5rem;
    font-weight: 800;
    margin: 0 0 0.5rem 0;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.dashboard-header p {
    color: rgba(255,255,255,0.9);
    font-size: 0.9rem;
    margin: 0;
    position: relative;
    z-index: 2;
}

.dashboard-date {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 25px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
    font-size: 0.85rem;
    color: white;
    position: relative;
    z-index: 2;
}

.dashboard-welcome {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.85);
    margin-top: 0.5rem;
}

/* KPI Cards */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.kpi-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 16px;
    padding: 1.25rem;
    border: 1px solid rgba(16, 185, 129, 0.3);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2);
    border-color: rgba(16, 185, 129, 0.5);
}

.kpi-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.3) 0%, transparent 100%);
    border-radius: 0 16px 0 60px;
}

.kpi-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    margin-bottom: 0.75rem;
}

.kpi-icon.primary {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.kpi-icon.success {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
}

.kpi-icon.warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
}

.kpi-icon.info {
    background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(20, 184, 166, 0.4);
}

.kpi-icon.purple {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
}

.kpi-label {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.7);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
}

.kpi-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: white;
    line-height: 1.2;
}

.kpi-change {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.75rem;
    margin-top: 0.5rem;
    padding: 0.2rem 0.5rem;
    border-radius: 12px;
}

.kpi-change.positive {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.kpi-change.negative {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.quick-action-btn {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 16px;
    padding: 1rem 0.5rem;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.quick-action-btn:hover {
    border-color: #10b981;
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(16, 185, 129, 0.2);
    text-decoration: none;
}

.quick-action-btn i {
    font-size: 1.5rem;
    display: block;
    margin-bottom: 0.5rem;
}

.quick-action-btn span {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    font-weight: 600;
}

.qa-tiendas i { color: #10b981; }
.qa-productos i { color: #14b8a6; }
.qa-creditos i { color: #22c55e; }
.qa-reportes i { color: #f59e0b; }

/* Chart Cards */
.chart-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(16, 185, 129, 0.3);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.25rem;
}

.chart-title {
    font-size: 1rem;
    font-weight: 700;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.chart-title i {
    color: #10b981;
}

.chart-badge {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    font-size: 0.7rem;
    padding: 0.3rem 0.75rem;
    border-radius: 15px;
    font-weight: 600;
}

.chart-container {
    position: relative;
    height: 250px;
}

/* Activity Card */
.activity-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(16, 185, 129, 0.15);
}

.activity-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.activity-item:first-child {
    padding-top: 0;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.activity-icon.new {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    color: white;
}

.activity-icon.pending {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

.activity-icon.completed {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: white;
    margin-bottom: 0.25rem;
}

.activity-desc {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.6);
}

.activity-time {
    font-size: 0.7rem;
    color: rgba(255,255,255,0.5);
    white-space: nowrap;
}

/* Bottom Navigation */
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-top: 1px solid rgba(16, 185, 129, 0.2);
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
    color: #10b981;
    text-decoration: none;
}

.nav-item.active {
    background: rgba(16, 185, 129, 0.1);
}

.nav-item i {
    font-size: 1.25rem;
    margin-bottom: 0.25rem;
}

.nav-item span {
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    margin-top: 1rem;
}

.stat-item {
    text-align: center;
    padding: 0.75rem;
    background: rgba(16, 185, 129, 0.1);
    border-radius: 12px;
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.stat-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: #10b981;
}

.stat-label {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.6);
    text-transform: uppercase;
    margin-top: 0.25rem;
}

/* Responsive */
@media (min-width: 768px) {
    .kpi-grid {
        grid-template-columns: repeat(4, 1fr);
    }
    
    .dashboard-header h1 {
        font-size: 2rem;
    }
    
    .kpi-value {
        font-size: 1.8rem;
    }
}

/* Animations */
@keyframes fadeInUp {
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
    animation: fadeInUp 0.5s ease forwards;
}

.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }
.delay-3 { animation-delay: 0.3s; }
.delay-4 { animation-delay: 0.4s; }
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Obtener datos para el dashboard
$fecha_hoy = date("Y-m-d");
$mes_actual = date("Y-m");
$mes_anterior = date("Y-m", strtotime("-1 month"));

$sql_obtener_aliados = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$resultado_aliados = mysqli_query($conectar, $sql_obtener_aliados);
$datos_aliados = mysqli_fetch_assoc($resultado_aliados);
$total_aliados = isset($datos_aliados['total']) ? $datos_aliados['total'] : 0;
// === CONSULTAS PARA KPIs ===
// Total Tiendas del asesor
$sql_tiendas = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_administrador = '$cod_administrador' AND cod_estado != '0'";
$resultado_tiendas = mysqli_query($conectar, $sql_tiendas);
$datos_tiendas = mysqli_fetch_assoc($resultado_tiendas);
$total_tiendas = isset($datos_tiendas['total']) ? $datos_tiendas['total'] : 0;

// Total Créditos Activos (Estado ABIERTA) de tiendas del asesor
$sql_creditos_activos = "SELECT COUNT(*) as total, COALESCE(SUM(monto_deuda), 0) as valor_total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
WHERE ifv.cod_administrador_asesor = '$cod_administrador' AND ifv.nombre_estado_factura = 'ABIERTA' AND t.cod_estado != '0'";
$resultado_activos = mysqli_query($conectar, $sql_creditos_activos);
$datos_activos = mysqli_fetch_assoc($resultado_activos);
$total_creditos_activos = isset($datos_activos['total']) ? $datos_activos['total'] : 0;
$valor_cartera = isset($datos_activos['valor_total']) ? $datos_activos['valor_total'] : 0;

// Créditos cerrados (Estado CERRADA)
$sql_creditos_cerrados = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
WHERE ifv.cod_administrador_asesor = '$cod_administrador' AND ifv.nombre_estado_factura = 'CERRADA' AND t.cod_estado != '0'";
$resultado_cerrados = mysqli_query($conectar, $sql_creditos_cerrados);
$datos_cerrados = mysqli_fetch_assoc($resultado_cerrados);
$total_creditos_cerrados = isset($datos_cerrados['total']) ? $datos_cerrados['total'] : 0;

// Créditos nuevos del mes actual
$sql_creditos_mes = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
WHERE ifv.cod_administrador_asesor = '$cod_administrador' AND DATE_FORMAT(ifv.fecha_creacion, '%Y-%m') = '$mes_actual' AND t.cod_estado != '0'";
$resultado_mes = mysqli_query($conectar, $sql_creditos_mes);
$datos_mes = mysqli_fetch_assoc($resultado_mes);
$creditos_mes_actual = isset($datos_mes['total']) ? $datos_mes['total'] : 0;

// Créditos del mes anterior (para comparación)
$sql_creditos_mes_ant = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
WHERE ifv.cod_administrador_asesor = '$cod_administrador' AND DATE_FORMAT(ifv.fecha_creacion, '%Y-%m') = '$mes_anterior' AND t.cod_estado != '0'";
$resultado_mes_ant = mysqli_query($conectar, $sql_creditos_mes_ant);
$datos_mes_ant = mysqli_fetch_assoc($resultado_mes_ant);
$creditos_mes_anterior = isset($datos_mes_ant['total']) ? $datos_mes_ant['total'] : 0;

// Calcular porcentaje de cambio
$cambio_porcentaje = 0;
if ($creditos_mes_anterior > 0) { $cambio_porcentaje = round((($creditos_mes_actual - $creditos_mes_anterior) / $creditos_mes_anterior) * 100, 1); }

// Notificaciones pendientes
$sql_notificaciones = "SELECT COUNT(*) as total FROM tbl15_notificacion_alerta_renovacion WHERE cod_administrador = '$cod_administrador' AND cod_estado = '0'";
$resultado_notif = mysqli_query($conectar, $sql_notificaciones);
$datos_notif = mysqli_fetch_assoc($resultado_notif);
$total_notificaciones = isset($datos_notif['total']) ? $datos_notif['total'] : 0;

// Tiendas registradas este mes
$sql_tiendas_mes = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_administrador = '$cod_administrador' AND DATE_FORMAT(fecha_creacion, '%Y-%m') = '$mes_actual' AND cod_estado != '0'";
$resultado_tiendas_mes = mysqli_query($conectar, $sql_tiendas_mes);
$datos_tiendas_mes = mysqli_fetch_assoc($resultado_tiendas_mes);
$tiendas_mes_actual = isset($datos_tiendas_mes['total']) ? $datos_tiendas_mes['total'] : 0;

// === DATOS PARA GRÁFICOS ===
// Tendencia de créditos últimos 6 meses
$tendencia_labels = [];
$tendencia_valores = [];
for ($i = 5; $i >= 0; $i--) {
    $mes = date("Y-m", strtotime("-$i months"));
    $nombre_mes = date("M", strtotime("-$i months"));
    
    $sql_tendencia = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv     INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
    WHERE ifv.cod_administrador_asesor = '$cod_administrador' AND DATE_FORMAT(ifv.fecha_creacion, '%Y-%m') = '$mes' AND t.cod_estado != '0'";
    $resultado_tendencia = mysqli_query($conectar, $sql_tendencia);
    $datos_tendencia = mysqli_fetch_assoc($resultado_tendencia);
    
    $tendencia_labels[] = $nombre_mes;
    $tendencia_valores[] = isset($datos_tendencia['total']) ? $datos_tendencia['total'] : 0;
}

// Últimas tiendas registradas
$sql_ultimas_tiendas = "SELECT cod_tienda, nombre_tienda, fecha_creacion, abrev_tienda FROM tbl15_tienda WHERE cod_administrador = '$cod_administrador' AND cod_estado != '0' ORDER BY fecha_creacion DESC LIMIT 5";
$resultado_ultimas_tiendas = mysqli_query($conectar, $sql_ultimas_tiendas);

// Nombre del mes en español
$meses_esp = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$mes_nombre = $meses_esp[date('n') - 1];
$anio = date('Y');
?>

<main class="dashboard-container">
    <!-- Header del Dashboard -->
    <div class="dashboard-header animate-in">
        <h1><i class="fa-solid fa-chart-pie"></i> Dashboard Asesor</h1>
        <p>Bienvenido, <?php echo ucwords(strtolower($nombres_usuario . ' ' . $apellidos_usuario)); ?></p>
        <div class="dashboard-date">
            <i class="fa-regular fa-calendar"></i>
            <?php echo "$mes_nombre $anio"; ?>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="quick-actions animate-in delay-1">
        <a href="lista_tienda_asesor_movil.php" class="quick-action-btn qa-tiendas">
            <i class="fa-solid fa-store"></i>
            <span>Tiendas</span>
        </a>
        <a href="lista_producto_asesor_movil.php" class="quick-action-btn qa-productos">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span>Productos</span>
        </a>
        <a href="lista_info_factura_venta_asesor_movil.php" class="quick-action-btn qa-creditos">
            <i class="fa-solid fa-credit-card"></i>
            <span>Créditos</span>
        </a>
        <a href="reporte_ventas_asesor_movil.php" class="quick-action-btn qa-reportes">
            <i class="fa-solid fa-chart-bar"></i>
            <span>Reportes</span>
        </a>
    </div>

    <!-- KPI Cards -->
    <div class="kpi-grid">
        <div class="kpi-card animate-in delay-1">
            <div class="kpi-icon primary">
                <i class="fa-solid fa-store"></i>
            </div>
            <div class="kpi-label">Mis Tiendas</div>
            <div class="kpi-value"><?php echo number_format($total_tiendas); ?></div>
            <?php if ($tiendas_mes_actual > 0): ?>
            <div class="kpi-change positive">
                <i class="fa-solid fa-plus"></i> <?php echo $tiendas_mes_actual; ?> este mes
            </div>
            <?php endif; ?>
        </div>

        <div class="kpi-card animate-in delay-2">
            <div class="kpi-icon success">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <div class="kpi-label">Valor en Cartera</div>
            <div class="kpi-value">$<?php echo number_format($valor_cartera / 1000000, 1); ?>M</div>
        </div>

        <div class="kpi-card animate-in delay-3">
            <div class="kpi-icon warning">
                <i class="fa-solid fa-file-invoice"></i>
            </div>
            <div class="kpi-label">Créditos Activos</div>
            <div class="kpi-value"><?php echo number_format($total_creditos_activos); ?></div>
            <?php if ($cambio_porcentaje != 0): ?>
            <div class="kpi-change <?php echo $cambio_porcentaje >= 0 ? 'positive' : 'negative'; ?>">
                <i class="fa-solid fa-<?php echo $cambio_porcentaje >= 0 ? 'arrow-up' : 'arrow-down'; ?>"></i>
                <?php echo abs($cambio_porcentaje); ?>%
            </div>
            <?php endif; ?>
        </div>

        <div class="kpi-card animate-in delay-4">
            <div class="kpi-icon info">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="kpi-label">Finalizados</div>
            <div class="kpi-value"><?php echo number_format($total_creditos_cerrados); ?></div>
        </div>
    </div>

    <?php if ($total_notificaciones > 0): ?>
    <!-- Alerta de Notificaciones -->
    <div class="chart-card animate-in" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(239, 68, 68, 0.1) 100%); border-color: rgba(245, 158, 11, 0.3);">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-bell" style="font-size: 1.5rem; color: white;"></i>
            </div>
            <div>
                <h4 style="color: #f59e0b; font-size: 1rem; margin: 0;"><?php echo $total_notificaciones; ?> Notificaciones</h4>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin: 0.25rem 0 0 0;">Tienes alertas pendientes por revisar</p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Gráfico de Tendencia -->
     <!--
    <div class="chart-card animate-in">
        <div class="chart-header">
            <div class="chart-title"><i class="fa-solid fa-chart-line"></i>Tendencia de Créditos</div>
            <span class="chart-badge">Últimos 6 meses</span>
        </div>
        <div class="chart-container"><canvas id="trendChart"></canvas></div>
    </div>
    -->

    <!-- Últimas Tiendas -->
    <div class="activity-card animate-in">
        <div class="chart-header">
            <div class="chart-title">
                <i class="fa-solid fa-store"></i>
                Últimas Tiendas Registradas
            </div>
        </div>
        
        <?php 
        if (mysqli_num_rows($resultado_ultimas_tiendas) > 0):
            while ($tienda = mysqli_fetch_assoc($resultado_ultimas_tiendas)): 
                $fecha_tienda = date('d M Y', strtotime($tienda['fecha_creacion']));
        ?>
        <div class="activity-item">
            <div class="activity-icon new">
                <i class="fa-solid fa-store"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title"><?php echo ucwords(strtolower($tienda['nombre_tienda'])); ?></div>
                <div class="activity-desc"><?php echo $tienda['abrev_tienda']; ?></div>
            </div>
            <div class="activity-time"><?php echo $fecha_tienda; ?></div>
        </div>
        <?php 
            endwhile;
        else:
        ?>
        <div style="text-align: center; padding: 2rem;">
            <i class="fa-solid fa-inbox" style="font-size: 2rem; color: rgba(255,255,255,0.3);"></i>
            <p style="color: rgba(255,255,255,0.5); margin-top: 0.5rem;">No hay tiendas registradas</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Estadísticas adicionales -->
    <div class="chart-card animate-in">
        <div class="chart-header">
            <div class="chart-title">
                <i class="fa-solid fa-chart-pie"></i>
                Resumen General
            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value"><?php echo number_format($total_tiendas); ?></div>
                <div class="stat-label">Tiendas</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo number_format($total_creditos_activos + $total_creditos_cerrados); ?></div>
                <div class="stat-label">Total Créditos</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo $total_notificaciones; ?></div>
                <div class="stat-label">Alertas</div>
            </div>
        </div>
    </div>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

<script>
// Configuración global de Chart.js para tema oscuro
Chart.defaults.color = 'rgba(255, 255, 255, 0.7)';
Chart.defaults.borderColor = 'rgba(16, 185, 129, 0.2)';

// Gráfico de tendencia
const trendChartEl = document.getElementById('trendChart');
if (trendChartEl) {
    const trendCtx = trendChartEl.getContext('2d');
    const gradient = trendCtx.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(16, 185, 129, 0.5)');
    gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($tendencia_labels); ?>,
            datasets: [{
                label: 'Créditos',
                data: <?php echo json_encode($tendencia_valores); ?>,
                borderColor: '#10b981',
                backgroundColor: gradient,
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(16, 185, 129, 0.1)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}
</script>

<!-- ====================== SISTEMA DE NOTIFICACIONES ====================== -->
<style>
/* Botón flotante de notificaciones - Móvil */
.notification-bell-movil {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(16, 185, 129, 0.5);
    z-index: 9999;
    transition: all 0.3s ease;
    border: none;
}

.notification-bell-movil:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 30px rgba(16, 185, 129, 0.7);
}

.notification-bell-movil i {
    font-size: 22px;
    color: white;
}

.notification-bell-movil.has-notifications {
    animation: bellPulseMovil 2s infinite;
}

.notification-badge-movil {
    position: absolute;
    top: -5px;
    right: -5px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    font-size: 11px;
    font-weight: 700;
    min-width: 22px;
    height: 22px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 5px;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.5);
}

@keyframes bellPulseMovil {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes bellShakeMovil {
    0%, 100% { transform: rotate(0); }
    25% { transform: rotate(15deg); }
    75% { transform: rotate(-15deg); }
}

.notification-bell-movil.shake i {
    animation: bellShakeMovil 0.5s ease;
}

/* Panel de notificaciones - Móvil */
.notification-panel-movil {
    position: fixed;
    bottom: 155px;
    right: 15px;
    width: calc(100% - 30px);
    max-width: 380px;
    max-height: 400px;
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    z-index: 9998;
    display: none;
    overflow: hidden;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.notification-panel-movil.show {
    display: block;
    animation: slideUpMovil 0.3s ease;
}

@keyframes slideUpMovil {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.notification-header-movil {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 15px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.notification-header-movil h4 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.notification-header-actions-movil {
    display: flex;
    gap: 8px;
}

.notification-header-actions-movil button {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 11px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.notification-header-actions-movil button:hover {
    background: rgba(255, 255, 255, 0.3);
}

.notification-list-movil {
    max-height: 320px;
    overflow-y: auto;
}

.notification-item-movil {
    padding: 14px 18px;
    border-bottom: 1px solid rgba(16, 185, 129, 0.15);
    cursor: pointer;
    transition: background 0.2s ease;
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.notification-item-movil:hover {
    background: rgba(16, 185, 129, 0.1);
}

.notification-item-movil:last-child {
    border-bottom: none;
}

.notification-icon-movil {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 14px;
}

.notification-icon-movil.type-1 {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.notification-icon-movil.type-2 {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

.notification-icon-movil.type-3 {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
}

.notification-content-movil {
    flex: 1;
    min-width: 0;
}

.notification-title-movil {
    font-size: 13px;
    font-weight: 600;
    color: white;
    margin-bottom: 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.notification-desc-movil {
    font-size: 12px;
    color: rgba(255,255,255,0.6);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.notification-time-movil {
    font-size: 10px;
    color: rgba(16, 185, 129, 0.8);
    margin-top: 5px;
}

.notification-empty-movil {
    padding: 40px 20px;
    text-align: center;
    color: rgba(255,255,255,0.5);
}

.notification-empty-movil i {
    font-size: 40px;
    margin-bottom: 12px;
    display: block;
    color: rgba(16, 185, 129, 0.4);
}

.notification-empty-movil p {
    margin: 0;
    font-size: 14px;
}
</style>

<!-- Botón flotante de notificaciones -->
<button class="notification-bell-movil" id="notificationBellMovil" onclick="toggleNotificationPanelMovil()">
    <i class="fa-solid fa-bell"></i>
    <span class="notification-badge-movil" id="notificationBadgeMovil" style="display: none;">0</span>
</button>

<!-- Panel de notificaciones -->
<div class="notification-panel-movil" id="notificationPanelMovil">
    <div class="notification-header-movil">
        <h4><i class="fa-solid fa-bell"></i> Notificaciones</h4>
        <div class="notification-header-actions-movil">
            <button onclick="marcarTodasLeidasMovil()" title="Marcar todas como leídas">
                <i class="fa-solid fa-check-double"></i> Leer todas
            </button>
            <button onclick="toggleNotificationPanelMovil()" title="Cerrar">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
    </div>
    <div class="notification-list-movil" id="notificationListMovil">
        <div class="notification-empty-movil">
            <i class="fa-solid fa-bell-slash"></i>
            <p>No hay notificaciones pendientes</p>
        </div>
    </div>
</div>

<script>
// ====================== SISTEMA DE NOTIFICACIONES MÓVIL ======================
var notificationCheckIntervalMovil = null;

// Inicializar sistema de notificaciones
$(document).ready(function() {
    cargarNotificacionesMovil();
    // Revisar notificaciones cada 30 segundos
    notificationCheckIntervalMovil = setInterval(cargarNotificacionesMovil, 30000);
});

// Cargar notificaciones desde el servidor
function cargarNotificacionesMovil() {
    $.ajax({
        url: '../admin/obtener_notificaciones_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                actualizarUINotificacionesMovil(response.notificaciones, response.count);
            }
        },
        error: function() {
            console.log('Error al cargar notificaciones');
        }
    });
}

// Actualizar la interfaz con las notificaciones
function actualizarUINotificacionesMovil(notificaciones, count) {
    var $badge = $('#notificationBadgeMovil');
    var $bell = $('#notificationBellMovil');
    var $list = $('#notificationListMovil');
    
    // Actualizar badge
    if (count > 0) {
        $badge.text(count > 99 ? '99+' : count).show();
        $bell.addClass('has-notifications');
        
        // Efecto de shake si hay nuevas notificaciones
        if (!$bell.hasClass('notified')) {
            $bell.addClass('shake notified');
            setTimeout(function() { $bell.removeClass('shake'); }, 500);
        }
    } else {
        $badge.hide();
        $bell.removeClass('has-notifications notified');
    }
    
    // Actualizar lista
    if (notificaciones.length > 0) {
        var html = '';
        notificaciones.forEach(function(notif) {
            var iconClass = 'type-' + (notif.tipo || 1);
            var iconSymbol = getNotificationIconMovil(notif.tipo);
            
            html += '<div class="notification-item-movil" onclick="marcarNotificacionLeidaMovil(' + notif.id + ', this)">';
            html += '  <div class="notification-icon-movil ' + iconClass + '"><i class="fa-solid ' + iconSymbol + '"></i></div>';
            html += '  <div class="notification-content-movil">';
            html += '    <div class="notification-title-movil">' + escapeHtmlMovil(notif.titulo) + '</div>';
            html += '    <div class="notification-desc-movil">' + escapeHtmlMovil(notif.descripcion) + '</div>';
            html += '    <div class="notification-time-movil"><i class="fa-regular fa-clock"></i> ' + notif.fecha_corta + '</div>';
            html += '  </div>';
            html += '</div>';
        });
        $list.html(html);
    } else {
        $list.html('<div class="notification-empty-movil"><i class="fa-solid fa-bell-slash"></i><p>No hay notificaciones pendientes</p></div>');
    }
}

// Obtener icono según el tipo de notificación
function getNotificationIconMovil(tipo) {
    switch(parseInt(tipo)) {
        case 1: return 'fa-signature'; // Firma
        case 2: return 'fa-exclamation-circle'; // Alerta
        case 3: return 'fa-info-circle'; // Info
        default: return 'fa-bell';
    }
}

// Toggle del panel de notificaciones
function toggleNotificationPanelMovil() {
    var $panel = $('#notificationPanelMovil');
    $panel.toggleClass('show');
}

// Cerrar panel al hacer clic fuera
$(document).on('click', function(e) {
    if (!$(e.target).closest('#notificationPanelMovil, #notificationBellMovil').length) {
        $('#notificationPanelMovil').removeClass('show');
    }
});

// Marcar una notificación como leída
function marcarNotificacionLeidaMovil(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php',
        type: 'POST',
        data: { cod_notificacion: codNotificacion },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Remover el elemento con animación
                $(element).fadeOut(300, function() {
                    $(this).remove();
                    // Recargar notificaciones
                    cargarNotificacionesMovil();
                });
            }
        }
    });
}

// Marcar todas las notificaciones como leídas
function marcarTodasLeidasMovil() {
    Swal.fire({
        title: '¿Marcar todas como leídas?',
        text: 'Se marcarán todas las notificaciones pendientes como leídas',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, marcar todas',
        cancelButtonText: 'Cancelar',
        background: '#1a1f2e',
        color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/marcar_notificacion_leida_ajax.php',
                type: 'POST',
                data: { marcar_todas: 'si' },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarNotificacionesMovil();
                        Swal.fire({
                            icon: 'success',
                            title: '¡Listo!',
                            text: 'Todas las notificaciones han sido marcadas como leídas',
                            timer: 2000,
                            showConfirmButton: false,
                            background: '#1a1f2e',
                            color: 'white'
                        });
                    }
                }
            });
        }
    });
}

// Escapar HTML para seguridad
function escapeHtmlMovil(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}
</script>

</body>
</html>

