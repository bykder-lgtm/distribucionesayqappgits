<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* ====================== SISTEMA DE NOTIFICACIONES MÓVIL ALÌADO ====================== */
.notification-bell-movil {
    position: fixed;
    bottom: 85px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #4169e1 0%, #2563eb 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white !important;
    font-size: 24px;
    box-shadow: 0 4px 20px rgba(65, 105, 225, 0.4);
    cursor: pointer;
    z-index: 9999;
    border: none;
    transition: all 0.3s ease;
}

.notification-bell-movil i {
    color: white !important;
}

.notification-bell-movil.has-notifications {
    animation: pulse-blue-notif 2s infinite;
}

@keyframes pulse-blue-notif {
    0% { box-shadow: 0 0 0 0 rgba(65, 105, 225, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(65, 105, 225, 0); }
    100% { box-shadow: 0 0 0 0 rgba(65, 105, 225, 0); }
}

.notification-badge-movil {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ff4757;
    color: white;
    font-size: 11px;
    font-weight: 800;
    padding: 3px 7px;
    border-radius: 12px;
    border: 2px solid #1a1f2e;
    min-width: 18px;
    text-align: center;
    line-height: 1;
}

.notification-panel-movil {
    position: fixed;
    bottom: 160px;
    right: 20px;
    width: 320px;
    max-width: 90vw;
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 20px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.5);
    z-index: 10000;
    display: none;
    flex-direction: column;
    overflow: hidden;
    backdrop-filter: blur(15px);
    transform-origin: bottom right;
    animation: scaleInNotifAliado 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

@keyframes scaleInNotifAliado {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.notification-panel-movil.show {
    display: flex;
}

.notification-header-movil {
    padding: 18px 20px;
    background: rgba(65, 105, 225, 0.15);
    border-bottom: 1px solid rgba(65, 105, 225, 0.2);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.notification-header-movil h4 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #00d4ff;
    display: flex;
    align-items: center;
    gap: 8px;
}

.notification-header-actions-movil {
    display: flex;
    gap: 8px;
}

.notification-header-actions-movil button {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: white;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 11px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.notification-header-actions-movil button:hover {
    background: rgba(255, 255, 255, 0.2);
}

.notification-list-movil {
    max-height: 350px;
    overflow-y: auto;
}

.notification-item-movil {
    padding: 14px 18px;
    border-bottom: 1px solid rgba(65, 105, 225, 0.1);
    cursor: pointer;
    transition: background 0.2s ease;
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.notification-item-movil:hover {
    background: rgba(65, 105, 225, 0.1);
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
    background: linear-gradient(135deg, #4169e1 0%, #2563eb 100%);
    color: white;
}

.notification-icon-movil.type-2 {
    background: linear-gradient(135deg, #ff6f00 0%, #ff9800 100%);
    color: white;
}

.notification-icon-movil.type-3 {
    background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
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
    color: rgba(255,255,255,0.7);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.notification-time-movil {
    font-size: 10px;
    color: #00d4ff;
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
    color: rgba(65, 105, 225, 0.3);
}

.notification-empty-movil p {
    margin: 0;
    font-size: 14px;
}

/* Scrollbar personalizado */
.notification-list-movil::-webkit-scrollbar {
    width: 4px;
}

.notification-list-movil::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
}

.notification-list-movil::-webkit-scrollbar-thumb {
    background: rgba(65, 105, 225, 0.3);
    border-radius: 2px;
}
</style>

<!-- Botón flotante de notificaciones -->
<button class="notification-bell-movil" id="notificationBellConfirm" onclick="toggleNotificationPanelMovil()">
    <i class="fa-solid fa-bell"></i>
    <span class="notification-badge-movil" id="notificationBadgeConfirm" style="display: none;">0</span>
</button>

<!-- Panel de notificaciones -->
<div class="notification-panel-movil" id="notificationPanelConfirm">
    <div class="notification-header-movil">
        <h4><i class="fa-solid fa-bell"></i> Notificaciones</h4>
        <div class="notification-header-actions-movil">
            <button onclick="marcarTodasLeidasMovil()" title="Marcar todas como leídas">
                <i class="fa-solid fa-check-double"></i> Leer todas
            </button>
            <button onclick="toggleNotificationPanelMovil()" title="Cerrar">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
    <div class="notification-list-movil" id="notificationListConfirm">
        <div class="notification-empty-movil">
            <i class="fa-solid fa-bell-slash"></i>
            <p>No hay notificaciones pendientes</p>
        </div>
    </div>
</div>

<script>
// ====================== SISTEMA DE NOTIFICACIONES MÓVIL ======================
// Usar nombres únicos para evitar conflictos si se incluye dos veces
var notifIntervalAliado = null;

$(document).ready(function() { initNotificacionesAliado(); });

function initNotificacionesAliado() {
    cargarNotificacionesAliado();
    if (notifIntervalAliado) clearInterval(notifIntervalAliado);
    notifIntervalAliado = setInterval(cargarNotificacionesAliado, 30000);
}

function cargarNotificacionesAliado() {
    $.ajax({
        url: '../admin/obtener_notificaciones_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            if (response.success) { actualizarUINotificacionesAliado(response.notificaciones, response.count); }
        },
        error: function() { console.log('Error al cargar notificaciones'); }
    });
}

function actualizarUINotificacionesAliado(notificaciones, count) {
    var $badge = $('#notificationBadgeConfirm');
    var $bell = $('#notificationBellConfirm');
    var $list = $('#notificationListConfirm');
    
    if (count > 0) { $badge.text(count > 99 ? '99+' : count).show(); $bell.addClass('has-notifications'); } else { $badge.hide(); $bell.removeClass('has-notifications'); }
    
    if (notificaciones.length > 0) {
        var html = '';
        notificaciones.forEach(function(notif) {
            var iconClass = 'type-' + (notif.tipo || 1);
            var iconSymbol = getNotificationIconSymbol(notif.tipo);
            html += '<div class="notification-item-movil" onclick="marcarNotificacionLeidaAliado(' + notif.id + ', this)">';
            html += '  <div class="notification-icon-movil ' + iconClass + '"><i class="' + iconSymbol + '"></i></div>';
            html += '  <div class="notification-content-movil">';
            html += '    <div class="notification-title-movil">' + escapeHtmlNotif(notif.titulo) + '</div>';
            html += '    <div class="notification-desc-movil">' + escapeHtmlNotif(notif.descripcion) + '</div>';
            html += '    <div class="notification-time-movil"><i class="fa fa-clock-o"></i> ' + notif.fecha_corta + '</div>';
            html += '  </div>';
            html += '</div>';
        });
        $list.html(html);
    } else {
        $list.html('<div class="notification-empty-movil"><i class="fa fa-bell-slash"></i><p>No hay notificaciones pendientes</p></div>');
    }
}

function getNotificationIconSymbol(tipo) {
    switch(parseInt(tipo)) {
        case 1: return 'fa-solid fa-signature';
        case 2: return 'fa-solid fa-triangle-exclamation';
        case 3: return 'fa-solid fa-circle-info';
        default: return 'fa-solid fa-bell';
    }
}

function toggleNotificationPanelMovil() { $('#notificationPanelConfirm').toggleClass('show'); }

$(document).on('click', function(e) { if (!$(e.target).closest('#notificationPanelConfirm, #notificationBellConfirm').length) { $('#notificationPanelConfirm').removeClass('show'); } });

function marcarNotificacionLeidaAliado(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { cod_notificacion: codNotificacion }, dataType: 'json',
        success: function(response) {
            if (response.success) { $(element).fadeOut(300, function() { $(this).remove(); cargarNotificacionesAliado(); }); }
        }
    });
}

function marcarTodasLeidasMovil() {
    var swalConfig = { title: '¿Marcar todas como leídas?', text: 'Se marcarán todas las notificaciones pendientes como leídas', icon: 'question', showCancelButton: true, confirmButtonColor: '#4169e1', cancelButtonColor: '#6c757d', confirmButtonText: 'Sí, marcar todas', cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white' };

    if (typeof Swal !== 'undefined') {
        Swal.fire(swalConfig).then((result) => { if (result.isConfirmed) { procesarMarcarTodasLeidasAliado(); } });
    } else {
        if (confirm('¿Marcar todas como leídas?')) { procesarMarcarTodasLeidasAliado(); }
    }
}

function procesarMarcarTodasLeidasAliado() {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php',
        type: 'POST',
        data: { marcar_todas: 'si' },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                cargarNotificacionesAliado();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon: 'success', title: '¡Listo!', text: 'Todas las notificaciones han sido marcadas como leídas', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
                }
            }
        }
    });
}

function escapeHtmlNotif(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}
</script>
