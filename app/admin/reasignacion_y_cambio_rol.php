<?php 
$nombre_pagina          = "Reasignación y Cambio de Rol";
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
        
        .wizard-step { background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .wizard-step h3 { font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; color: #a78bfa; }
        
        .form-select, .form-control { background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.4); color: white; }
        .form-select:focus, .form-control:focus { background: rgba(139, 92, 246, 0.1); border-color: #a78bfa; color: white; box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.25); }
        .form-select option { background: #1a1f2e; color: white; }
        
        .table-container { background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 15px; overflow: hidden; display: none; }
        .table { margin-bottom: 0; color: #ffffff !important; }
        .table-dark { background-color: rgba(139, 92, 246, 0.3) !important; --bs-table-bg: transparent; --bs-table-color: #ffffff; --bs-table-border-color: rgba(139, 92, 246, 0.2); }
        .table-hover tbody tr:hover td { background-color: rgba(139, 92, 246, 0.2) !important; color: #ffffff !important; cursor: pointer; }
        .table td, .table th { border-bottom: 1px solid rgba(139, 92, 246, 0.2); padding: 1rem; vertical-align: middle; color: #ffffff !important; }
        .table tbody td { background: transparent; }
        
        /* Sobrescribir Primary al Púrpura del Tema */
        .text-primary { color: #a78bfa !important; }
        .bg-primary { background-color: #8b5cf6 !important; }
        .btn-primary { background-color: #8b5cf6; border-color: #8b5cf6; color: white; }
        .btn-primary:hover { background-color: #7c3aed; border-color: #7c3aed; box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4); color: white; }
        .border-primary { border-color: #8b5cf6 !important; }
        
        .btn-siguiente { 
            background: #f59e0b; 
            border: none; 
            color: white; 
            font-weight: 600; 
            border-radius: 50px; 
            padding: 1rem 2rem; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            font-size: 1.1rem; 
            position: fixed; 
            bottom: 80px; 
            right: 20px; 
            z-index: 1000; 
            box-shadow: 0 5px 20px rgba(245, 158, 11, 0.4); 
            display: none; /* Se oculta por defecto hasta que haya seleccionados */
        }
        .btn-siguiente:hover:not(:disabled) { transform: translateY(-3px) scale(1.02); box-shadow: 0 8px 25px rgba(245, 158, 11, 0.6); }
        .btn-siguiente:disabled { opacity: 0; pointer-events: none; transform: translateY(20px); }
        
        .swal2-container { z-index: 9999 !important; }
        .swal-custom-select { width: 100%; padding: 0.75rem; border-radius: 8px; border: 1px solid #ccc; margin-top: 10px; margin-bottom: 15px; }
        .swal-textarea { width: 100%; padding: 0.75rem; border-radius: 8px; border: 1px solid #ccc; margin-top: 5px; margin-bottom: 15px; min-height: 100px; resize: vertical; }
        
        /* Mobile Responsive Table (Card View) */
        @media (max-width: 768px) {
            .table-responsive { border: none !important; margin: 0; padding: 0; }
            .table thead { display: none; }
            .table, .table tbody, .table tr, .table td { display: block; width: 100%; text-align: right; }
            .table tr { margin-bottom: 1rem; background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 10px; padding: 0.5rem; }
            .table td { padding: 0.5rem 0.5rem; border-bottom: 1px solid rgba(139, 92, 246, 0.1); position: relative; padding-left: 45%; min-height: 45px; display: flex; justify-content: flex-end; align-items: center;}
            .table td:last-child { border-bottom: none; }
            .table td::before { 
                content: attr(data-label); 
                position: absolute; 
                left: 0.5rem; 
                font-weight: 600; 
                text-transform: uppercase; 
                font-size: 0.75rem; 
                color: #a78bfa; 
                text-align: left; 
                width: 40%;
                white-space: nowrap;
                display: flex;
                align-items: center;
            }
            .table td > div { text-align: right; width: 100%; }
        }
    </style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Obtener las acciones
$sql_acciones = "SELECT cod_tipo_reasignacion_usuario, nombre_tipo_reasignacion_usuario FROM tbl15_tipo_reasignacion_usuario WHERE cod_estado = '1' ORDER BY cod_tipo_reasignacion_usuario ASC";
$res_acciones = mysqli_query($conectar, $sql_acciones);
$opciones_acciones = '<option value="" selected disabled>-- Seleccione una Acción --</option>';
while($row = mysqli_fetch_assoc($res_acciones)) { $opciones_acciones .= '<option value="'.$row['cod_tipo_reasignacion_usuario'].'">'.$row['nombre_tipo_reasignacion_usuario'].'</option>'; }
// Obtener los roles (Estado = 1)
$sql_roles = "SELECT cod_seguridad, nombre_seguridad FROM tbl15_seguridad WHERE cod_estado = '1' ORDER BY nombre_seguridad ASC";
$res_roles = mysqli_query($conectar, $sql_roles);
$opciones_roles = '<option value="" selected disabled>-- Seleccione un Rol (Afectados) --</option>';
$todos_los_roles = [];
while($row = mysqli_fetch_assoc($res_roles)) {
    $opciones_roles .= '<option value="'.$row['cod_seguridad'].'">'.$row['nombre_seguridad'].'</option>';
    $todos_los_roles[] = $row;
}
// Obtener los motivos
$sql_motivos = "SELECT nombre_tipo_motivo_reasignacion_superior_gerarquico FROM tbl15_tipo_motivo_reasignacion_superior_gerarquico WHERE cod_estado = '1' ORDER BY cod_tipo_motivo_reasignacion_superior_gerarquico ASC";
$res_motivos = mysqli_query($conectar, $sql_motivos);
$opciones_motivos = '<option value="" selected disabled>-- Seleccione un Motivo --</option>';
while($row = mysqli_fetch_assoc($res_motivos)) { $opciones_motivos .= '<option value="'.$row['nombre_tipo_motivo_reasignacion_superior_gerarquico'].'">'.$row['nombre_tipo_motivo_reasignacion_superior_gerarquico'].'</option>'; }
?>

<main class="page-container">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1><i class="fa-solid fa-users-gear"></i> Gestión de Usuarios</h1>
            <p>Realiza reasignaciones de superiores jerárquicos o cambios de rol de usuario.</p>
        </div>
        <div class="mt-3 mt-md-0 position-relative" style="z-index: 2;">
            <a href="historial_reasignacion_y_cambio_rol.php" class="btn btn-outline-light" style="border-radius: 20px; font-weight: 500;">
                <i class="fa-solid fa-clock-rotate-left"></i> Ver Historial
            </a>
        </div>
    </div>

    <div class="wizard-step" id="step-1">
        <h3>1. ¿Qué acción deseas realizar?</h3>
        <select id="select_accion" class="form-select mb-3">
            <?php echo $opciones_acciones; ?>
        </select>
        
        <div id="container-rol" style="display:none;">
            <h3>2. Selecciona sobre qué rol se aplicará la acción</h3>
            <select id="select_rol" class="form-select">
                <?php echo $opciones_roles; ?>
            </select>
        </div>
    </div>

    <div class="table-container" id="container-usuarios">
        <div class="d-flex justify-content-between align-items-center p-3">
            <h4 class="mb-0 text-white" style="font-size: 1.25rem;"><i class="fa-solid fa-list"></i> Usuarios del Rol Seleccionado</h4>
            <span class="badge bg-primary" id="span_conteo">0 Seleccionados</span>
        </div>
        
        <div class="p-3">
            <input type="text" id="buscador-usuarios" class="form-control" placeholder="Buscar por nombre o ID...">
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="tabla_usuarios">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center" style="width: 50px;">
                            <input class="form-check-input" type="checkbox" id="check-all">
                        </th>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col" id="th_estado_actual">Superior/Rol Actual</th>
                    </tr>
                </thead>
                <tbody id="tbody_usuarios">
                    <!-- Rellenado por AJAX -->
                </tbody>
            </table>
        </div>
        
        <div class="p-4 text-center">
            <button class="btn-siguiente" id="btn-siguiente" disabled>
                Continuar <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>

    <!-- Modal Reasignacion / Cambio Rol -->
    <div class="modal fade" id="modalAccion" tabindex="-1" aria-labelledby="modalAccionLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #1a1f2e; border: 1px solid rgba(139, 92, 246, 0.4); color: white; border-radius: 15px;">
                <div class="modal-header" style="border-bottom: 1px solid rgba(139, 92, 246, 0.2);">
                    <h5 class="modal-title fw-bold" id="modalAccionLabel">Título</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="formModalAccion">
                        <div class="mb-4">
                            <label id="labelNuevoValor" class="form-label fw-bold text-primary"><i class="fa-solid fa-user-tag"></i> Nuevo Valor</label>
                            <select id="modal_nuevo_valor" class="form-select shadow-none border-primary">
                                <!-- Opciones inyectadas por JS -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-primary"><i class="fa-solid fa-pen-to-square"></i> Motivo (Breve)</label>
                            <select id="modal_motivo" class="form-select shadow-none border-primary">
                                <?php echo $opciones_motivos; ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold text-primary"><i class="fa-solid fa-align-left"></i> Descripción / Observación</label>
                            <textarea id="modal_descripcion" class="form-control shadow-none" rows="4" placeholder="Detalle la razón de este cambio..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgba(139, 92, 246, 0.2);">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" style="border-radius: 8px;">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnConfirmarAccion" style="border-radius: 8px; font-weight: 600;"><i class="fa-solid fa-check"></i> Confirmar</button>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Variables globales
    let arrayRoles = <?php echo json_encode($todos_los_roles); ?>;
    let modalAccionInstancia = null;
    let estadoModalIds = [];
    let estadoModalAccion = 1;

    document.addEventListener('DOMContentLoaded', function() {
        const selectAccion = document.getElementById('select_accion');
        const selectRol = document.getElementById('select_rol');
        const containerRol = document.getElementById('container-rol');
        const containerUsuarios = document.getElementById('container-usuarios');
        const tbodyUsuarios = document.getElementById('tbody_usuarios');
        const thEstadoActual = document.getElementById('th_estado_actual');
        const btnSiguiente = document.getElementById('btn-siguiente');
        const checkAll = document.getElementById('check-all');
        const buscadorUsuarios = document.getElementById('buscador-usuarios');
        const spanConteo = document.getElementById('span_conteo');

        selectAccion.addEventListener('change', function() {
            containerRol.style.display = 'block';
            selectRol.value = '';
            containerUsuarios.style.display = 'none';
        });

        selectRol.addEventListener('change', function() { cargarUsuarios(); });

        function cargarUsuarios() {
            let accion = selectAccion.value;
            let rol = selectRol.value;

            if(!accion || !rol) return;

            Swal.fire({ title: 'Cargando usuarios...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            $.ajax({
                url: 'reasignacion_y_cambio_rol_ajax.php', type: 'POST', dataType: 'json', data: { op: 'cargar_usuarios', cod_rol: rol, cod_accion: accion },
                success: function(response) {
                    Swal.close();
                    if(response.success) {
                        tbodyUsuarios.innerHTML = '';
                        if(accion === '1') { thEstadoActual.innerText = 'Superior Actual'; } else { thEstadoActual.innerText = 'Rol Actual'; }

                        if(response.data.length === 0) {
                            tbodyUsuarios.innerHTML = '<tr><td colspan="4" class="text-center">No se encontraron usuarios activos para este rol.</td></tr>';
                        } else {
                            response.data.forEach(user => {
                                let infoActualHtml = '';
                                if(accion === '1') {
                                    if(user.nombre_superior && user.nombre_superior !== 'Sin Asignar') {
                                        infoActualHtml = `
                                            <div class="fw-bold text-primary">${user.nombre_superior}</div>
                                            <div style="font-size: 0.85rem; color: rgba(255,255,255,0.6); margin-top: 2px;">
                                                <i class="fa-solid fa-id-card"></i> ${user.cedula_superior || 'Sin Cédula Registrada'}
                                            </div>
                                        `;
                                    } else {
                                        infoActualHtml = `<span class="badge bg-danger">Sin Asignar</span>`;
                                    }
                                } else {
                                    let nom = user.nombre_rol || 'Sin Rol';
                                    infoActualHtml = `<span class="badge bg-primary">${nom}</span>`;
                                }
                                let tr = document.createElement('tr');
                                let labelEstado = (accion === '1') ? 'Superior Actual' : 'Rol Actual';
                                tr.innerHTML = `
                                    <td class="text-center" data-label="Seleccionar">
                                        <input class="form-check-input chk-item" type="checkbox" value="${user.cod_administrador}">
                                    </td>
                                    <td style="color: rgba(255,255,255,0.7);" data-label="ID">#${user.cod_administrador}</td>
                                    <td data-label="Usuario">
                                        <div>
                                            <div class="fw-bold">${user.nombre_completo}</div>
                                            <div style="font-size: 0.85rem; color: rgba(255,255,255,0.6); margin-top: 2px;">
                                                <i class="fa-solid fa-id-card"></i> ${user.cedula || 'Sin Cédula Registrada'}
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="${labelEstado}">${infoActualHtml}</td>
                                `;
                                tbodyUsuarios.appendChild(tr);
                            });
                        }
                        containerUsuarios.style.display = 'block';
                        bindTableEvents();
                        actualizarBoton();
                    } else {
                        Swal.fire('Error', response.message || 'Error al cargar los usuarios', 'error');
                    }
                },
                error: function() { Swal.fire('Error', 'Problema de conexión', 'error'); }
            });
        }

        function bindTableEvents() {
            checkAll.checked = false;
            
            checkAll.addEventListener('change', function() {
                let isChecked = this.checked;
                document.querySelectorAll('.chk-item').forEach(chk => chk.checked = isChecked);
                actualizarBoton();
            });

            document.querySelectorAll('.chk-item').forEach(chk => { chk.addEventListener('change', actualizarBoton); });
            document.querySelectorAll('#tbody_usuarios tr').forEach(row => {
                row.addEventListener('click', function(e) {
                    if(e.target.tagName !== 'INPUT' && e.target.tagName !== 'BUTTON') {
                        let chk = this.querySelector('.chk-item');
                        if(chk) { chk.checked = !chk.checked; actualizarBoton(); }
                    }
                });
            });
        }

        function actualizarBoton() {
            let checkedItems = document.querySelectorAll('.chk-item:checked');
            let totalItems = document.querySelectorAll('.chk-item');
            spanConteo.innerText = `${checkedItems.length} Seleccionados`;
            
            if(checkedItems.length > 0) { 
                btnSiguiente.disabled = false; 
                btnSiguiente.style.display = 'block'; 
            } else { 
                btnSiguiente.disabled = true; 
                btnSiguiente.style.display = 'none'; 
            }
            if(totalItems.length > 0) { checkAll.checked = (checkedItems.length === totalItems.length); }
        }

        buscadorUsuarios.addEventListener('input', function() {
            let term = this.value.toLowerCase();
            document.querySelectorAll('#tbody_usuarios tr').forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });

        btnSiguiente.addEventListener('click', function() {
            let accionSeleccionada = selectAccion.value; // 1 = Reasignación Sup, 2 = Cambio Rol
            let idsSeleccionados = Array.from(document.querySelectorAll('.chk-item:checked')).map(chk => chk.value);
            if(accionSeleccionada === '1') { /*REASIGNACION*/ cargarSuperiores(idsSeleccionados); } else { /*CAMBIO ROL*/ mostrarModalCambioRol(idsSeleccionados); }
        });

        function cargarSuperiores(ids) {
            let rolActual = selectRol.value;
            // Pedimos ajax para traer los posibles superiores según el rol
            Swal.fire({ title: 'Obteniendo opciones...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            $.ajax({
                url: 'reasignacion_y_cambio_rol_ajax.php', type: 'POST', dataType: 'json', data: { op: 'obtener_superiores', cod_rol: rolActual },
                success: function(resp) {
                    Swal.close();
                    if(resp.success) { mostrarModalSuperior(ids, resp.data); } else { Swal.fire('Atención', resp.message || 'No se encontraron superiores para este rol.', 'warning'); }
                },
                error: function() { 
                    Swal.close();
                    Swal.fire('Error', 'Problema de conexión', 'error'); 
                }
            });
        }

        function mostrarModalSuperior(ids, opciones_superiores) {
            estadoModalIds = ids;
            estadoModalAccion = 1;

            let optsHtml = '<option value="" disabled selected>-- Seleccione el nuevo superior --</option>';
            optsHtml += '<option value="0">Ninguno (Dejar sin asignar)</option>';
            opciones_superiores.forEach(sup => { optsHtml += `<option value="${sup.cod_administrador}">${sup.nombres}</option>`; });

            document.getElementById('modalAccionLabel').innerText = 'Reasignar Superior Jerárquico';
            document.getElementById('labelNuevoValor').innerHTML = '<i class="fa-solid fa-user-tie"></i> Nuevo Superior';
            document.getElementById('modal_nuevo_valor').innerHTML = optsHtml;
            document.getElementById('modal_motivo').value = '';
            document.getElementById('modal_descripcion').value = '';
            
            if(!modalAccionInstancia) modalAccionInstancia = new bootstrap.Modal(document.getElementById('modalAccion'));
            modalAccionInstancia.show();
        }

        function mostrarModalCambioRol(ids) {
            estadoModalIds = ids;
            estadoModalAccion = 2;

            let optsHtml = '<option value="" disabled selected>-- Seleccione el nuevo rol --</option>';
            arrayRoles.forEach(rol => { optsHtml += `<option value="${rol.cod_seguridad}">${rol.nombre_seguridad}</option>`; });

            document.getElementById('modalAccionLabel').innerText = 'Cambio de Rol de Usuario';
            document.getElementById('labelNuevoValor').innerHTML = '<i class="fa-solid fa-user-shield"></i> Nuevo Rol';
            document.getElementById('modal_nuevo_valor').innerHTML = optsHtml;
            document.getElementById('modal_motivo').value = '';
            document.getElementById('modal_descripcion').value = '';

            if(!modalAccionInstancia) modalAccionInstancia = new bootstrap.Modal(document.getElementById('modalAccion'));
            modalAccionInstancia.show();
        }

        document.getElementById('btnConfirmarAccion').addEventListener('click', function() {
            let nuevo_val = document.getElementById('modal_nuevo_valor').value;
            let motivo = document.getElementById('modal_motivo').value.trim();
            let desc = document.getElementById('modal_descripcion').value.trim();

            if(!nuevo_val) { Swal.fire('Atención', 'Debes seleccionar el ' + (estadoModalAccion === 1 ? 'nuevo superior' : 'nuevo rol'), 'warning'); return; }
            if(!motivo) { Swal.fire('Atención', 'Debes indicar un motivo breve', 'warning'); return; }

            modalAccionInstancia.hide();
            ejecutarAccion(estadoModalAccion, estadoModalIds, { nuevo_valor: nuevo_val, motivo: motivo, descripcion: desc });
        });

        function ejecutarAccion(cod_accion, arrayIds, datos) {
            Swal.fire({ title: 'Ejecutando operación...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

            $.ajax({
                url: 'reasignacion_y_cambio_rol_ajax.php', type: 'POST', dataType: 'json', data: { op: 'ejecutar_accion', cod_accion: cod_accion, ids_usuarios: arrayIds, nuevo_valor: datos.nuevo_valor, motivo: datos.motivo, descripcion: datos.descripcion },
                success: function(resp) {
                    Swal.close();
                    if(resp.success) { 
                        Swal.fire({ icon: 'success', title: '¡Operación Exitosa!', text: resp.message, confirmButtonText: 'Aceptar', showConfirmButton: true }).then(() => { cargarUsuarios(); }); 
                    } else { 
                        Swal.fire('Error', resp.message || 'Fallo en la operación', 'error'); 
                    }
                },
                error: function() { 
                    Swal.close();
                    Swal.fire('Error', 'Problema de conexión con el servidor', 'error'); 
                }
            });
        }
    });
</script>
</body>
</html>
