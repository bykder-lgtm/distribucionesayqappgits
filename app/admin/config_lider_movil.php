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

<style><?php include_once("../estilo_css/estilo_config_lider.css"); ?></style>

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

            <a href="parametrizacion_ptj_gestor_operador_credito_lider.php" class="menu-item">
                <div class="menu-item-icon orange">
                    <i class="fa-solid fa-percent"></i>
                </div>
                <div class="menu-item-content">
                    <div class="menu-item-title">% Gestor Operador Crédito</div>
                    <div class="menu-item-desc">Editar porcentajes por gestor</div>
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
<!--
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
-->
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
        url: '../admin/obtener_notificaciones_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) { if (response.success) actualizarUINotificacionesMovil(response.notificaciones, response.count); }
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
        url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { cod_notificacion: codNotificacion }, dataType: 'json',
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

function escapeHtmlMovil(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}
</script>

</body>
</html>

