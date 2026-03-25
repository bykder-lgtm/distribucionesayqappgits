<?php 
$nombre_pagina          = "Dashboard Aliado";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<!-- Chart.js para gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<style><?php include_once("../estilo_css/estilo_dashboard_aliado.css"); ?></style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<?php
// Obtener datos para el dashboard
$fecha_hoy = date("Y-m-d");
$mes_actual = date("Y-m");
$mes_anterior = date("Y-m", strtotime("-1 month"));
// === CONSULTAS PARA KPIs ===
// Total Créditos Activos (Estado ABIERTA)
$sql_creditos_activos = "SELECT COUNT(*) as total, COALESCE(SUM(ifv.monto_deuda), 0) as valor_total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda WHERE ifv.cod_administrador_aliado_estrategico = '$cod_administrador' AND ifv.nombre_estado_factura = 'ABIERTA' AND t.cod_estado != '0'";
$resultado_activos = mysqli_query($conectar, $sql_creditos_activos);
$datos_activos = mysqli_fetch_assoc($resultado_activos);
$total_creditos_activos                                             = isset($datos_activos['total']) ? $datos_activos['total'] : 0;
$valor_cartera                                                      = isset($datos_activos['valor_total']) ? $datos_activos['valor_total'] : 0;
// Créditos cerrados (Estado CERRADA)
$sql_creditos_cerrados = "SELECT COUNT(*) as total, COALESCE(SUM(ifv.monto_deuda), 0) as valor_total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda WHERE ifv.cod_administrador_aliado_estrategico = '$cod_administrador' AND ifv.nombre_estado_factura = 'CERRADA' AND t.cod_estado != '0'";
$resultado_cerrados = mysqli_query($conectar, $sql_creditos_cerrados);
$datos_cerrados = mysqli_fetch_assoc($resultado_cerrados);
$total_creditos_cerrados                                            = isset($datos_cerrados['total']) ? $datos_cerrados['total'] : 0;
// Créditos del mes actual
$sql_creditos_mes = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda WHERE ifv.cod_administrador_aliado_estrategico = '$cod_administrador' AND DATE_FORMAT(ifv.fecha_creacion, '%Y-%m') = '$mes_actual' AND t.cod_estado != '0'";
$resultado_mes = mysqli_query($conectar, $sql_creditos_mes);
$datos_mes = mysqli_fetch_assoc($resultado_mes);
$creditos_mes_actual                                                = isset($datos_mes['total']) ? $datos_mes['total'] : 0;
// Créditos del mes anterior (para comparación)
$sql_creditos_mes_ant = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda WHERE ifv.cod_administrador_aliado_estrategico = '$cod_administrador' AND DATE_FORMAT(ifv.fecha_creacion, '%Y-%m') = '$mes_anterior' AND t.cod_estado != '0'";
$resultado_mes_ant = mysqli_query($conectar, $sql_creditos_mes_ant);
$datos_mes_ant = mysqli_fetch_assoc($resultado_mes_ant);
$creditos_mes_anterior                                              = isset($datos_mes_ant['total']) ? $datos_mes_ant['total'] : 0;
// Calcular porcentaje de cambio
$cambio_porcentaje = 0;
if ($creditos_mes_anterior > 0) { $cambio_porcentaje = round((($creditos_mes_actual - $creditos_mes_anterior) / $creditos_mes_anterior) * 100, 1); }
// Productos en catálogo
$sql_productos = "SELECT COUNT(*) as total FROM tbl15_catalogo_producto cp INNER JOIN tbl15_tienda t ON cp.cod_tienda = t.cod_tienda WHERE cp.cod_administrador_aliado_estrategico = '$cod_administrador' AND cp.cod_estado = '1' AND t.cod_estado != '0'";
$resultado_productos = mysqli_query($conectar, $sql_productos);
$total_productos                                                    = 0;
if ($resultado_productos) { $datos_productos = mysqli_fetch_assoc($resultado_productos); $total_productos = isset($datos_productos['total']) ? $datos_productos['total'] : 0; }
// === DATOS PARA GRÁFICOS ===
// Créditos por estado de facturación
$sql_por_estado = "SELECT ef.nombre_estado_facturacion, COUNT(*) as cantidad FROM tbl15_info_factura_venta ifv 
INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda
LEFT JOIN tbl15_estado_facturacion ef ON ifv.codigo_estado_facturacion = ef.codigo_estado_facturacion WHERE ifv.cod_administrador_aliado_estrategico = '$cod_administrador' AND t.cod_estado != '0' GROUP BY ef.nombre_estado_facturacion ORDER BY cantidad DESC LIMIT 6";
$resultado_por_estado = mysqli_query($conectar, $sql_por_estado);
$estados_labels                                                     = [];
$estados_valores                                                    = [];

while ($row = mysqli_fetch_assoc($resultado_por_estado)) { $estados_labels[] = isset($row['nombre_estado_facturacion']) ? $row['nombre_estado_facturacion'] : 'Sin estado'; $estados_valores[] = $row['cantidad']; }
// Créditos por entidad crediticia
$sql_por_entidad = "SELECT ec.nombre_entidad_crediticia, COUNT(*) as cantidad, SUM(ifv.monto_deuda) as valor FROM tbl15_info_factura_venta ifv
INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda
LEFT JOIN tbl15_entidad_crediticia ec ON ifv.cod_entidad_crediticia = ec.cod_entidad_crediticia WHERE ifv.cod_administrador_aliado_estrategico = '$cod_administrador' AND t.cod_estado != '0' GROUP BY ec.nombre_entidad_crediticia ORDER BY cantidad DESC LIMIT 5";
$resultado_por_entidad = mysqli_query($conectar, $sql_por_entidad);
$entidades_labels                                                   = [];
$entidades_valores                                                  = [];
while ($row = mysqli_fetch_assoc($resultado_por_entidad)) {
    $entidades_labels[] = isset($row['nombre_entidad_crediticia']) ? $row['nombre_entidad_crediticia'] : 'Sin entidad';
    $entidades_valores[] = $row['cantidad'];
}
// Tendencia de los últimos 6 meses
$tendencia_labels                                                   = [];
$tendencia_valores                                                  = [];
for ($i = 5; $i >= 0; $i--) {
    $mes                                                            = date("Y-m", strtotime("-$i months"));
    $nombre_mes                                                     = date("M", strtotime("-$i months"));
    
    $sql_tendencia = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda WHERE ifv.cod_administrador_aliado_estrategico = '$cod_administrador' AND DATE_FORMAT(ifv.fecha_creacion, '%Y-%m') = '$mes' AND t.cod_estado != '0'";
    $resultado_tendencia = mysqli_query($conectar, $sql_tendencia);
    $datos_tendencia = mysqli_fetch_assoc($resultado_tendencia);
    
    $tendencia_labels[]                                             = $nombre_mes;
    $tendencia_valores[]                                            = isset($datos_tendencia['total']) ? $datos_tendencia['total'] : 0;
}
// Últimas actividades (últimos créditos registrados)
$sql_ultimas = "SELECT ifv.cod_info_factura_venta, ifv.monto_deuda, ifv.fecha_ymdhis, ifv.nombre_estado_factura, t.nombre1_tercero, t.apellido1_tercero, t.identificacion_tercero, ef.nombre_estado_facturacion
FROM tbl15_info_factura_venta ifv 
INNER JOIN tbl15_tienda tienda ON ifv.cod_tienda = tienda.cod_tienda
LEFT JOIN tbl15_tercero t ON ifv.cod_tercero = t.cod_tercero 
LEFT JOIN tbl15_estado_facturacion ef ON ifv.codigo_estado_facturacion = ef.codigo_estado_facturacion
WHERE ifv.cod_administrador_aliado_estrategico = '$cod_administrador' AND tienda.cod_estado != '0' ORDER BY ifv.fecha_ymdhis DESC LIMIT 5";
$resultado_ultimas = mysqli_query($conectar, $sql_ultimas);

// Alertas pendientes
$sql_alertas = "SELECT COUNT(*) as total FROM tbl15_notificacion_alerta_renovacion nar INNER JOIN tbl15_info_factura_venta ifv ON nar.cod_info_factura_venta = ifv.cod_info_factura_venta
WHERE ifv.cod_administrador_aliado_estrategico = '$cod_administrador' AND nar.cod_estado = '0'";
$resultado_alertas = mysqli_query($conectar, $sql_alertas);
$datos_alertas = mysqli_fetch_assoc($resultado_alertas);
$total_alertas                                                      = isset($datos_alertas['total']) ? $datos_alertas['total'] : 0;
// Nombre del mes en español
$meses_esp = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$mes_nombre = $meses_esp[date('n') - 1];
$anio = date('Y');

// --- DATOS USUARIO PRUEBA ---
$sql_user_prueba = "SELECT cod_estado_usuario_prueba FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$res_user_prueba = mysqli_query($conectar, $sql_user_prueba);
$data_user_prueba = mysqli_fetch_assoc($res_user_prueba);
$es_prueba = ($data_user_prueba['cod_estado_usuario_prueba'] == '1');
$creditos_restantes = 0;
if ($es_prueba) {
    $total_creados = $total_creditos_activos + $total_creditos_cerrados;
    $creditos_restantes = 3 - $total_creados;
    if ($creditos_restantes < 0) $creditos_restantes = 0;
}
?>

<main class="dashboard-container">
    <!-- Header del Dashboard -->
    <div class="dashboard-header animate-in">
        <h1><i class="fa fa-chart-line"></i> Dashboard</h1>
        <p>Resumen ejecutivo de tu negocio</p>
        <div class="dashboard-date"><i class="fa fa-calendar"></i><?php echo "$mes_nombre $anio"; ?></div>
    </div>

    <?php if ($es_prueba): ?>
    <!-- Alerta Usuario de Prueba -->
    <div class="animate-in" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 20px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3); position: relative; overflow: hidden;">
        <div style="position: absolute; right: -20px; top: -20px; font-size: 8rem; color: rgba(255,255,255,0.1); transform: rotate(15deg);">
            <i class="fa fa-bolt"></i>
        </div>
        <div style="position: relative; z-index: 2;">
            <h3 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.25rem; font-weight: 800; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fa fa-info-circle"></i> Cuenta de Prueba
            </h3>
            <p style="color: rgba(255,255,255,0.9); font-size: 0.95rem; margin-bottom: 1rem; line-height: 1.4;">
                Tienes una cuenta limitada. Te quedan <strong><?php echo $creditos_restantes; ?> créditos</strong> disponibles.
            </p>
            <div style="background: rgba(255,255,255,0.2); height: 8px; border-radius: 4px; margin-bottom: 1rem;">
                <div style="background: white; height: 100%; border-radius: 4px; width: <?php echo ($total_creados / 3) * 100; ?>%;"></div>
            </div>
            <a href="perfil_aliado_movil.php" style="display: inline-flex; align-items: center; gap: 0.5rem; background: white; color: #d97706; padding: 0.75rem 1.25rem; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: all 0.3s ease;">
                Completar Información <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Acciones Rápidas -->
    <div class="quick-actions animate-in delay-1">
        <a href="../admin/simulador_credito_visitante_intern_interes_max_entidad_crediticia_libre_aliado_movil.php" class="quick-action-btn qa-simulador"><i class="fa fa-calculator"></i><span>Simular</span></a>
        <!--<a href="../admin/lista_catalogo_productos_aliado_movil_visitante_intern.php" class="quick-action-btn qa-catalogo"><i class="fa fa-th-large"></i><span>Catálogo</span></a>-->
        <a href="../admin/lista_info_factura_venta_siscredito_visitante_intern_aliado_movil.php" class="quick-action-btn qa-creditos"><i class="fa fa-credit-card"></i><span>Créditos</span></a>
        <a href="../admin/lista_tiendas_aliado_movil.php" class="quick-action-btn qa-tienda"><i class="fa fa-shopping-bag"></i><span>Tienda</span></a>
    </div>

    <!-- KPI Cards -->
    <div class="kpi-grid">
        <div class="kpi-card animate-in delay-1">
            <div class="kpi-icon primary">
                <i class="fa fa-briefcase"></i>
            </div>
            <div class="kpi-label">Créditos Activos</div>
            <div class="kpi-value"><?php echo number_format($total_creditos_activos); ?></div>
            <div class="kpi-change positive"><i class="fa fa-check-circle"></i> En curso</div>
        </div>

        <div class="kpi-card animate-in delay-2">
            <div class="kpi-icon success"><i class="fa fa-dollar"></i></div>
            <div class="kpi-label">Total en Credito</div>
            <div class="kpi-value">$<?php echo number_format($valor_cartera, 0, ',', '.'); ?></div>
        </div>

        <div class="kpi-card animate-in delay-3">
            <div class="kpi-icon warning"><i class="fa fa-calendar-plus-o"></i></div>
            <div class="kpi-label">Nuevos Este Mes</div>
            <div class="kpi-value"><?php echo number_format($creditos_mes_actual); ?></div>
            <?php if ($cambio_porcentaje != 0): ?>
            <div class="kpi-change <?php echo $cambio_porcentaje >= 0 ? 'positive' : 'negative'; ?>">
                <i class="fa fa-<?php echo $cambio_porcentaje >= 0 ? 'arrow-up' : 'arrow-down'; ?>"></i>
                <?php echo abs($cambio_porcentaje); ?>% vs mes ant.
            </div>
            <?php endif; ?>
        </div>

        <div class="kpi-card animate-in delay-4">
            <div class="kpi-icon info"><i class="fa fa-check-circle"></i></div>
            <div class="kpi-label">Finalizados</div>
            <div class="kpi-value"><?php echo number_format($total_creditos_cerrados); ?></div>
        </div>
    </div>

    <?php if ($total_alertas > 0): ?>
    <!-- Alertas -->
    <div class="alert-card animate-in">
        <div class="alert-icon-wrap"><i class="fa fa-bell"></i></div>
        <div class="alert-content"><h4><?php echo $total_alertas; ?> Alertas Pendientes</h4><p>Tienes renovaciones o documentos que requieren atención</p></div>
    </div>
    <?php endif; ?>

    <!-- Gráfico de Tendencia -->
    <div class="chart-card animate-in">
        <div class="chart-header"><div class="chart-title"><i class="fa fa-line-chart"></i>Tendencia de Créditos</div><span class="chart-badge">Últimos 6 meses</span></div>
        <div class="chart-container"><canvas id="trendChart"></canvas></div>
    </div>

    <!-- Gráficos en Grid -->
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="chart-card animate-in">
                <div class="chart-header"><div class="chart-title"><i class="fa fa-pie-chart"></i>Por Estado</div></div>
                <div class="chart-container-small"><canvas id="statusChart"></canvas></div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="chart-card animate-in">
                <div class="chart-header"><div class="chart-title"><i class="fa fa-bank"></i>Por Entidad</div></div>
                <div class="chart-container-small"><canvas id="entityChart"></canvas></div>
            </div>
        </div>
    </div>

    <!-- Últimas Actividades -->
    <div class="activity-card animate-in">
        <div class="chart-header"><div class="chart-title"><i class="fa fa-clock-o"></i>Actividad Reciente</div></div>
        <?php 
        if (mysqli_num_rows($resultado_ultimas) > 0):
            while ($actividad = mysqli_fetch_assoc($resultado_ultimas)): 

                $nombre_cliente                                                     = trim($actividad['nombre1_tercero'] . ' ' . $actividad['apellido1_tercero']);
                $estado_act                                                         = $actividad['nombre_estado_factura'];
                $fecha_act                                                          = date('d M, H:i', strtotime($actividad['fecha_ymdhis']));
                $monto_act                                                          = number_format($actividad['monto_deuda'], 0, ',', '.');
                $estado_facturacion                                                 = isset($actividad['nombre_estado_facturacion']) ? $actividad['nombre_estado_facturacion'] : 'Pendiente';
        ?>
        <div class="activity-item">
            <div class="activity-icon <?php echo $estado_act == 'CERRADA' ? 'completed' : 'pending'; ?>">
                <i class="fa fa-<?php echo $estado_act == 'CERRADA' ? 'check' : 'clock-o'; ?>"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title"><?php echo $nombre_cliente ?: 'Cliente'; ?></div>
                <div class="activity-desc">$<?php echo $monto_act; ?> - <?php echo $estado_facturacion; ?></div>
            </div>
            <div class="activity-time"><?php echo $fecha_act; ?></div>
        </div>
        <?php 
            endwhile;
        else:
        ?>
        <div class="text-center py-4">
            <i class="fa fa-inbox" style="font-size: 2rem; color: rgba(255,255,255,0.3);"></i><p style="color: rgba(255,255,255,0.5); margin-top: 0.5rem;">No hay actividad reciente</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Estadísticas adicionales -->
    <div class="chart-card animate-in">
        <div class="chart-header">
            <div class="chart-title"><i class="fa fa-bar-chart"></i>Resumen General</div>
        </div>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value"><?php echo number_format($total_productos); ?></div>
                <div class="stat-label">Productos</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo number_format($total_creditos_activos + $total_creditos_cerrados); ?></div>
                <div class="stat-label">Total Créditos</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo $total_alertas; ?></div>
                <div class="stat-label">Alertas</div>
            </div>
        </div>
    </div>
</main>

<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>

<script>
// Configuración global de Chart.js para tema oscuro
Chart.defaults.color = 'rgba(255, 255, 255, 0.7)';
Chart.defaults.borderColor = 'rgba(65, 105, 225, 0.2)';
// Colores del tema
const themeColors = { primary: '#4169e1', secondary: '#5b7ce6', accent: '#00d4ff', success: '#10b981', warning: '#f59e0b', danger: '#ef4444', purple: '#8b5cf6', pink: '#ec4899' };
const gradientColors = ['rgba(0, 212, 255, 0.8)', 'rgba(65, 105, 225, 0.8)', 'rgba(16, 185, 129, 0.8)', 'rgba(245, 158, 11, 0.8)', 'rgba(139, 92, 246, 0.8)', 'rgba(236, 72, 153, 0.8)'];
// Gráfico de Tendencia
const trendCtx = document.getElementById('trendChart').getContext('2d');
const trendGradient = trendCtx.createLinearGradient(0, 0, 0, 250);
trendGradient.addColorStop(0, 'rgba(0, 212, 255, 0.4)');
trendGradient.addColorStop(1, 'rgba(0, 212, 255, 0.0)');

new Chart(trendCtx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($tendencia_labels); ?>,
        datasets: [{ label: 'Créditos', data: <?php echo json_encode($tendencia_valores); ?>, borderColor: themeColors.accent, backgroundColor: trendGradient, borderWidth: 3, fill: true, tension: 0.4, pointBackgroundColor: themeColors.accent, pointBorderColor: '#fff', pointBorderWidth: 2, pointRadius: 5, pointHoverRadius: 8 }]
    },
    options: {
        responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: 'rgba(65, 105, 225, 0.1)' }, ticks: { stepSize: 1 } }, x: { grid: { display: false } } }
    }
});
// Gráfico de Estados (Dona)
const statusCtx = document.getElementById('statusChart').getContext('2d');
new Chart(statusCtx, {
    type: 'doughnut',
    data: { labels: <?php echo json_encode($estados_labels); ?>, datasets: [{ data: <?php echo json_encode($estados_valores); ?>, backgroundColor: gradientColors, borderColor: '#0a0e27', borderWidth: 3, hoverOffset: 10 }] },
    options: { responsive: true, maintainAspectRatio: false, cutout: '65%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 15, font: { size: 10 } } } } }
});
// Gráfico de Entidades (Barras)
const entityCtx = document.getElementById('entityChart').getContext('2d');
new Chart(entityCtx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($entidades_labels); ?>, datasets: [{ label: 'Créditos', data: <?php echo json_encode($entidades_valores); ?>, backgroundColor: gradientColors, borderRadius: 8, borderSkipped: false }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: 'rgba(65, 105, 225, 0.1)' }, ticks: { stepSize: 1 } }, x: { grid: { display: false }, ticks: { font: { size: 9 }, maxRotation: 45 } } } }
});
// Animación de números
function animateValue(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        element.textContent = value.toLocaleString('es-CO');
        if (progress < 1) { window.requestAnimationFrame(step); }
    };
    window.requestAnimationFrame(step);
}
// Auto-refresh cada 60 segundos (opcional)
// setTimeout(() => location.reload(), 60000);
</script>
