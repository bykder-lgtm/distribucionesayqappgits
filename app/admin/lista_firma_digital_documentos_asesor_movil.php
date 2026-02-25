<?php 
$nombre_pagina          = "Documentos de Firma";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
?>
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_asesor.php"); ?>
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_asesor.php"); ?>

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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* ============================================ */
/* LISTA FIRMAS ASESOR - TEMA VERDE             */
/* ============================================ */
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #090c10 0%, #161b22 100%);
    color: #e6edf3;
    min-height: 100vh;
}
.page-container { padding: 1rem; padding-bottom: 100px; max-width: 800px; margin: 0 auto; }
.header-card {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 20px; padding: 1.5rem; margin-bottom: 1.5rem;
    box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);
}
.header-title { font-size: 1.5rem; font-weight: 800; display: flex; align-items: center; gap: 0.75rem; }
.header-subtitle { opacity: 0.9; font-size: 0.85rem; margin-top: 0.25rem; }

/* Filters */
.filters-section { background: rgba(22, 27, 34, 0.8); border-radius: 15px; padding: 1rem; border: 1px solid rgba(16, 185, 129, 0.2); margin-bottom: 1.5rem; }
.search-group { position: relative; margin-bottom: 0.75rem; }
.search-input {
    width: 100%; background: rgba(13, 17, 23, 0.8); border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.5rem; color: white; outline: none; transition: 0.3s;
}
.search-input:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); }
.search-icon { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #10b981; opacity: 0.6; }

.date-filters { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 0.75rem; }
.date-input {
    background: rgba(13, 17, 23, 0.8); border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 10px; padding: 0.5rem; color: #e6edf3; width: 100%; outline: none;
}

/* Tabs */
.status-tabs { display: flex; background: rgba(13, 17, 23, 0.5); border-radius: 12px; padding: 4px; margin-bottom: 1rem; border: 1px solid rgba(255,255,255,0.05); }
.status-tab {
    flex: 1; text-align: center; padding: 0.6rem; border-radius: 10px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: 0.3s;
}
.status-tab.active { background: #10b981; color: white; }
.status-tab:not(.active) { color: rgba(255,255,255,0.5); }

/* Card styles */
.doc-card {
    background: #161b22; border: 1px solid rgba(255,255,255,0.1); border-radius: 15px; padding: 1rem; margin-bottom: 1rem;
    position: relative; overflow: hidden;
}
.doc-card.inactive { opacity: 0.6; grayscale: 1; }
.doc-card::before {
    content: ''; position: absolute; left: 0; top: 0; height: 100%; width: 4px;
}
.doc-card.signed::before { background: #10b981; }
.doc-card.pending::before { background: #f59e0b; }

.doc-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem; }
.doc-type { font-size: 0.7rem; font-weight: 700; color: #10b981; text-transform: uppercase; letter-spacing: 0.5px; }
.doc-date { font-size: 0.75rem; color: #8b949e; }

.ally-name { font-size: 1rem; font-weight: 700; color: white; margin-bottom: 0.25rem; }
.ally-ident { font-size: 0.8rem; color: #8b949e; display: flex; align-items: center; gap: 0.4rem; }

.signature-badge {
    display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.25rem 0.6rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700;
}
.badge-signed { background: rgba(16, 185, 129, 0.1); color: #10b981; }
.badge-pending { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
.badge-inactive { background: rgba(239, 68, 68, 0.1); color: #ef4444; }

.signature-container {
    margin-top: 1rem; padding: 0.75rem; background: white; border-radius: 10px; text-align: center;
}
.signature-img { max-width: 100%; height: auto; max-height: 100px; filter: grayscale(1) contrast(1.5); }

.doc-actions {
    display: flex; gap: 0.5rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.05);
}
.action-btn {
    flex: 1; border: none; padding: 0.6rem; border-radius: 10px; font-weight: 600; font-size: 0.75rem; cursor: pointer; transition: 0.2s;
    display: flex; align-items: center; justify-content: center; gap: 0.4rem;
}
.btn-disable { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
.btn-enable { background: rgba(16, 185, 129, 0.1); color: #10b981; }
.btn-share { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }

.empty-state { text-align: center; padding: 3rem 1rem; opacity: 0.4; }
.empty-icon { font-size: 3rem; margin-bottom: 1rem; }
.swal-custom-input {
    background: #0d1117 !important;
    border: 1px solid #333 !important;
    color: white !important;
    border-radius: 10px !important;
}
</style>
</head>
<body>

<div class="page-container">
    <div class="header-card">
        <div class="header-title">
            <i class="fa-solid fa-file-signature"></i> Firma Digital
        </div>
        <div class="header-subtitle">Control de documentos y trazabilidad de firmas</div>
    </div>

    <!-- Filtros -->
    <div class="filters-section">
        <div class="search-group">
            <i class="fa-solid fa-search search-icon"></i>
            <input type="text" id="filterText" class="search-input" placeholder="Buscar por nombre o identificación..." onkeyup="filtrarContenido()">
        </div>
        
        <div class="date-filters">
            <div>
                <label style="font-size: 0.7rem; color: #8b949e; margin-bottom: 4px; display: block;">Desde</label>
                <input type="date" id="dateDesde" class="date-input" onchange="filtrarContenido()">
            </div>
            <div>
                <label style="font-size: 0.7rem; color: #8b949e; margin-bottom: 4px; display: block;">Hasta</label>
                <input type="date" id="dateHasta" class="date-input" onchange="filtrarContenido()">
            </div>
        </div>

        <div class="status-tabs">
            <div class="status-tab active" data-status="todos" onclick="setTab(this)">Todos</div>
            <div class="status-tab" data-status="firmado" onclick="setTab(this)">Firmados</div>
            <div class="status-tab" data-status="pendiente" onclick="setTab(this)">Pendientes</div>
        </div>
    </div>

    <div id="loading" style="text-align: center; padding: 2rem; display: none;">
        <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 2rem; color: #10b981;"></i>
    </div>

    <div id="recordsContainer">
        <!-- Los registros se cargarán aquí por AJAX -->
    </div>
</div>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

<script>
let currentTab = 'todos';

$(document).ready(function() {
    cargarRegistros();
});

function setTab(el) {
    $('.status-tab').removeClass('active');
    $(el).addClass('active');
    currentTab = $(el).data('status');
    cargarRegistros();
}

function filtrarContenido() {
    // Podríamos filtrar localmente si cargamos todos, pero por volumen es mejor recargar si es necesario
    // Por ahora haremos búsqueda local para inmediatez si ya están cargados
    cargarRegistros();
}

function cargarRegistros() {
    $('#loading').show();
    $('#recordsContainer').hide();

    $.ajax({
        url: 'obtener_lista_documentos_firma_ajax.php',
        type: 'POST',
        data: {
            buscar: $('#filterText').val(),
            desde: $('#dateDesde').val(),
            hasta: $('#dateHasta').val(),
            filtro_status: currentTab
        },
        dataType: 'json',
        success: function(response) {
            $('#loading').hide();
            $('#recordsContainer').fadeIn();
            
            if (response.success) {
                renderRecords(response.data);
            } else {
                $('#recordsContainer').html('<div class="empty-state"><div class="empty-icon">❌</div><p>'+response.message+'</p></div>');
            }
        },
        error: function() {
            $('#loading').hide();
            $('#recordsContainer').show().html('<div class="empty-state"><div class="empty-icon">⚠️</div><p>Error al conectar con el servidor</p></div>');
        }
    });
}

function renderRecords(data) {
    let html = '';
    if (!data || data.length === 0) {
        html = '<div class="empty-state"><div class="empty-icon">📤</div><p>No se encontraron registros</p></div>';
    } else {
        data.forEach(function(doc) {
            const isSigned = doc.cod_estado_firma_signature == 1;
            const isActive = doc.cod_estado == 1;
            const cardClass = isSigned ? 'signed' : 'pending';
            const statusClass = isActive ? '' : 'inactive';
            
            html += `
                <div class="doc-card ${cardClass} ${statusClass}">
                    <div class="doc-header">
                        <span class="doc-type">${doc.nombre_tipo_firma_digital}</span>
                        <span class="doc-date">${doc.fecha_creacion}</span>
                    </div>
                    
                    <div class="ally-name">${doc.nombres} ${doc.apellidos}</div>
                    <div class="ally-ident">
                        <i class="fa-solid fa-id-card"></i> ${doc.identificacion}
                    </div>
                    ${doc.nombre_tienda ? `
                    <div class="ally-ident" style="color: #10b981; font-weight: 600; margin-top: 4px;">
                        <i class="fa-solid fa-store"></i> ${doc.nombre_tienda}
                    </div>
                    ` : ''}
                    
                    <div style="margin-top: 0.75rem; display: flex; gap: 0.5rem; align-items:center;">
                        ${isSigned ? 
                            '<span class="signature-badge badge-signed"><i class="fa-solid fa-check-double"></i> Firmado</span>' : 
                            '<span class="signature-badge badge-pending"><i class="fa-solid fa-clock"></i> Pendiente</span>'
                        }
                        ${!isActive ? '<span class="signature-badge badge-inactive"><i class="fa-solid fa-ban"></i> Inhabilitado</span>' : ''}
                    </div>

                    ${isSigned && doc.base64_firma ? `
                        <div class="signature-container">
                            <p style="color: #666; font-size: 0.65rem; margin-bottom: 5px; font-weight: 700;">FIRMA REGISTRADA EL ${doc.fecha_firma}</p>
                            <img src="${doc.base64_firma}" class="signature-img" alt="Firma">
                        </div>
                    ` : ''}

                    <div class="doc-actions">
                        ${isActive ? 
                            `<button class="action-btn btn-disable" onclick="cambiarEstado(${doc.id}, 0)">
                                <i class="fa-solid fa-trash-can"></i> Inhabilitar
                            </button>` : 
                            `<button class="action-btn btn-enable" onclick="cambiarEstado(${doc.id}, 1)">
                                <i class="fa-solid fa-undo"></i> Reactivar
                            </button>`
                        }
                        
                        ${!isSigned && isActive ? `
                            <button class="action-btn btn-share" onclick="abrirModalCompartir('${doc.token}', '${doc.hash}', '${doc.nombres} ${doc.apellidos}')">
                                <i class="fa-solid fa-share-nodes"></i> Compartir
                            </button>
                        ` : ''}
                    </div>
                </div>
            `;
        });
    }
    $('#recordsContainer').html(html);
}

function cambiarEstado(id, estado) {
    const titulo = (estado === 0) ? '¿Inhabilitar documento?' : '¿Reactivar documento?';
    const texto = (estado === 0) ? 'El enlace ya no podrá ser usado para firmar.' : 'El enlace volverá a estar disponible.';
    
    Swal.fire({
        title: titulo,
        text: texto,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: estado === 0 ? '#ef4444' : '#10b981',
        confirmButtonText: 'Sí, continuar',
        background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'cambiar_estado_documento_firma_ajax.php',
                type: 'POST',
                data: { cod_documento: id, estado: estado },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        Swal.fire({ icon: 'success', title: '¡Hecho!', text: res.message, timer: 1500, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
                        cargarRegistros();
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: res.message, background: '#1a1f2e', color: 'white' });
                    }
                }
            });
        }
    });
}

function abrirModalCompartir(token, hash, nombre) {
    const protocol = window.location.protocol;
    const host = window.location.host;
    const path = window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/'));
    const url = `${protocol}//${host}${path}/firma_digital_aliado.php?token=${token}&hash=${hash}`;

    Swal.fire({
        title: 'Reenviar Enlace',
        html: `
            <div style="text-align: left;">
                <p style="font-size: 0.85rem; margin-bottom: 10px;">Enlace para <strong>${nombre}</strong>:</p>
                <input type="text" id="swal_link" value="${url}" readonly style="width:100%; padding: 8px; border-radius: 8px; border: 1px solid #444; background: #0d1117; color: white; font-size: 0.8rem;">
            </div>
        `,
        showConfirmButton: true,
        confirmButtonText: 'Copiar Enlace',
        showCancelButton: true,
        cancelButtonText: 'Cerrar',
        confirmButtonColor: '#8b5cf6',
        background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            const input = document.getElementById('swal_link');
            input.select();
            document.execCommand('copy');
            Swal.fire({ icon: 'success', title: '¡Copiado!', timer: 1000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
        }
    });
}
</script>

</body>
</html>
