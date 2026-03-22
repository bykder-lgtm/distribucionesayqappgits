<?php
$nombre_pagina          = "Tablero de Tareas";
$cod_seguridad_pag      = "2";
$pagina_local           = $_SERVER['PHP_SELF'];

// ****************************** MODULO DE SESION ******************************
include_once("../admin/01_admin_modulo_inicio_sesion_adm_asesor.php");
include_once("../admin/01_admin_modulo_info_empresa_adm_asesor.php");
// ******************************************************************************

// Consultar mis tareas (Asesor)
$sql_tareas = "
SELECT 
    t.*, 
    a.nombres_apellidos_tercero AS nombre_asignado,
    c.nombres_apellidos_tercero AS nombre_creador
FROM tbl15_tarea t 
LEFT JOIN tbl15_administrador a ON t.cod_administrador_asignado = a.cod_administrador 
LEFT JOIN tbl15_administrador c ON t.cod_administrador_creador = c.cod_administrador 
WHERE t.cod_estado = '1' AND (t.cod_administrador_asignado = '$cod_administrador' OR t.cod_administrador_creador = '$cod_administrador') 
ORDER BY t.fecha_modificacion DESC";
$resultado_tareas = mysqli_query($conectar, $sql_tareas);

// Obtener administradores externos para asignación (como Asesor, asignar a quienes estén debajo)
$sql_externos = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_estado != '0' AND cod_asesor = '$cod_administrador' ORDER BY nombres_apellidos_tercero ASC";
$res_externos = mysqli_query($conectar, $sql_externos);

$opciones_estado = ['BACKLOG', 'POR HACER', 'EN PROGRESO', 'EN REVISION', 'TERMINADO'];
$tareas_agrupadas = ['BACKLOG' => [], 'POR HACER' => [], 'EN PROGRESO' => [], 'EN REVISION' => [], 'TERMINADO' => []];

if ($resultado_tareas) {
    while($tarea = mysqli_fetch_assoc($resultado_tareas)) {
        $estado = $tarea['nombre_estado_tarea'];
        if(isset($tareas_agrupadas[$estado])) { $tareas_agrupadas[$estado][] = $tarea; }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($nombre) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Select2 CDN -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* Estilos adaptados heredados del Kanban del Líder (Variante Visual Verde Esmeralda) */
:root {
    --theme-color: #10b981; /* Emerald para Asesor */
    --theme-color-rgb: 16, 185, 129;
    --bg-dark: #0d1117;
    --card-bg: rgba(255,255,255,0.05);
}

/* Ajustes para Select2 en modo oscuro con estetica Premium */
.select2-container--default .select2-selection--single {
    background: rgba(var(--theme-color-rgb), 0.1) !important;
    border: 1px solid rgba(var(--theme-color-rgb), 0.3) !important;
    border-radius: 12px !important;
    height: 48px !important;
    display: flex !important;
    align-items: center !important;
    transition: all 0.3s ease !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: white !important; padding-left: 1.25rem !important; font-size: 0.95rem !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow { height: 46px !important; right: 10px !important; }
.select2-container--default.select2-container--open .select2-selection--single { border-color: var(--theme-color) !important; box-shadow: 0 0 0 3px rgba(var(--theme-color-rgb), 0.2) !important; }
.select2-dropdown {
    background: #1a1f2e !important; border: 1px solid rgba(var(--theme-color-rgb), 0.4) !important;
    border-radius: 12px !important; box-shadow: 0 10px 40px rgba(0,0,0,0.5) !important; color: white !important; overflow: hidden !important; z-index: 9999 !important;
}
.select2-results__option { padding: 10px 15px !important; font-size: 0.9rem !important; transition: all 0.2s ease !important; }
.select2-container--default .select2-results__option--highlighted[aria-selected] { background: rgba(var(--theme-color-rgb), 0.8) !important; color: white !important; }
.select2-search--dropdown { padding: 10px !important; background: #0d1117 !important; }
.select2-search--dropdown .select2-search__field { background: rgba(255,255,255,0.05) !important; border: 1px solid rgba(var(--theme-color-rgb), 0.3) !important; color: white !important; padding: 8px 12px !important; border-radius: 8px !important; outline: none !important; }
.select2-container { z-index: 10000 !important; width: 100% !important; }

body { background-color: var(--bg-dark); color: white; font-family: 'Inter', sans-serif; margin: 0; padding: 0 0 80px 0; }

.kanban-board { display: flex; overflow-x: auto; padding: 1rem; gap: 1rem; scroll-snap-type: x mandatory; height: calc(100vh - 150px); }
.kanban-board::-webkit-scrollbar { height: 8px; }
.kanban-board::-webkit-scrollbar-thumb { background: rgba(var(--theme-color-rgb), 0.5); border-radius: 4px; }

.kanban-column {
    min-width: 85vw; max-width: 85vw; background: rgba(255,255,255,0.02); border: 1px solid rgba(var(--theme-color-rgb), 0.1); border-radius: 16px; display: flex; flex-direction: column; scroll-snap-align: center;
}
@media (min-width: 768px) { .kanban-column { min-width: 320px; max-width: 350px; scroll-snap-align: start; } }

.column-header { padding: 1rem; border-bottom: 2px solid rgba(var(--theme-color-rgb), 0.3); font-weight: 700; text-transform: uppercase; font-size: 0.9rem; display: flex; justify-content: space-between; align-items: center; }
.column-badge { background: rgba(var(--theme-color-rgb), 0.2); padding: 0.2rem 0.6rem; border-radius: 12px; font-size: 0.8rem; color: var(--theme-color); }
.column-body { padding: 1rem; overflow-y: auto; flex-grow: 1; display: flex; flex-direction: column; gap: 1rem; }

.task-card { background: var(--card-bg); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 1rem; transition: all 0.2s; position: relative; }
.task-card:active { transform: scale(0.98); }

.task-title { font-size: 1rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--theme-color); }
.task-desc { font-size: 0.8rem; color: rgba(255,255,255,0.6); display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

.task-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; border-top: 1px dashed rgba(255,255,255,0.1); padding-top: 0.8rem; }
.task-tag { font-size: 0.65rem; font-weight: 700; padding: 0.2rem 0.5rem; border-radius: 6px; }

.tag-bug { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
.tag-historia { background: rgba(59, 130, 246, 0.2); color: #3b82f6; }
.tag-tarea { background: rgba(16, 185, 129, 0.2); color: #10b981; }

.task-priority.alta, .task-priority.critica { color: #ef4444; }
.task-priority.media { color: #f59e0b; }

.fab-btn {
    position: fixed; bottom: 90px; right: 20px; width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4); font-size: 1.5rem; z-index: 1000; cursor: pointer; border: none; color: white;
}
/* Tabs for separation */
.tabs-container { display:flex; justify-content:flex-start; gap: 0.5rem; margin-top: 1rem; margin-bottom: 0.5rem; padding: 0 1rem; overflow-x: auto; scrollbar-width: none; }
.tabs-container::-webkit-scrollbar { display: none; }
.tab-btn { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); padding: 0.5rem 1.2rem; border-radius: 20px; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: all 0.3s ease; white-space: nowrap; }
.tab-btn.active { background: var(--theme-color); color: white; border-color: var(--theme-color); box-shadow: 0 4px 10px rgba(var(--theme-color-rgb), 0.3); }
.badge-user-assoc { background: rgba(255,255,255,0.05); padding: 0.35rem 0.5rem; border-radius: 8px; font-size: 0.7rem; color: #cbd5e1; display: flex; align-items: center; gap: 0.4rem; margin-top: 0.8rem; border: 1px dashed rgba(255,255,255,0.1); }
.badge-user-assoc i { color: var(--theme-color); }

/* Modal Estilos Nativos */
.modal-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.8); backdrop-filter: blur(5px);
    z-index: 2000; display: none; align-items: center; justify-content: center;
}
.modal-overlay.show { display: flex; }
.modal-content {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 20px; width: 90%; max-width: 500px;
    max-height: 90vh; overflow-y: auto; padding: 0;
    animation: modalFadeIn 0.3s ease;
    border: 1px solid rgba(var(--theme-color-rgb), 0.3);
}
@keyframes modalFadeIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
.modal-header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 1.5rem; border-bottom: 1px solid rgba(var(--theme-color-rgb), 0.2);
    position: sticky; top: 0; background: #1a1f2e; border-radius: 20px 20px 0 0; z-index: 10;
}
.modal-header h2 { color: white; font-size: 1.25rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 0.5rem; }
.modal-header h2 i { color: var(--theme-color); }
.modal-close { background: rgba(239, 68, 68, 0.2); color: #ef4444; border: none; width: 40px; height: 40px; border-radius: 12px; cursor: pointer; font-size: 1rem; }
.modal-body { padding: 1.5rem; }
.form-group { margin-bottom: 1rem; text-align: left; }
.form-label { display: block; color: rgba(255,255,255,0.8); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; }
.form-input, .form-select, .form-textarea {
    width: 100%; background: rgba(var(--theme-color-rgb), 0.1); border: 1px solid rgba(var(--theme-color-rgb), 0.3);
    border-radius: 12px; padding: 0.85rem 1rem; color: white; font-size: 0.95rem; outline: none; transition: all 0.3s ease; box-sizing: border-box;
    font-family: inherit;
}
.form-input:focus, .form-select:focus, .form-textarea:focus { border-color: var(--theme-color); box-shadow: 0 0 0 3px rgba(var(--theme-color-rgb), 0.2); }
.form-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1rem; }
.form-select option { background-color: #1a1f2e; color: white; }
.form-textarea { resize: vertical; min-height: 80px; }
.btn-submit {
    width: 100%; padding: 1rem; background: var(--theme-color); color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 1rem; margin-top: 1rem; cursor: pointer; transition: all 0.3s ease;
}
.btn-submit:hover { filter: brightness(1.1); transform: translateY(-2px); }
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<div style="padding: 1.5rem 1rem 0 1rem;">
    <h1 style="font-size: 1.5rem; margin:0;"><i class="fa-solid fa-list-check" style="color:var(--theme-color);"></i> Tablero Asesor</h1>
    <p style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:5px;">Ejecuta tus tareas asignadas</p>
</div>

<div class="tabs-container">
    <button class="tab-btn active" onclick="filtrarTareas('mis_tareas', this)"><i class="fa-solid fa-user-check"></i> Mis Tareas</button>
    <button class="tab-btn" onclick="filtrarTareas('delegadas', this)"><i class="fa-solid fa-users"></i> Delegadas a Otros</button>
</div>

<!-- Kanban Board -->
<div class="kanban-board">
    <?php foreach($opciones_estado as $estado) { ?>
        <div class="kanban-column">
            <div class="column-header">
                <?php echo $estado; ?>
                <span class="column-badge"><?php echo count($tareas_agrupadas[$estado]); ?></span>
            </div>
            <div class="column-body">
                <?php if(empty($tareas_agrupadas[$estado])) { ?>
                    <div style="text-align:center; padding: 2rem; color:rgba(255,255,255,0.3); font-size:0.8rem;">
                        Sin tareas
                    </div>
                <?php } else { 
                    foreach($tareas_agrupadas[$estado] as $t) {
                        $clase_tipo = 'tag-tarea';
                        if($t['nombre_tipo_tarea'] == 'BUG') $clase_tipo = 'tag-bug';
                        if($t['nombre_tipo_tarea'] == 'HISTORIA DE USUARIO') $clase_tipo = 'tag-historia';
                        $clase_prio = strtolower($t['nombre_prioridad_tarea']);
                        $es_mia = ($t['cod_administrador_asignado'] == $cod_administrador);
                        $filtro_clase = $es_mia ? 'mis_tareas' : 'delegadas';
                        $nom_asig = !empty($t['nombre_asignado']) ? explode(' ', $t['nombre_asignado'])[0] : 'N/A';
                        $nom_crea = !empty($t['nombre_creador']) ? explode(' ', $t['nombre_creador'])[0] : 'N/A';
                ?>
                <div class="task-card filter-<?php echo $filtro_clase; ?>" onclick="verTarea(<?php echo $t['cod_tarea']; ?>)">
                    <div style="display:flex; justify-content:space-between; margin-bottom:0.8rem;">
                        <span class="task-tag <?php echo $clase_tipo; ?>"><i class="fa-solid fa-tag"></i> <?php echo $t['nombre_tipo_tarea']; ?></span>
                        <span class="task-priority <?php echo $clase_prio; ?>" title="Prioridad: <?php echo $t['nombre_prioridad_tarea']; ?>"><i class="fa-solid fa-flag"></i></span>
                    </div>
                    <div class="task-title"><?php echo htmlspecialchars($t['nombre_tarea']); ?></div>
                    <div class="task-desc"><?php echo htmlspecialchars($t['descripcion_tarea']); ?></div>

                    <?php if(!$es_mia) { // La delegué yo a otra persona ?>
                        <div class="badge-user-assoc"><i class="fa-solid fa-arrow-right"></i> <span>Para: <b><?php echo ucwords(strtolower($nom_asig)); ?></b></span></div>
                    <?php } else if($t['cod_administrador_creador'] != $cod_administrador) { // Me la delegaron ?>
                        <div class="badge-user-assoc"><i class="fa-solid fa-arrow-left"></i> <span>De: <b><?php echo ucwords(strtolower($nom_crea)); ?></b></span></div>
                    <?php } ?>

                    <div class="task-footer">
                        <span style="font-size:0.7rem; color:rgba(255,255,255,0.5);"><i class="fa-solid fa-calendar"></i> <?php echo date('d M', strtotime($t['fecha_creacion'])); ?></span>
                        <button onclick="event.stopPropagation(); moverTarea(<?php echo $t['cod_tarea']; ?>, '<?php echo $t['nombre_estado_tarea']; ?>')" style="background:transparent; border:1px solid rgba(255,255,255,0.2); color:white; border-radius:8px; padding:0.3rem 0.6rem; font-size:0.7rem; cursor:pointer;"><i class="fa-solid fa-arrow-right"></i> Mover</button>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    <?php } ?>
</div>

<button class="fab-btn" onclick="abrirModalNuevaTarea()">
    <i class="fa-solid fa-plus"></i>
</button>

<!-- Modal Registro Tarea -->
<div class="modal-overlay" id="modalNuevaTarea">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-list-check"></i> Nueva Tarea Scrum</h2>
            <button class="modal-close" onclick="cerrarModalNuevaTarea()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="formNuevaTarea" onsubmit="guardarTarea(event)">
                <div class="form-group">
                    <label class="form-label">Título de la Tarea</label>
                    <input type="text" class="form-input" id="tarea_titulo" placeholder="Ej: Fix login button" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-textarea" id="tarea_desc" placeholder="Detalles de la tarea..." ></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Tipo de Tarea</label>
                    <select class="form-select" id="tarea_tipo" required>
                        <option value="TAREA">Tarea</option>
                        <option value="HISTORIA DE USUARIO">Historia de Usuario</option>
                        <option value="BUG">Bug</option>
                        <option value="EPICA">Épica</option>
                    </select>
                </div>
                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group" style="margin: 0;">
                        <label class="form-label">Tipo Asignación</label>
                        <select class="form-select" id="tarea_tipo_asignacion" onchange="toggleAsignado(this.value)" required>
                            <option value="PROPIA">Propia</option>
                            <option value="EXTERNO">Externo</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin: 0; opacity: 0.5;">
                        <label class="form-label">Asignar a</label>
                        <select class="form-select" id="tarea_asignado" disabled required>
                            <option value="">Seleccione usuario...</option>
                            <?php 
                            if(isset($res_externos)) {
                                mysqli_data_seek($res_externos, 0);
                                while($ext = mysqli_fetch_assoc($res_externos)) {
                                    echo '<option value="'.$ext['cod_administrador'].'">'.htmlspecialchars($ext['nombres_apellidos_tercero']).'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Prioridad</label>
                    <select class="form-select" id="tarea_prio" required>
                        <option value="BAJA">Baja</option>
                        <option value="MEDIA" selected>Media</option>
                        <option value="ALTA">Alta</option>
                        <option value="CRITICA">Crítica</option>
                    </select>
                </div>
                <button type="submit" class="btn-submit">Guardar Tarea</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Actualizar Estado -->
<div class="modal-overlay" id="modalActualizarEstado">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-person-walking-arrow-right"></i> Actualizar Estado</h2>
            <button type="button" class="modal-close" onclick="cerrarModalActualizarEstado()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="formActualizarEstado" onsubmit="guardarEstadoTarea(event)">
                <input type="hidden" id="estado_cod_tarea" value="">
                
                <div class="form-group">
                    <label class="form-label">Nuevo Estado</label>
                    <select class="form-select" id="estado_nuevo_estado" required>
                        <!-- Opciones dinámicas -->
                    </select>
                </div>
                
                <button type="submit" class="btn-submit">Aceptar y Actualizar</button>
            </form>
        </div>
    </div>
</div>

<!-- Bottom Menu -->
<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

<script>
// Funcionalidad espejo para UI
$(document).ready(function() {
    $('#tarea_asignado').select2({
        dropdownParent: $('#modalNuevaTarea'),
        placeholder: "Buscar usuario...",
        width: '100%'
    });
    // Correr filtro inicial de Mis Tareas
    filtrarTareas('mis_tareas', document.querySelector('.tab-btn.active'));
});

function filtrarTareas(tipo, btn) {
    if(btn) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }
    
    document.querySelectorAll('.task-card').forEach(card => {
        if (card.classList.contains('filter-' + tipo)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    // Actualizar contadores por columna
    document.querySelectorAll('.kanban-column').forEach(col => {
        let count = 0;
        col.querySelectorAll('.task-card').forEach(card => {
            if (card.style.display === 'block') count++;
        });
        col.querySelector('.column-badge').innerText = count;
    });
}

function toggleAsignado(valor) {
    const selectorAsignado = document.getElementById('tarea_asignado');
    if (valor === 'EXTERNO') {
        selectorAsignado.disabled = false;
        selectorAsignado.parentElement.style.opacity = '1';
    } else {
        selectorAsignado.disabled = true;
        selectorAsignado.value = '';
        selectorAsignado.parentElement.style.opacity = '0.5';
    }
}

function abrirModalNuevaTarea() {
    document.getElementById('modalNuevaTarea').classList.add('show');
}

function cerrarModalNuevaTarea() {
    document.getElementById('modalNuevaTarea').classList.remove('show');
}

function guardarTarea(event) {
    event.preventDefault();
    const titulo = document.getElementById('tarea_titulo').value;
    const desc = document.getElementById('tarea_desc').value;
    const tipo = document.getElementById('tarea_tipo').value;
    const asignacion = document.getElementById('tarea_tipo_asignacion').value;
    const asignado = document.getElementById('tarea_asignado').value;
    const prio = document.getElementById('tarea_prio').value;

    Swal.fire({title: 'Guardando...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }});
    
    $.ajax({
        type: 'POST', url: 'guardar_tarea_ajax_reg.php', data: { titulo: titulo, descripcion: desc, tipo: tipo, tipo_asignacion: asignacion, asignado: asignado, prioridad: prio }, dataType: 'json',
        success: function(response){
            if(response.afectado === 'SI'){
                cerrarModalNuevaTarea();
                document.getElementById('formNuevaTarea').reset();
                $('#tarea_asignado').val(null).trigger('change');
                Swal.fire('Creada', response.mensaje, 'success').then(() => { location.reload(); });
            } else {
                Swal.fire('Error', response.mensaje, 'error');
            }
        },
        error: function(err){
            Swal.fire('Error', 'Hubo un error de conexión con el servidor.', 'error');
        }
    });
}

function moverTarea(cod_tarea, estado_actual) {
    const estados = ['BACKLOG', 'POR HACER', 'EN PROGRESO', 'EN REVISION', 'TERMINADO'];
    let optionsHtml = '';
    estados.forEach(e => {
        if(e !== estado_actual) { optionsHtml += `<option value="${e}">${e}</option>`; }
    });
    
    document.getElementById('estado_cod_tarea').value = cod_tarea;
    document.getElementById('estado_nuevo_estado').innerHTML = optionsHtml;
    document.getElementById('modalActualizarEstado').classList.add('show');
}

function cerrarModalActualizarEstado() {
    document.getElementById('modalActualizarEstado').classList.remove('show');
}

function guardarEstadoTarea(event) {
    event.preventDefault();
    const cod_tarea = document.getElementById('estado_cod_tarea').value;
    const nuevo_estado = document.getElementById('estado_nuevo_estado').value;

    cerrarModalActualizarEstado();
    Swal.fire({title: 'Actualizando...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }});
    
    $.ajax({
        type: 'POST', url: 'actualizar_estado_tarea_ajax_reg.php', data: { cod_tarea: cod_tarea, nuevo_estado: nuevo_estado }, dataType: 'json',
        success: function(response){
            if(response.afectado === 'SI'){
                Swal.fire('Listo', response.mensaje, 'success').then(() => location.reload());
            } else {
                Swal.fire('Error', response.mensaje, 'error');
            }
        },
        error: function(err){
            Swal.fire('Error', 'Hubo un error de conexión con el servidor.', 'error');
        }
    });
}
</script>
</body>
</html>
