<?php 
$nombre_pagina          = "Dashboard Lider";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_lider.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_lider.php"); ?>
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

<style><?php include_once("../estilo_css/estilo_dashboard_lider.css"); ?></style>

</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Obtener datos para el dashboard
$fecha_hoy = date("Y-m-d");
$mes_actual = date("Y-m");
$mes_anterior = date("Y-m", strtotime("-1 month"));
// === CONSULTAS PARA KPIs - LIDER VE TODO ===
// Total Aliados
$sql_obtener_aliados = "SELECT COUNT(*) as total FROM tbl15_administrador WHERE cod_estado != '0' AND cod_estado_activacion_usuario != '3'";
$resultado_aliados = mysqli_query($conectar, $sql_obtener_aliados);
$datos_aliados = mysqli_fetch_assoc($resultado_aliados);
$total_aliados = isset($datos_aliados['total']) ? $datos_aliados['total'] : 0;
// Total Tiendas (TODAS - El líder ve todo)
$sql_tiendas = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_estado != '0'";
$resultado_tiendas = mysqli_query($conectar, $sql_tiendas);
$datos_tiendas = mysqli_fetch_assoc($resultado_tiendas);
$total_tiendas = isset($datos_tiendas['total']) ? $datos_tiendas['total'] : 0;
// Total Créditos Activos (Estado ABIERTA) - TODOS
$sql_creditos_activos = "SELECT COUNT(*) as total, COALESCE(SUM(monto_deuda), 0) as valor_total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
WHERE ifv.nombre_estado_factura = 'ABIERTA' AND t.cod_estado != '0'";
$resultado_activos = mysqli_query($conectar, $sql_creditos_activos);
$datos_activos = mysqli_fetch_assoc($resultado_activos);
$total_creditos_activos = isset($datos_activos['total']) ? $datos_activos['total'] : 0;
$valor_cartera = isset($datos_activos['valor_total']) ? $datos_activos['valor_total'] : 0;
// Créditos cerrados (Estado CERRADA) - TODOS
$sql_creditos_cerrados = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
WHERE ifv.nombre_estado_factura = 'CERRADA' AND t.cod_estado != '0'";
$resultado_cerrados = mysqli_query($conectar, $sql_creditos_cerrados);
$datos_cerrados = mysqli_fetch_assoc($resultado_cerrados);
$total_creditos_cerrados = isset($datos_cerrados['total']) ? $datos_cerrados['total'] : 0;
// Créditos nuevos del mes actual - TODOS
$sql_creditos_mes = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
WHERE DATE_FORMAT(ifv.fecha_creacion, '%Y-%m') = '$mes_actual' AND t.cod_estado != '0'";
$resultado_mes = mysqli_query($conectar, $sql_creditos_mes);
$datos_mes = mysqli_fetch_assoc($resultado_mes);
$creditos_mes_actual = isset($datos_mes['total']) ? $datos_mes['total'] : 0;
// Créditos del mes anterior (para comparación) - TODOS
$sql_creditos_mes_ant = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
WHERE DATE_FORMAT(ifv.fecha_creacion, '%Y-%m') = '$mes_anterior' AND t.cod_estado != '0'";
$resultado_mes_ant = mysqli_query($conectar, $sql_creditos_mes_ant);
$datos_mes_ant = mysqli_fetch_assoc($resultado_mes_ant);
$creditos_mes_anterior = isset($datos_mes_ant['total']) ? $datos_mes_ant['total'] : 0;
// Calcular porcentaje de cambio
$cambio_porcentaje = 0;
if ($creditos_mes_anterior > 0) { $cambio_porcentaje = round((($creditos_mes_actual - $creditos_mes_anterior) / $creditos_mes_anterior) * 100, 1); }
// Notificaciones pendientes - TODAS
$sql_notificaciones = "SELECT COUNT(*) as total FROM tbl15_notificacion_alerta_renovacion WHERE cod_estado = '0'"; // Ya tiene filtro por estado
$resultado_notif = mysqli_query($conectar, $sql_notificaciones);
$datos_notif = mysqli_fetch_assoc($resultado_notif);
$total_notificaciones = isset($datos_notif['total']) ? $datos_notif['total'] : 0;
// Tiendas registradas este mes - TODAS
$sql_tiendas_mes = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE DATE_FORMAT(fecha_creacion, '%Y-%m') = '$mes_actual' AND cod_estado != '0'";
$resultado_tiendas_mes = mysqli_query($conectar, $sql_tiendas_mes);
$datos_tiendas_mes = mysqli_fetch_assoc($resultado_tiendas_mes);
$tiendas_mes_actual = isset($datos_tiendas_mes['total']) ? $datos_tiendas_mes['total'] : 0;
// === DATOS PARA GRÁFICOS ===// Tendencia de créditos últimos 6 meses - TODOS
$tendencia_labels = [];
$tendencia_valores = [];
for ($i = 5; $i >= 0; $i--) {
    $mes = date("Y-m", strtotime("-$i months"));
    $nombre_mes = date("M", strtotime("-$i months"));
    
    $sql_tendencia = "SELECT COUNT(*) as total FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda 
    WHERE DATE_FORMAT(ifv.fecha_creacion, '%Y-%m') = '$mes' AND t.cod_estado != '0'";
    $resultado_tendencia = mysqli_query($conectar, $sql_tendencia);
    $datos_tendencia = mysqli_fetch_assoc($resultado_tendencia);
    
    $tendencia_labels[] = $nombre_mes;
    $tendencia_valores[] = isset($datos_tendencia['total']) ? $datos_tendencia['total'] : 0;
}
// Últimas tiendas registradas - TODAS
$sql_ultimas_tiendas = "SELECT t.cod_tienda, t.nombre_tienda, t.fecha_creacion, t.abrev_tienda, ta.nombre_tipo_aliado, ta.color_tipo_aliado FROM tbl15_tienda t LEFT JOIN tbl15_tipo_aliado ta ON t.cod_tipo_aliado = ta.cod_tipo_aliado WHERE t.cod_estado != '0' ORDER BY t.fecha_creacion DESC LIMIT 5";
$resultado_ultimas_tiendas = mysqli_query($conectar, $sql_ultimas_tiendas);

// Estados de tiendas por tipo de aliado - TODAS
$sql_estados_aliado = "SELECT ta.nombre_tipo_aliado, ta.color_tipo_aliado, COUNT(t.cod_tienda) as cantidad 
FROM tbl15_tienda t 
LEFT JOIN tbl15_tipo_aliado ta ON t.cod_tipo_aliado = ta.cod_tipo_aliado 
WHERE t.cod_estado != '0' 
GROUP BY ta.cod_tipo_aliado, ta.nombre_tipo_aliado, ta.color_tipo_aliado 
ORDER BY cantidad DESC";
$resultado_estados = mysqli_query($conectar, $sql_estados_aliado);

$estados_data = [];
$total_tiendas_estados = 0;
if ($resultado_estados) {
    while ($row = mysqli_fetch_assoc($resultado_estados)) {
        $nombre = !empty($row['nombre_tipo_aliado']) ? $row['nombre_tipo_aliado'] : 'Sin Asignar';
        $color = !empty($row['color_tipo_aliado']) ? $row['color_tipo_aliado'] : '#8b5cf6';
        $cantidad = (int)$row['cantidad'];
        $estados_data[] = ['nombre' => $nombre, 'color' => $color, 'cantidad' => $cantidad];
        $total_tiendas_estados += $cantidad;
    }
}

// Tiendas en zona de peligro (Dormido, Inactivo) - TODAS
$sql_tiendas_peligro = "SELECT t.cod_tienda, t.nombre_tienda, t.fecha_creacion, t.abrev_tienda, ta.nombre_tipo_aliado, ta.color_tipo_aliado 
FROM tbl15_tienda t 
INNER JOIN tbl15_tipo_aliado ta ON t.cod_tipo_aliado = ta.cod_tipo_aliado 
WHERE t.cod_estado != '0' AND ta.nombre_tipo_aliado IN ('Dormido', 'Inactivo') 
ORDER BY t.fecha_creacion DESC LIMIT 10";
$resultado_tiendas_peligro = mysqli_query($conectar, $sql_tiendas_peligro);

// Nombre del mes en español
$meses_esp = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$mes_nombre = $meses_esp[date('n') - 1];
$anio = date('Y');
?>
<main class="dashboard-container">
    <!-- Header del Dashboard -->
    <div class="dashboard-header animate-in">
        <h1><i class="fa-solid fa-crown"></i> Dashboard Líder</h1>
        <p>Bienvenido, <?php echo ucwords(strtolower($nombres_usuario . ' ' . $apellidos_usuario)); ?></p>
        <div class="dashboard-date">
            <i class="fa-regular fa-calendar"></i>
            <?php echo "$mes_nombre $anio"; ?>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="quick-actions animate-in delay-1">
        <a href="lista_coordinador_lider_movil.php" class="quick-action-btn qa-tiendas"><i class="fa-solid fa-users-gear"></i><span>Coordinadores</span></a>
        <a href="lista_revisor_lider_movil.php" class="quick-action-btn qa-tiendas"><i class="fa-solid fa-user-shield"></i><span>Revisores</span></a>
        <a href="lista_tienda_lider_movil.php" class="quick-action-btn qa-tiendas"><i class="fa-solid fa-store"></i><span>Tiendas</span></a>
        <a href="lista_vendedor_lider_movil.php" class="quick-action-btn qa-tiendas"><i class="fa-solid fa-user-tag"></i><span>Vendedores</span></a>
        <a href="lista_producto_lider_movil.php" class="quick-action-btn qa-productos"><i class="fa-solid fa-boxes-stacked"></i><span>Productos</span></a>
        <a href="lista_info_factura_venta_lider_movil.php" class="quick-action-btn qa-creditos"><i class="fa-solid fa-credit-card"></i><span>Créditos</span></a>
    </div>

    <!-- KPI Cards -->
    <div class="kpi-grid">
        <div class="kpi-card animate-in delay-1">
            <div class="kpi-icon primary">
                <i class="fa-solid fa-store"></i>
            </div>
            <div class="kpi-label">Total Tiendas</div>
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

    <!-- Resumen Estado Tiendas -->
    <div class="chart-card animate-in delay-2" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(139, 92, 246, 0.02) 100%); border: 1px solid rgba(139, 92, 246, 0.2);">
        <div class="chart-header" style="border-bottom: 1px solid rgba(139, 92, 246, 0.1); padding-bottom: 0.75rem; margin-bottom: 1rem;">
            <div class="chart-title" style="display: flex; align-items: center; gap: 0.5rem; color: #8b5cf6; font-size: 0.95rem; font-weight: 700;">
                <i class="fa-solid fa-chart-pie"></i>
                Estado de Tiendas por Tipo
            </div>
        </div>
        
        <!-- Barra de progreso segmentada -->
        <div style="display: flex; height: 16px; border-radius: 8px; overflow: hidden; margin-bottom: 1.25rem; background: rgba(255,255,255,0.05); box-shadow: inset 0 2px 4px rgba(0,0,0,0.2);">
            <?php 
            if ($total_tiendas_estados > 0) {
                foreach ($estados_data as $estado) {
                    $porcentaje = ($estado['cantidad'] / $total_tiendas_estados) * 100;
                    echo '<div style="width: ' . $porcentaje . '%; background: ' . htmlspecialchars($estado['color']) . '; transition: width 1s ease-in-out;" title="' . htmlspecialchars($estado['nombre']) . ': ' . $estado['cantidad'] . '"></div>';
                }
            } else {
                echo '<div style="width: 100%; background: rgba(255,255,255,0.1);"></div>';
            }
            ?>
        </div>
        
        <!-- Leyenda en Grid -->
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem;">
            <?php 
            if (!empty($estados_data)):
                foreach ($estados_data as $estado): 
                $porcentaje = $total_tiendas_estados > 0 ? round(($estado['cantidad'] / $total_tiendas_estados) * 100, 1) : 0;
            ?>
            <div style="display: flex; align-items: center; justify-content: space-between; background: rgba(255,255,255,0.03); padding: 0.6rem 0.75rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.05); transition: all 0.2s ease;">
                <div style="display: flex; align-items: center; gap: 0.6rem; overflow: hidden;">
                    <span style="width: 12px; height: 12px; border-radius: 50%; background: <?php echo htmlspecialchars($estado['color']); ?>; flex-shrink: 0; box-shadow: 0 0 5px <?php echo htmlspecialchars($estado['color']); ?>;"></span>
                    <span style="font-size: 0.75rem; color: rgba(255,255,255,0.85); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 500;"><?php echo htmlspecialchars($estado['nombre']); ?></span>
                </div>
                <div style="display: flex; flex-direction: column; align-items: flex-end; line-height: 1.2;">
                    <span style="font-size: 0.85rem; font-weight: 700; color: white;"><?php echo $estado['cantidad']; ?></span>
                    <span style="font-size: 0.65rem; color: rgba(255,255,255,0.45); font-weight: 600;"><?php echo $porcentaje; ?>%</span>
                </div>
            </div>
            <?php 
                endforeach; 
            else:
            ?>
            <div style="grid-column: span 2; text-align: center; color: rgba(255,255,255,0.4); font-size: 0.8rem; padding: 1.5rem; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px dashed rgba(255,255,255,0.1);">
                <i class="fa-solid fa-chart-pie" style="font-size: 1.5rem; margin-bottom: 0.5rem; display: block; opacity: 0.5;"></i>
                No hay datos disponibles
            </div>
            <?php endif; ?>
        </div>
    </div>

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
                $color_aliado = !empty($tienda['color_tipo_aliado']) ? $tienda['color_tipo_aliado'] : '#8b5cf6';
                $nombre_aliado = !empty($tienda['nombre_tipo_aliado']) ? $tienda['nombre_tipo_aliado'] : 'Sin Asignar';
        ?>
        <div class="activity-item">
            <div class="activity-icon new" style="background: <?php echo $color_aliado; ?>;">
                <i class="fa-solid fa-store"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title" style="display: flex; align-items: center; justify-content: space-between;">
                    <span><?php echo ucwords(strtolower($tienda['nombre_tienda'])); ?></span>
                    <span style="font-size: 0.65rem; padding: 0.15rem 0.5rem; border-radius: 10px; background: <?php echo $color_aliado; ?>20; color: <?php echo $color_aliado; ?>; border: 1px solid <?php echo $color_aliado; ?>;">
                        <?php echo htmlspecialchars($nombre_aliado); ?>
                    </span>
                </div>
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

    <!-- Tiendas en Zona de Peligro -->
    <div class="activity-card animate-in delay-3" style="border-color: rgba(239, 68, 68, 0.3);">
        <div class="chart-header">
            <div class="chart-title" style="color: #ef4444;">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Zonas de Peligro
            </div>
        </div>
        
        <?php 
        if ($resultado_tiendas_peligro && mysqli_num_rows($resultado_tiendas_peligro) > 0):
            while ($tienda_peligro = mysqli_fetch_assoc($resultado_tiendas_peligro)): 
                $fecha_tienda = date('d M Y', strtotime($tienda_peligro['fecha_creacion']));
                $color_aliado = !empty($tienda_peligro['color_tipo_aliado']) ? $tienda_peligro['color_tipo_aliado'] : '#ef4444';
                $nombre_aliado = !empty($tienda_peligro['nombre_tipo_aliado']) ? $tienda_peligro['nombre_tipo_aliado'] : 'Peligro';
        ?>
        <div class="activity-item" style="border-left: 3px solid <?php echo $color_aliado; ?>; padding-left: 10px;">
            <div class="activity-icon" style="background: <?php echo $color_aliado; ?>20; color: <?php echo $color_aliado; ?>;">
                <i class="fa-solid fa-store-slash"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title" style="display: flex; align-items: center; justify-content: space-between;">
                    <span style="color: rgba(255,255,255,0.9);"><?php echo ucwords(strtolower($tienda_peligro['nombre_tienda'])); ?></span>
                    <span style="font-size: 0.65rem; padding: 0.15rem 0.5rem; border-radius: 10px; background: <?php echo $color_aliado; ?>20; color: <?php echo $color_aliado; ?>; border: 1px solid <?php echo $color_aliado; ?>; font-weight: 700;">
                        <?php echo htmlspecialchars($nombre_aliado); ?>
                    </span>
                </div>
                <div class="activity-desc" style="color: rgba(255,255,255,0.5);"><?php echo $tienda_peligro['abrev_tienda']; ?></div>
            </div>
            <div class="activity-time"><?php echo $fecha_tienda; ?></div>
        </div>
        <?php 
            endwhile;
        else:
        ?>
        <div style="text-align: center; padding: 2rem;">
            <i class="fa-solid fa-shield-check" style="font-size: 2rem; color: #34d399; opacity: 0.6;"></i>
            <p style="color: rgba(255,255,255,0.6); margin-top: 0.5rem;">No hay tiendas en zona de peligro</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Estadísticas adicionales -->
    <div class="chart-card animate-in">
        <div class="chart-header"><div class="chart-title"><i class="fa-solid fa-chart-pie"></i>Resumen General</div></div>
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
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<script>
// Configuración global de Chart.js para tema oscuro
Chart.defaults.color = 'rgba(255, 255, 255, 0.7)';
Chart.defaults.borderColor = 'rgba(139, 92, 246, 0.2)';

// Gráfico de tendencia
const trendChartEl = document.getElementById('trendChart');
if (trendChartEl) {
    const trendCtx = trendChartEl.getContext('2d');
    const gradient = trendCtx.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(139, 92, 246, 0.5)');
    gradient.addColorStop(1, 'rgba(139, 92, 246, 0)');

    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($tendencia_labels); ?>,
            datasets: [{ label: 'Créditos', data: <?php echo json_encode($tendencia_valores); ?>, borderColor: '#8b5cf6', backgroundColor: gradient, borderWidth: 3, fill: true, tension: 0.4, pointBackgroundColor: '#8b5cf6', pointBorderColor: '#fff', pointBorderWidth: 2, pointRadius: 5, pointHoverRadius: 7 }]
        },
        options: {
            responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: 'rgba(139, 92, 246, 0.1)' } } }
        }
    });
}
</script>


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
        url: '../admin/obtener_notificaciones_ajax.php', type: 'GET', dataType: 'json',
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
        url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { cod_notificacion: codNotificacion }, dataType: 'json',
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
        confirmButtonColor: '#8b5cf6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, marcar todas',
        cancelButtonText: 'Cancelar',
        background: '#1a1f2e',
        color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { marcar_todas: 'si' }, dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarNotificacionesMovil();
                        Swal.fire({ icon: 'success', title: '¡Listo!', text: 'Todas las notificaciones han sido marcadas como leídas', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
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

