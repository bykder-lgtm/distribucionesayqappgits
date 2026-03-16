<?php 
$nombre_pagina          = "Historial: Asignaciones y Roles";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="../js/jquery-3.2.1.min_visitante.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%); min-height: 100vh; color: white; }
        .page-container { padding: 1.5rem; padding-bottom: 100px; max-width: 1400px; margin: 0 auto; width: 100%; }
        
        .page-header { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%); border-radius: 20px; padding: 1.5rem; margin-bottom: 1.5rem; position: relative; overflow: hidden; box-shadow: 0 10px 40px rgba(139, 92, 246, 0.4); }
        .page-header::before { content: ''; position: absolute; top: -50%; right: -20%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; }
        .page-header h1 { color: white; font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem; position: relative; z-index: 1; }
        .page-header p { color: rgba(255,255,255,0.8); font-size: 0.95rem; position: relative; z-index: 1; margin-bottom: 0; }
        
        .form-control { background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.4); color: white; }
        .form-control:focus { background: rgba(139, 92, 246, 0.1); border-color: #a78bfa; color: white; box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.25); }
        
        .table-container { background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 15px; overflow: hidden; }
        .table { margin-bottom: 0; color: #ffffff !important; }
        .table-dark { background-color: rgba(139, 92, 246, 0.3) !important; --bs-table-bg: transparent; --bs-table-color: #ffffff; --bs-table-border-color: rgba(139, 92, 246, 0.2); }
        .table-hover tbody tr:hover td { background-color: rgba(139, 92, 246, 0.2) !important; color: #ffffff !important;}
        .table td, .table th { border-bottom: 1px solid rgba(139, 92, 246, 0.2); padding: 1rem; vertical-align: middle; color: #ffffff !important; }
        .table tbody td { background: transparent; }
        
        /* Sobrescribir Primary al Púrpura del Tema */
        .text-primary { color: #a78bfa !important; }
        .bg-primary { background-color: #8b5cf6 !important; }
        .btn-primary { background-color: #8b5cf6; border-color: #8b5cf6; color: white; }
        .btn-primary:hover { background-color: #7c3aed; border-color: #7c3aed; box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4); color: white; }
        .border-primary { border-color: #8b5cf6 !important; }
        
        .badge.bg-reasignacion { background-color: #10b981 !important; color: white; padding: 0.4rem 0.6em; }
        .badge.bg-cambio-rol { background-color: #6366f1 !important; color: white; padding: 0.4rem 0.6em; }
        
        .cambio-box { padding: 8px; border-radius: 6px; background: rgba(255,255,255,0.05); font-size: 0.85rem; line-height: 1.4; border: 1px solid rgba(255,255,255,0.1); margin-top:5px; margin-bottom:5px; }
        .cambio-box strong { color: #60a5fa; }
    </style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<main class="page-container">
    <div class="page-header">
        <h1><i class="fa-solid fa-clock-rotate-left"></i> Historial de Cambios</h1>
        <p>Registro de reasignaciones de superiores jerárquicos y cambios de rol.</p>
    </div>

    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap" style="gap:15px;">
            <h4 class="mb-0 text-white" style="font-size: 1.25rem;"><i class="fa-solid fa-file-signature"></i> Registros</h4>
            <div style="flex-grow: 1; max-width: 400px;">
                <div class="input-group">
                    <span class="input-group-text bg-transparent text-white" style="border-color: rgba(139, 92, 246, 0.4);"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" id="buscador-historial" class="form-control" placeholder="Buscar afectado, responsable, acción...">
                </div>
            </div>
            <a href="reasignacion_y_cambio_rol.php" class="btn btn-primary" style="border-radius:20px; font-weight: 500;">
                <i class="fa-solid fa-arrow-left"></i> Volver a Asignar
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="tabla_historial">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="width: 120px;">ID / Fecha</th>
                        <th scope="col">Responsable</th>
                        <th scope="col">Usuario Afectado</th>
                        <th scope="col">Acción Ejecutada</th>
                        <th scope="col" style="min-width: 300px;">Detalles del Cambio</th>
                    </tr>
                </thead>
                <tbody id="tbody_historial">
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fa-solid fa-spinner fa-spin fa-2x"></i> <br/>Cargando registros...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tbodyHistorial = document.getElementById('tbody_historial');
        const buscadorHistorial = document.getElementById('buscador-historial');

        cargarHistorial();

        function cargarHistorial() {
            $.ajax({
                url: 'historial_reasignacion_y_cambio_rol_ajax.php', type: 'POST', dataType: 'json', data: { op: 'cargar_historial' },
                success: function(resp) {
                    tbodyHistorial.innerHTML = '';
                    if(resp.success && resp.data.length > 0) {
                        resp.data.forEach(item => {
                            let claseBadge = (item.cod_accion == '1') ? 'bg-reasignacion' : 'bg-cambio-rol';
                            let iconBadge = (item.cod_accion == '1') ? '<i class="fa-solid fa-user-tie"></i>' : '<i class="fa-solid fa-user-shield"></i>';
                            
                            let htmlDetalles = '';
                            if(item.cod_accion == '1') {
                                htmlDetalles = `<div class="cambio-box"><div><strong>De:</strong> ${item.detalle_cambios.superior_anterior || 'Ninguno'}</div><div><strong>Para:</strong> ${item.detalle_cambios.superior_nuevo || 'Ninguno'}</div></div>`;
                            } else {
                                htmlDetalles = `<div class="cambio-box"><div><strong>De:</strong> ${item.detalle_cambios.rol_anterior || 'Ninguno'}</div><div><strong>Para:</strong> ${item.detalle_cambios.rol_nuevo || 'Ninguno'}</div></div>`;
                            }
                            
                            let descVisual = item.descripcion.length > 50 ? item.descripcion.substring(0, 50) + '...' : item.descripcion;

                            let tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>
                                    <div class="fw-bold text-primary">#${item.id_historial}</div>
                                    <div style="font-size: 0.8rem; color: rgba(255,255,255,0.7);">${item.fecha}</div>
                                </td>
                                <td>
                                    <div class="fw-bold">${item.responsable}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-warning">${item.afectado}</div>
                                    <div style="font-size: 0.85rem; color: rgba(255,255,255,0.6);">
                                        <i class="fa-solid fa-id-card"></i> ${item.afectado_doc}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge ${claseBadge} rounded-pill mb-1">${iconBadge} ${item.accion}</span>
                                </td>
                                <td>
                                    <div><i class="fa-solid fa-comment-dots text-secondary"></i> <em>${item.motivo}</em></div>
                                    <div style="font-size: 0.85rem; opacity: 0.8; margin-bottom: 5px;">${descVisual}</div>
                                    ${htmlDetalles}
                                </td>
                            `;
                            tbodyHistorial.appendChild(tr);
                        });
                    } else {
                        tbodyHistorial.innerHTML = '<tr><td colspan="5" class="text-center py-4"><i class="fa-solid fa-folder-open fa-2x text-muted mb-2"></i><br/>No hay registros en el historial.</td></tr>';
                    }
                },
                error: function() {
                    tbodyHistorial.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Error de conexión cargando historial.</td></tr>';
                }
            });
        }

        buscadorHistorial.addEventListener('input', function() {
            let term = this.value.toLowerCase();
            document.querySelectorAll('#tbody_historial tr').forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });
    });
</script>
</body>
</html>
