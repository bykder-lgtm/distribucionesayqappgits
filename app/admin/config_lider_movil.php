<?php 
$nombre_pagina          = "Configuración";
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
/* CONFIG lider - TEMA VERDE ESMERALDA        */
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
    max-width: 600px;
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

/* Profile Card */
.profile-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    text-align: center;
}

.profile-avatar {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem auto;
    font-size: 2rem;
    color: white;
    box-shadow: 0 4px 20px rgba(139, 92, 246, 0.4);
}

.profile-name {
    color: white;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.profile-role {
    color: #8b5cf6;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.profile-email {
    color: rgba(255,255,255,0.6);
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

/* Menu Sections */
.menu-section {
    margin-bottom: 1.5rem;
}

.menu-section-title {
    color: rgba(255,255,255,0.5);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.75rem;
    padding-left: 0.5rem;
}

.menu-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 1rem;
}

.menu-item {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1.5rem 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.menu-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(139, 92, 246, 0.2);
    border-color: rgba(139, 92, 246, 0.5);
    background: linear-gradient(135deg, #1f2536 0%, #111823 100%);
}

.menu-item-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem auto;
    font-size: 1.8rem;
}

.menu-item-icon.green { background: rgba(139, 92, 246, 0.15); color: #8b5cf6; }
.menu-item-icon.blue { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }
.menu-item-icon.purple { background: rgba(139, 92, 246, 0.15); color: #8b5cf6; }
.menu-item-icon.orange { background: rgba(245, 158, 11, 0.15); color: #f59e0b; }
.menu-item-icon.red { background: rgba(239, 68, 68, 0.15); color: #ef4444; }

.menu-item-content {
    flex: none;
    width: 100%;
}

.menu-item-title {
    color: white;
    font-size: 0.95rem;
    font-weight: 600;
}

.menu-item-desc {
    color: rgba(255,255,255,0.5);
    font-size: 0.75rem;
    margin-top: 0.3rem;
    line-height: 1.2;
}

.menu-item-arrow {
    display: none;
}

.menu-item-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 0.25rem 0.5rem;
    border-radius: 10px;
}

/* Version Info */
.version-info {
    text-align: center;
    padding: 1.5rem;
    color: rgba(255,255,255,0.3);
    font-size: 0.8rem;
}

.version-info strong {
    color: #8b5cf6;
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
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Obtener notificaciones pendientes
$sql_notif = "SELECT COUNT(*) as total FROM tbl15_notificacion_alerta_renovacion WHERE cod_administrador = '$cod_administrador' AND cod_estado = '0'";
$resultado_notif = mysqli_query($conectar, $sql_notif);
$datos_notif = mysqli_fetch_assoc($resultado_notif);
$total_notificaciones = isset($datos_notif['total']) ? $datos_notif['total'] : 0;
?>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-gear"></i> Configuración</h1>
    </div>

    <!-- Profile Card -->
    <div class="profile-card animate-in delay-1">
        <div class="profile-avatar">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="profile-name"><?php echo ucwords(strtolower($nombres_usuario . " " . $apellidos_usuario)); ?></div>
        <div class="profile-role">lider</div>
        <div class="profile-email"><?php echo strtolower($correo_usuario); ?></div>
    </div>

    <!-- Menu General -->
    <div class="menu-section animate-in delay-2">
        <div class="menu-section-title">General</div>
        <div class="menu-list">
            <a href="dashboard_lider_movil.php" class="menu-item">
                <div class="menu-item-icon green">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Dashboard</div>
                    <div class="menu-item-desc">Ver resumen y estadísticas</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>

            <a href="lista_tarea_lider_movil.php" class="menu-item">
                <div class="menu-item-icon orange">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Mis Tareas (Scrum)</div>
                    <div class="menu-item-desc">Tablero ágil y Kanban</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
              <a href="directorio_global_lider_movil.php" class="menu-item">
                <div class="menu-item-icon blue">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Directorio de Usuarios</div>
                    <div class="menu-item-desc">Buscar líderes, asesores, aliados, etc.</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
            
            <a href="lista_tienda_lider_movil.php" class="menu-item">
                <div class="menu-item-icon blue">
                    <i class="fa-solid fa-store"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Mis Tiendas</div>
                    <div class="menu-item-desc">Gestionar tiendas afiliadas</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>

            <a href="mapa_tiendas_lider_movil.php" class="menu-item">
                <div class="menu-item-icon purple">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Mapa de Tiendas</div>
                    <div class="menu-item-desc">Ver ubicación GPS de tiendas</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>

            <a href="lista_revisor_lider_movil.php" class="menu-item">
                <div class="menu-item-icon purple">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Mis Revisores</div>
                    <div class="menu-item-desc">Gestionar equipo de revisión</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>

            <a href="lista_vendedor_lider_movil.php" class="menu-item">
                <div class="menu-item-icon orange">
                    <i class="fa-solid fa-user-tag"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Mis Vendedores</div>
                    <div class="menu-item-desc">Gestionar fuerza de ventas</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
            
            <a href="lista_notificacion_alerta_renovacion_lider_movil.php" class="menu-item">
                <div class="menu-item-icon orange">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Notificaciones</div>
                    <div class="menu-item-desc">Alertas y recordatorios</div>
                </div>
                <?php if ($total_notificaciones > 0): ?>
                <span class="menu-item-badge"><?php echo $total_notificaciones; ?></span>
                <?php endif; ?>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
            
            <a href="parametrizacion_cuota_entidad_crediticia_lider_movil.php" class="menu-item">
                <div class="menu-item-icon purple">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Parametrización de Cuotas</div>
                    <div class="menu-item-desc">Configurar cuotas por entidad crediticia</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>

            <a href="lista_archivados_lider_movil.php" class="menu-item">
                <div class="menu-item-icon red">
                    <i class="fa-solid fa-box-archive"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Archivo</div>
                    <div class="menu-item-desc">Ver y recuperar registros archivados</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
        </div>
    </div>

    <!-- Menu Asignaciones -->
    <div class="menu-section animate-in delay-3">
        <div class="menu-section-title">Módulo de Asignaciones</div>
        <div class="menu-list">

            <a href="reasignacion_y_cambio_rol.php" class="menu-item">
                <div class="menu-item-icon green">
                    <i class="fa-solid fa-store"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Asignación Gerárquica y Cambios de roles</div>
                    <div class="menu-item-desc">Gestionar asignaciones y cambios de roles</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
<!--
            <a href="lista_asignar_tiendas_a_aliado_dragdrop_lider_movil.php" class="menu-item">
                <div class="menu-item-icon green">
                    <i class="fa-solid fa-store"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Asignar Tiendas a Aliado</div>
                    <div class="menu-item-desc">Gestionar tiendas por aliado</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>

            <a href="lista_asignar_bancos_a_aliado_dragdrop_lider_movil.php" class="menu-item">
                <div class="menu-item-icon blue">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Asignar Cuentas a Aliado</div>
                    <div class="menu-item-desc">Vincular cuentas bancarias</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>

            <a href="lista_asignar_vendedores_a_tienda_dragdrop_lider_movil.php" class="menu-item">
                <div class="menu-item-icon orange">
                    <i class="fa-solid fa-users-viewfinder"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Asignar Vendedores a Tienda</div>
                    <div class="menu-item-desc">Vincular vendedores a tiendas</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
            
            <a href="lista_asignar_creditos_a_revisor_dragdrop_lider_movil.php" class="menu-item">
                <div class="menu-item-icon purple">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Asignar Créditos a Revisor</div>
                    <div class="menu-item-desc">Distribuir facturas de venta</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>

            <a href="lista_asignar_aliados_a_asesor_dragdrop_lider_movil.php" class="menu-item">
                <div class="menu-item-icon red">
                    <i class="fa-solid fa-people-arrows"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Asignar Aliados a Asesor</div>
                    <div class="menu-item-desc">Gestionar equipo de asesoría</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>

            <a href="lista_asignar_asesores_a_coordinador_dragdrop_lider_movil.php" class="menu-item">
                <div class="menu-item-icon green">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Asignar Asesores a Coord</div>
                    <div class="menu-item-desc">Estructurar equipo base</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
-->

        </div>
    </div>

    <!-- Menu Cuenta -->
    <div class="menu-section animate-in delay-3">
        <div class="menu-section-title">Mi Cuenta</div>
        <div class="menu-list">
            <a href="edit_perfil_lider.php" class="menu-item">
                <div class="menu-item-icon purple">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Editar Perfil</div>
                    <div class="menu-item-desc">Actualizar información personal</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
            
            <a href="cambiar_contrasena_lider_movil.php" class="menu-item">
                <div class="menu-item-icon blue">
                    <i class="fa-solid fa-key"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Cambiar Contraseña</div>
                    <div class="menu-item-desc">Actualizar credenciales</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
        </div>
    </div>

    <!-- Menu Vistas -->
    <div class="menu-section animate-in delay-3">
        <div class="menu-section-title">Cambiar Vista</div>
        <div class="menu-list">
            <a href="lista_tienda_lider_diseno_vertical.php" class="menu-item">
                <div class="menu-item-icon green">
                    <i class="fa-solid fa-desktop"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Vista Escritorio</div>
                    <div class="menu-item-desc">Interfaz optimizada para PC</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
        </div>
    </div>

    <!-- Menu Sesión -->
    <div class="menu-section animate-in delay-3">
        <div class="menu-section-title">Sesión</div>
        <div class="menu-list">
            <a href="../session/salir_visitante_intern.php?token=<?php echo $token ?>" class="menu-item">
                <div class="menu-item-icon red">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">Cerrar Sesión</div>
                    <div class="menu-item-desc">Salir de la aplicación</div>
                </div>
                <i class="fa-solid fa-chevron-right menu-item-arrow"></i>
            </a>
        </div>
    </div>

    <!-- Version Info -->
    <div class="version-info animate-in">
        <p><strong><?php echo $nombre; ?></strong></p>
        <p>Versión 2.0 Móvil</p>
        <p>© <?php echo date('Y'); ?> Todos los derechos reservados</p>
    </div>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>



<!-- ====================== SISTEMA DE NOTIFICACIONES ====================== -->
<style>
.notification-bell-movil {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(139, 92, 246, 0.5);
    z-index: 9999;
    transition: all 0.3s ease;
    border: none;
}

.notification-bell-movil:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 30px rgba(139, 92, 246, 0.7);
}

.notification-bell-movil i { font-size: 22px; color: white; }
.notification-bell-movil.has-notifications { animation: bellPulseMovil 2s infinite; }

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

@keyframes bellPulseMovil { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }
@keyframes bellShakeMovil { 0%, 100% { transform: rotate(0); } 25% { transform: rotate(15deg); } 75% { transform: rotate(-15deg); } }
.notification-bell-movil.shake i { animation: bellShakeMovil 0.5s ease; }

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
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.notification-panel-movil.show { display: block; animation: slideUpMovil 0.3s ease; }
@keyframes slideUpMovil { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

.notification-header-movil {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
    padding: 15px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.notification-header-movil h4 { margin: 0; font-size: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
.notification-header-actions-movil { display: flex; gap: 8px; }
.notification-header-actions-movil button { background: rgba(255, 255, 255, 0.2); border: none; color: white; padding: 6px 10px; border-radius: 8px; font-size: 11px; cursor: pointer; }
.notification-list-movil { max-height: 320px; overflow-y: auto; }
.notification-item-movil { padding: 14px 18px; border-bottom: 1px solid rgba(139, 92, 246, 0.15); cursor: pointer; transition: background 0.2s ease; display: flex; gap: 12px; align-items: flex-start; }
.notification-item-movil:hover { background: rgba(139, 92, 246, 0.1); }
.notification-item-movil:last-child { border-bottom: none; }
.notification-icon-movil { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 14px; }
.notification-icon-movil.type-1 { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; }
.notification-icon-movil.type-2 { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; }
.notification-icon-movil.type-3 { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; }
.notification-content-movil { flex: 1; min-width: 0; }
.notification-title-movil { font-size: 13px; font-weight: 600; color: white; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.notification-desc-movil { font-size: 12px; color: rgba(255,255,255,0.6); line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.notification-time-movil { font-size: 10px; color: rgba(139, 92, 246, 0.8); margin-top: 5px; }
.notification-empty-movil { padding: 40px 20px; text-align: center; color: rgba(255,255,255,0.5); }
.notification-empty-movil i { font-size: 40px; margin-bottom: 12px; display: block; color: rgba(139, 92, 246, 0.4); }
.notification-empty-movil p { margin: 0; font-size: 14px; }
</style>

<button class="notification-bell-movil" id="notificationBellMovil" onclick="toggleNotificationPanelMovil()">
    <i class="fa-solid fa-bell"></i>
    <span class="notification-badge-movil" id="notificationBadgeMovil" style="display: none;">0</span>
</button>

<div class="notification-panel-movil" id="notificationPanelMovil">
    <div class="notification-header-movil">
        <h4><i class="fa-solid fa-bell"></i> Notificaciones</h4>
        <div class="notification-header-actions-movil">
            <button onclick="marcarTodasLeidasMovil()"><i class="fa-solid fa-check-double"></i> Leer todas</button>
            <button onclick="toggleNotificationPanelMovil()"><i class="fa-solid fa-times"></i></button>
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
var notificationCheckIntervalMovil = null;

$(document).ready(function() {
    cargarNotificacionesMovil();
    notificationCheckIntervalMovil = setInterval(cargarNotificacionesMovil, 30000);
});

function cargarNotificacionesMovil() {
    $.ajax({
        url: '../admin/obtener_notificaciones_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) actualizarUINotificacionesMovil(response.notificaciones, response.count);
        }
    });
}

function actualizarUINotificacionesMovil(notificaciones, count) {
    var $badge = $('#notificationBadgeMovil'), $bell = $('#notificationBellMovil'), $list = $('#notificationListMovil');
    if (count > 0) {
        $badge.text(count > 99 ? '99+' : count).show();
        $bell.addClass('has-notifications');
        if (!$bell.hasClass('notified')) { $bell.addClass('shake notified'); setTimeout(function() { $bell.removeClass('shake'); }, 500); }
    } else {
        $badge.hide();
        $bell.removeClass('has-notifications notified');
    }
    if (notificaciones.length > 0) {
        var html = '';
        notificaciones.forEach(function(notif) {
            var iconClass = 'type-' + (notif.tipo || 1), iconSymbol = getNotificationIconMovil(notif.tipo);
            html += '<div class="notification-item-movil" onclick="marcarNotificacionLeidaMovil(' + notif.id + ', this)">';
            html += '<div class="notification-icon-movil ' + iconClass + '"><i class="fa-solid ' + iconSymbol + '"></i></div>';
            html += '<div class="notification-content-movil"><div class="notification-title-movil">' + escapeHtmlMovil(notif.titulo) + '</div>';
            html += '<div class="notification-desc-movil">' + escapeHtmlMovil(notif.descripcion) + '</div>';
            html += '<div class="notification-time-movil"><i class="fa-regular fa-clock"></i> ' + notif.fecha_corta + '</div></div></div>';
        });
        $list.html(html);
    } else {
        $list.html('<div class="notification-empty-movil"><i class="fa-solid fa-bell-slash"></i><p>No hay notificaciones pendientes</p></div>');
    }
}

function getNotificationIconMovil(tipo) {
    switch(parseInt(tipo)) { case 1: return 'fa-signature'; case 2: return 'fa-exclamation-circle'; case 3: return 'fa-info-circle'; default: return 'fa-bell'; }
}

function toggleNotificationPanelMovil() { $('#notificationPanelMovil').toggleClass('show'); }

$(document).on('click', function(e) {
    if (!$(e.target).closest('#notificationPanelMovil, #notificationBellMovil').length) $('#notificationPanelMovil').removeClass('show');
});

function marcarNotificacionLeidaMovil(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php',
        type: 'POST',
        data: { cod_notificacion: codNotificacion },
        dataType: 'json',
        success: function(response) {
            if (response.success) $(element).fadeOut(300, function() { $(this).remove(); cargarNotificacionesMovil(); });
        }
    });
}

function marcarTodasLeidasMovil() {
    Swal.fire({
        title: '¿Marcar todas como leídas?', text: 'Se marcarán todas las notificaciones pendientes como leídas', icon: 'question', showCancelButton: true, confirmButtonColor: '#8b5cf6',
        cancelButtonColor: '#6c757d', confirmButtonText: 'Sí, marcar todas', cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white'
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
                        Swal.fire({ icon: 'success', title: '¡Listo!', text: 'Todas las notificaciones han sido marcadas como leídas', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
                    }
                }
            });
        }
    });
}

function escapeHtmlMovil(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}
</script>

</body>
</html>

