<?php 
$nombre_pagina          = "Notificaciones";
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
    <link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
    <script src="../js/sweetalert2.min_adm_tick.js"></script>

    <style>
        /* ============================================ */
        /* NOTIFICACIONES lider - TEMA VERDE ESMERALDA */
        /* ============================================ */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
            min-height: 100vh;
        }

        .page-container {
            padding: 1rem;
            padding-bottom: 100px;
            max-width: 800px;
            margin: 0 auto;
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
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            position: relative;
            z-index: 2;
        }

        .back-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.1rem;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateX(-2px);
        }

        /* Stats Strip */
        .stats-strip {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .stat-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 12px;
            padding: 1rem;
            min-width: 120px;
            flex: 1;
            text-align: center;
        }

        .stat-card.active {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(139, 92, 246, 0.1) 100%);
            border-color: #8b5cf6;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Notification List */
        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .notification-card {
            background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 16px;
            padding: 1.25rem;
            position: relative;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .notification-card:hover {
            border-color: #8b5cf6;
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(139, 92, 246, 0.2);
        }

        .notification-card.unread::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #8b5cf6;
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .notification-title {
            font-size: 1rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notification-icon {
            width: 32px;
            height: 32px;
            background: rgba(139, 92, 246, 0.2);
            color: #8b5cf6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .notification-time {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.5);
            background: rgba(255,255,255,0.05);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
        }

        .notification-content {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .notification-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            background: rgba(0,0,0,0.2);
            padding: 0.75rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
            text-transform: uppercase;
        }

        .detail-value {
            font-size: 0.85rem;
            color: white;
            font-weight: 600;
        }

        .detail-value.money {
            color: #8b5cf6;
        }

        .notification-actions {
            display: flex;
            gap: 0.5rem;
            border-top: 1px solid rgba(139, 92, 246, 0.2);
            padding-top: 1rem;
        }

        .action-btn {
            flex: 1;
            padding: 0.75rem;
            border-radius: 10px;
            border: none;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .action-btn.primary {
            background: rgba(139, 92, 246, 0.2);
            color: #8b5cf6;
        }

        .action-btn.primary:hover {
            background: #8b5cf6;
            color: white;
        }

        .action-btn.secondary {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
        }

        .action-btn.secondary:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: rgba(139, 92, 246, 0.3);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: rgba(255,255,255,0.5);
            font-size: 0.9rem;
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
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: fadeInUp 0.5s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
    </style>
</head>
<body>

<?php
$fecha_hoy = date("Y-m-d");

// Estadísticas de notificaciones para este asesor
$sql_stats = "SELECT COUNT(*) as total, SUM(CASE WHEN cod_estado = '0' THEN 1 ELSE 0 END) as pendientes, SUM(CASE WHEN cod_estado = '1' THEN 1 ELSE 0 END) as leidas,
SUM(CASE WHEN fecha_cobro_notificacion_alerta_renovacion <= '$fecha_hoy' AND cod_estado = '0' THEN 1 ELSE 0 END) as vencidas
FROM tbl15_notificacion_alerta_renovacion WHERE cod_administrador = '$cod_administrador'";
$res_stats = mysqli_query($conectar, $sql_stats);
$stats = mysqli_fetch_assoc($res_stats);
// Consulta de notificaciones con join a terceros
$sql_notificaciones = "SELECT n.*, t.nombre1_tercero, t.apellido1_tercero, t.telefono1_tercero 
FROM tbl15_notificacion_alerta_renovacion n
LEFT JOIN tbl15_tercero t ON n.cod_tercero = t.cod_tercero 
WHERE n.cod_administrador = '$cod_administrador'
ORDER BY n.cod_estado ASC, n.fecha_cobro_notificacion_alerta_renovacion ASC
LIMIT 20";
$resultado = mysqli_query($conectar, $sql_notificaciones);
$total_rows = mysqli_num_rows($resultado);
?>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><button class="back-btn" onclick="window.location.href='config_lider_movil.php'"><i class="fa-solid fa-arrow-left"></i></button>Notificaciones</h1>
    </div>

    <!-- Stats Strip -->
    <div class="stats-strip animate-in delay-1">
        <div class="stat-card active">
            <div class="stat-value"><?php echo $stats['pendientes']; ?></div>
            <div class="stat-label">Pendientes</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?php echo $stats['vencidas']; ?></div>
            <div class="stat-label">Vencidas</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?php echo $stats['total']; ?></div>
            <div class="stat-label">Total Alert</div>
        </div>
    </div>

    <!-- Notification List -->
    <div class="notification-list" id="notificationList">
        <?php if ($total_rows > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($resultado)): 
                // Calculo de días restantes
                $fecha_fin_seg = strtotime($row['fecha_cobro_notificacion_alerta_renovacion']);
                $fecha_ini_seg = strtotime($fecha_hoy);
                $dias_restantes = floor(($fecha_fin_seg - $fecha_ini_seg) / (60 * 60 * 24));
                
                $estado_clase = $row['cod_estado'] == '0' ? 'unread' : '';
                $estado_texto = $row['cod_estado'] == '0' ? 'Pendiente' : 'Leída';
                $icono = 'fa-bell';
                
                if ($dias_restantes < 0) {
                    $tiempo_texto = "Venció hace " . abs($dias_restantes) . " días";
                    $tiempo_color = "#ef4444";
                    $icono = 'fa-exclamation-triangle';
                } elseif ($dias_restantes == 0) {
                    $tiempo_texto = "Vence hoy";
                    $tiempo_color = "#f59e0b";
                    $icono = 'fa-clock';
                } else {
                    $tiempo_texto = "Vence en " . $dias_restantes . " días";
                    $tiempo_color = "#8b5cf6";
                }
            ?>
            <div class="notification-card <?php echo $estado_clase; ?> animate-in delay-2" id="notif-<?php echo $row['cod_notificacion_alerta_renovacion']; ?>">
                <div class="notification-header">
                    <div class="notification-title">
                        <div class="notification-icon">
                            <i class="fa-solid <?php echo $icono; ?>"></i>
                        </div>
                        <?php echo $row['nombre_notificacion_alerta_renovacion']; ?>
                    </div>
                    <div class="notification-time" style="color: <?php echo $tiempo_color; ?>; font-weight: bold;">
                        <?php echo $tiempo_texto; ?>
                    </div>
                </div>
                
                <div class="notification-content">
                    <?php echo $row['descipcion_notificacion_alerta_renovacion']; ?>
                </div>

                <div class="notification-details">
                    <div class="detail-item">
                        <span class="detail-label">Cliente</span>
                        <span class="detail-value"><?php echo ucwords(strtolower($row['nombre1_tercero'] . ' ' . $row['apellido1_tercero'])); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Producto</span>
                        <span class="detail-value"><?php echo $row['nombre_tipo_producto']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Monto</span>
                        <span class="detail-value money">$<?php echo number_format($row['precio_venta_notificacion_alerta_renovacion'], 0, ',', '.'); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Fecha Cobro</span>
                        <span class="detail-value"><?php echo date("d/m/Y", strtotime($row['fecha_cobro_notificacion_alerta_renovacion'])); ?></span>
                    </div>
                </div>

                <div class="notification-actions">
                    <?php if ($row['cod_estado'] == '0'): ?>
                    <button class="action-btn primary" onclick="marcarLeida(<?php echo $row['cod_notificacion_alerta_renovacion']; ?>)">
                        <i class="fa-solid fa-check"></i> Marcar Leída
                    </button>
                    <?php endif; ?>
                    <?php if (!empty($row['telefono1_tercero'])): ?>
                    <a href="https://wa.me/57<?php echo $row['telefono1_tercero']; ?>?text=Hola%2C%20le%20escribo%20para%20recordar%20la%20renovaci%C3%B3n%20de%20<?php echo urlencode($row['nombre_notificacion_alerta_renovacion']); ?>" target="_blank" class="action-btn secondary">
                        <i class="fa-brands fa-whatsapp"></i> Contactar
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state animate-in">
                <i class="fa-solid fa-bell-slash"></i>
                <h3>Sin notificaciones</h3>
                <p>No tienes alertas de renovación pendientes por el momento.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<script>
function marcarLeida(id) {
    Swal.fire({
        title: '¿Marcar como leída?', text: "La notificación pasará al historial de leídas", icon: 'question', showCancelButton: true, confirmButtonColor: '#8b5cf6',
        cancelButtonColor: '#d33', confirmButtonText: 'Sí, marcar', cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'marcar_notificacion_leida_ajax.php',
                type: 'POST',
                data: { cod_notificacion: id },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#notif-' + id).fadeOut(300, function() { 
                            $(this).remove(); 
                            if ($('.notification-card:visible').length === 0) {
                                location.reload(); 
                            }
                        });
                        // Actualizar contador en stats si es posible (simple visual update)
                        var currentPending = parseInt($('.stat-card.active .stat-value').text());
                        if (!isNaN(currentPending) && currentPending > 0) {
                            $('.stat-card.active .stat-value').text(currentPending - 1);
                        }
                    }
                }
            });
        }
    })
}
</script>

</body>
</html>
