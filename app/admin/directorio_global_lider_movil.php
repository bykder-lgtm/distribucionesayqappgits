<?php 
$nombre_pagina          = "Directorio Global";
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
        .page-header h1 { color: white; font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem; position: relative; z-index: 1; display:flex; align-items:center; gap:0.5rem;}
        .page-header p { color: rgba(255,255,255,0.8); font-size: 0.95rem; position: relative; z-index: 1; margin-bottom: 0; }
        
        .form-control, .form-select { background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.4); color: white; }
        .form-control:focus, .form-select:focus { background: rgba(139, 92, 246, 0.1); border-color: #a78bfa; color: white; box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.25); }
        .form-select option { background: #1a1f2e; color: white; }
        
        .user-card { background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 15px; overflow: hidden; padding: 1rem; position: relative; transition: all 0.3s ease; display:flex; flex-direction: column; gap: 0.5rem; }
        .user-card:hover { border-color: #a78bfa; box-shadow: 0 5px 20px rgba(139, 92, 246, 0.2); transform: translateY(-2px); }
        .user-card .role-badge { position: absolute; top: 1rem; right: 1rem; font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 20px; font-weight: 600; }
        
        .role-lider { background: rgba(139, 92, 246, 0.2); color: #c4b5fd; border: 1px solid #8b5cf6; }
        .role-coordinador { background: rgba(59, 130, 246, 0.2); color: #93c5fd; border: 1px solid #3b82f6; }
        .role-asesor { background: rgba(245, 158, 11, 0.2); color: #fcd34d; border: 1px solid #f59e0b; }
        .role-aliado { background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border: 1px solid #10b981; }
        .role-vendedor { background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid #ef4444; }
        .role-otro { background: rgba(107, 114, 128, 0.2); color: #d1d5db; border: 1px solid #6b7280; }

        .user-header { display: flex; align-items: center; gap: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem; margin-bottom: 0.5rem; }
        .user-header-icon { width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; background: rgba(255,255,255,0.05); }
        .user-info h5 { margin: 0; font-size: 1.1rem; font-weight: 700; color: white; padding-right: 80px; }
        .user-info p { margin: 0; font-size: 0.8rem; color: rgba(255,255,255,0.6); }

        .info-row { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.8); }
        .info-row i { width: 15px; color: #a78bfa; text-align: center; }
        
        .status-badge { font-size: 0.70rem; padding: 0.15rem 0.4rem; border-radius: 4px; }
        .status-activo { background: #10b981; color: white; }
        .status-inactivo { background: #ef4444; color: white; }
        
        .filter-container { background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 15px; padding: 1.5rem; margin-bottom: 2rem; }
    </style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<main class="page-container">
    <div class="page-header">
        <h1><i class="fa-solid fa-users-rays"></i> Directorio Global</h1>
        <p>Busca rápida y detalladamente a cualquier miembro de la red (Líderes, Coordinadores, Asesores, Aliados, Vendedores).</p>
    </div>

    <!-- Filtros y Buscador -->
    <div class="filter-container">
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-transparent text-white border-primary" style="border-color: rgba(139, 92, 246, 0.4) !important;"><i class="fa-solid fa-search"></i></span>
                    <input type="text" id="buscador" class="form-control" placeholder="Buscar por Nombre, Cédula, ID, Teléfono o Correo...">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <select id="filtro_rol" class="form-select">
                    <option value="">Todos los Roles</option>
                    <?php
                    $sql_roles = "SELECT cod_seguridad, nombre_seguridad FROM tbl15_seguridad WHERE cod_estado = '1' ORDER BY nombre_seguridad ASC";
                    $res_roles = mysqli_query($conectar, $sql_roles);
                    while($r = mysqli_fetch_assoc($res_roles)){
                        echo "<option value='".$r['cod_seguridad']."'>".$r['nombre_seguridad']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-3">
                <select id="filtro_estado" class="form-select">
                    <option value="">Todos los Estados</option>
                    <?php
                    $sql_est = "SELECT cod_estado_activacion_usuario, nombre_estado_activacion_usuario FROM tbl15_estado_activacion_usuario ORDER BY cod_estado_activacion_usuario ASC";
                    $res_est = mysqli_query($conectar, $sql_est);
                    if ($res_est && mysqli_num_rows($res_est) > 0) {
                        while($e = mysqli_fetch_assoc($res_est)){
                            echo "<option value='".$e['cod_estado_activacion_usuario']."'>".$e['nombre_estado_activacion_usuario']."</option>";
                        }
                    } else {
                        echo '<option value="1">Activos</option>';
                        echo '<option value="2">Pendiente</option>';
                        echo '<option value="3">Inactivos</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Contenedor Resultados -->
    <div class="row g-3" id="resultados_directorio">
        <!-- Render desde JS -->
    </div>
    
    <div class="text-center mt-4" id="loader_state" style="display:none;">
        <i class="fa-solid fa-spinner fa-spin fa-2x" style="color:#a78bfa;"></i>
        <p class="mt-2 text-muted">Buscando usuarios...</p>
    </div>

    <div class="text-center mt-4" id="btn_cargar_mas_container" style="display:none;">
        <button class="btn btn-outline-light rounded-pill px-4 py-2" style="border-color: rgba(139, 92, 246, 0.6); color: #c4b5fd;" id="btn_cargar_mas">
            <i class="fa-solid fa-plus"></i> Cargar Más Resultados
        </button>
    </div>

</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let offset = 0;
    const limit = 20;
    let loading = false;
    let endOfResults = false;
    let searchTimer = null;

    document.addEventListener('DOMContentLoaded', function() {
        const buscador = document.getElementById('buscador');
        const f_rol = document.getElementById('filtro_rol');
        const f_estado = document.getElementById('filtro_estado');
        const btnCargar = document.getElementById('btn_cargar_mas');

        // Initial Load
        buscarUsuarios(true);

        // Listeners Auto-Search (with debounce for typing)
        buscador.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => { buscarUsuarios(true); }, 500);
        });
        f_rol.addEventListener('change', () => { buscarUsuarios(true); });
        f_estado.addEventListener('change', () => { buscarUsuarios(true); });
        
        // Manual Load More Option
        btnCargar.addEventListener('click', () => { buscarUsuarios(false); });
    });

    function getRoleBadgeClass(roleName) {
        if(!roleName) return 'role-otro';
        let rn = roleName.toLowerCase();
        if(rn.includes('lider') || rn.includes('líder')) return 'role-lider';
        if(rn.includes('coordinador')) return 'role-coordinador';
        if(rn.includes('asesor')) return 'role-asesor';
        if(rn.includes('aliado')) return 'role-aliado';
        if(rn.includes('vendedor')) return 'role-vendedor';
        return 'role-otro';
    }

    function buscarUsuarios(reset) {
        if(loading) return;
        loading = true;

        const term = document.getElementById('buscador').value;
        const cod_rol = document.getElementById('filtro_rol').value;
        const cod_estado = document.getElementById('filtro_estado').value;
        const container = document.getElementById('resultados_directorio');
        const loader = document.getElementById('loader_state');
        const btnMore = document.getElementById('btn_cargar_mas_container');

        if(reset) {
            offset = 0;
            container.innerHTML = '';
            endOfResults = false;
        }

        if(endOfResults) { loading = false; return; }

        loader.style.display = 'block';
        btnMore.style.display = 'none';

        $.ajax({
            url: 'directorio_global_lider_movil_ajax.php', type: 'POST', dataType: 'json', data: { op: 'buscar_directorio', term: term, cod_rol: cod_rol, cod_estado: cod_estado, offset: offset, limit: limit },
            success: function(resp) {
                loader.style.display = 'none';
                loading = false;

                if(resp.success) {
                    if(resp.data.length < limit) { endOfResults = true; } else { btnMore.style.display = 'block'; }

                    if(resp.data.length === 0 && offset === 0) {
                        container.innerHTML = '<div class="col-12 text-center py-5"><i class="fa-solid fa-users-slash fa-3x mb-3 text-muted"></i><h5 class="text-muted">No se encontraron usuarios que coincidan con la búsqueda.</h5></div>';
                        return;
                    }

                    resp.data.forEach(user => {
                        let colorBadge = getRoleBadgeClass(user.rol_nombre);
                        
                        let estBadge = '';
                        if(user.estado_numero == '1') {
                            estBadge = '<span class="status-badge status-activo">Activo</span>';
                        } else if(user.estado_numero == '3') {
                            estBadge = '<span class="status-badge status-inactivo">Inactivo</span>';
                        } else if(user.estado_numero == '2') {
                            estBadge = '<span class="status-badge bg-warning text-dark">Pendiente/Otro</span>';
                        } else {
                            estBadge = '<span class="status-badge bg-secondary text-white">Estado ' + user.estado_numero + '</span>';
                        }
                        let jerarquia = '';
                        if(user.superior && user.superior !== 'Sin Asignar') {
                             jerarquia = `<div class="info-row"><i class="fa-solid fa-diagram-project"></i> Superior: ${user.superior}</div>`;
                        }

                        let card = document.createElement('div');
                        card.className = "col-12 col-md-6 col-lg-4";
                        card.innerHTML = `
                            <div class="user-card">
                                <span class="role-badge ${colorBadge}">${user.rol_nombre || 'Desconocido'}</span>
                                <div class="user-header">
                                    <div class="user-header-icon"><i class="fa-solid fa-user"></i></div>
                                    <div class="user-info">
                                        <h5>${user.nombre_completo}</h5>
                                        <p>ID: #${user.id} | CC: ${user.cedula}</p>
                                    </div>
                                </div>
                                <div class="info-row mt-1">
                                    <i class="fa-solid fa-phone"></i> ${user.telefono || 'No registrado'}
                                </div>
                                <div class="info-row">
                                    <i class="fa-solid fa-envelope"></i> ${user.correo || 'No registrado'}
                                </div>
                                ${jerarquia}
                                <div class="mt-2" style="display:flex; justify-content:space-between; align-items:center;">
                                    <div>
                                        <button class="btn btn-sm btn-outline-light me-1" style="border-radius:8px;" onclick="mostrarDetalle(${user.id})" title="Ver Detalle"><i class="fa-solid fa-eye text-primary"></i></button>
                                        <button class="btn btn-sm btn-outline-light" style="border-radius:8px;" onclick="mostrarEditar(${user.id})" title="Editar Usuario"><i class="fa-solid fa-pen text-warning"></i></button>
                                    </div>
                                    ${estBadge}
                                </div>
                            </div>
                        `;
                        container.appendChild(card);
                    });
                    offset += limit;
                } else {
                    Swal.fire('Error', resp.mensaje, 'error');
                }
            },
            error: function() {
                loader.style.display = 'none';
                loading = false;
                Swal.fire('Error', 'Fallo de conexión al buscar.', 'error');
            }
        });
    }
</script>

<!-- MODAL VER DETALLE -->
<div class="modal fade" id="modalVerUsuario" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#1a1f2e; color:white; border: 1px solid rgba(139, 92, 246, 0.3); border-radius:15px;">
      <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
        <h5 class="modal-title"><i class="fa-solid fa-circle-info" style="color:#8b5cf6;"></i> Detalle del Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-4">
            <div class="user-header-icon mx-auto" style="width:70px; height:70px; font-size:2rem; background: rgba(139, 92, 246, 0.2); color:#8b5cf6;"><i class="fa-solid fa-user"></i></div>
            <h5 class="mt-3 mb-1 fw-bold" id="vd_nombre">--</h5>
            <span class="badge" id="vd_rol" style="background: rgba(139, 92, 246, 0.3); color:#c4b5fd;">--</span>
        </div>
        <ul class="list-group list-group-flush" style="border-radius: 10px; overflow:hidden;">
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <span><i class="fa-solid fa-id-card text-muted me-2"></i> Identificación</span> <span id="vd_cedula" class="fw-semibold">--</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <span><i class="fa-solid fa-person-half-dress text-muted me-2"></i> Género</span> <span id="vd_sexo" class="fw-semibold text-end">--</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <span><i class="fa-solid fa-cake-candles text-muted me-2"></i> Nacimiento</span> <span id="vd_fecha_nac" class="fw-semibold text-end">--</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <span><i class="fa-solid fa-envelope text-muted me-2"></i> Correo</span> <span id="vd_correo" class="fw-semibold text-break text-end" style="max-width:60%;">--</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <span><i class="fa-solid fa-phone text-muted me-2"></i> Teléfonos</span> <span id="vd_telefono" class="fw-semibold text-end">--</span>
            </li>
            <li class="list-group-item d-flex flex-column" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <div><i class="fa-solid fa-map-location-dot text-muted me-2"></i> <span>Ubicación</span></div>
                <div class="fw-semibold mt-1" id="vd_direccion" style="padding-left: 1.5rem;">--</div>
                <div class="fw-semibold text-muted small mt-1" id="vd_barrio" style="padding-left: 1.5rem;">--</div>
                <div class="fw-semibold text-muted small mt-1" id="vd_dep_ciudad" style="padding-left: 1.5rem;">--</div>
            </li>
            <li class="list-group-item d-flex flex-column" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <div><i class="fa-solid fa-globe text-muted me-2"></i> <span>Redes Sociales</span></div>
                <div class="small mt-1 text-info text-break" id="vd_redes" style="padding-left: 1.5rem;">--</div>
            </li>
            <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <span class="w-100 mb-1"><i class="fa-solid fa-at text-muted me-2"></i> Nombre de Usuario / Cuenta</span>
                <span id="vd_cuenta" class="fw-bold text-warning" style="padding-left: 1.5rem;">--</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <span><i class="fa-solid fa-diagram-project text-muted me-2"></i> Superior</span> <span id="vd_superior" class="fw-semibold text-end" style="max-width:50%;">--</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <span><i class="fa-solid fa-calendar-days text-muted me-2"></i> Registrado</span> <span id="vd_fecha" class="fw-semibold text-end small">--</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05); color:white; border-color: rgba(255,255,255,0.05);">
                <span><i class="fa-solid fa-circle-check text-muted me-2"></i> Estado</span> <span id="vd_estado" class="fw-semibold">--</span>
            </li>
        </ul>
      </div>
      <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDITAR USUARIO -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#1a1f2e; color:white; border: 1px solid rgba(245, 158, 11, 0.4); border-radius:15px;">
      <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
        <h5 class="modal-title"><i class="fa-solid fa-pen-to-square" style="color:#f59e0b;"></i> Editar Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formEditarGlobal">
        <div class="modal-body">
            <input type="hidden" id="ed_cod_administrador" name="edit_id">
            
            <div class="mb-3">
                <label class="form-label text-light small mb-1">Nombre Completo</label>
                <input type="text" class="form-control" id="ed_nombre" name="edit_nombre_completo" required>
            </div>
            <div class="mb-3 d-flex gap-2">
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Nombres</label>
                    <input type="text" class="form-control" id="ed_nombres" name="edit_nombres">
                </div>
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Apellidos</label>
                    <input type="text" class="form-control" id="ed_apellidos" name="edit_apellidos">
                </div>
            </div>
            
            <div class="mb-3 d-flex gap-2">
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Tipo Identificación</label>
                    <select class="form-select" id="ed_tipo_identificacion" name="edit_tipo_identificacion">
                        <option value="C.C">C.C (Cédula)</option>
                        <option value="NIT">NIT</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                        <option value="C.E">C.E</option>
                    </select>
                </div>
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Número ID / Cédula</label>
                    <input type="text" class="form-control" id="ed_cedula" name="edit_cedula" required>
                </div>
            </div>

            <div class="mb-3 d-flex gap-2">
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Género / Sexo</label>
                    <select class="form-select" id="ed_nombre_sexo" name="edit_nombre_sexo">
                        <option value="">Seleccione</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMENINO">FEMENINO</option>
                        <option value="OTRO">OTRO</option>
                    </select>
                </div>
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="ed_fecha_nac" name="edit_fecha_nac_tercero">
                </div>
            </div>

            <div class="mb-3 d-flex gap-2">
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Teléfono Principal</label>
                    <input type="text" class="form-control" id="ed_telefono" name="edit_telefono">
                </div>
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Teléfono Alternativo</label>
                    <input type="text" class="form-control" id="ed_telefono2" name="edit_telefono2">
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label text-light small mb-1">Correo Electrónico</label>
                <input type="email" class="form-control" id="ed_correo" name="edit_correo">
            </div>

            <div class="mb-3 d-flex gap-2">
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Dirección</label>
                    <input type="text" class="form-control" id="ed_direccion" name="edit_direccion" placeholder="Dirección">
                </div>
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Barrio</label>
                    <input type="text" class="form-control" id="ed_barrio" name="edit_barrio" placeholder="Barrio">
                </div>
            </div>

            <div class="mb-3 d-flex gap-2">
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Departamento</label>
                    <input type="text" class="form-control" id="ed_departamento" name="edit_departamento" placeholder="Departamento">
                </div>
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Ciudad</label>
                    <input type="text" class="form-control" id="ed_ciudad" name="edit_ciudad" placeholder="Ciudad">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-light small mb-1">Redes Sociales (URLs)</label>
                <div class="input-group mb-2"><span class="input-group-text bg-dark text-white border-secondary"><i class="fa-brands fa-facebook"></i></span><input type="text" id="ed_facebook" name="edit_facebook" class="form-control" placeholder="URL Facebook"></div>
                <div class="input-group mb-2"><span class="input-group-text bg-dark text-white border-secondary"><i class="fa-brands fa-twitter"></i></span><input type="text" id="ed_twitter" name="edit_twitter" class="form-control" placeholder="URL Twitter"></div>
                <div class="input-group mb-2"><span class="input-group-text bg-dark text-white border-secondary"><i class="fa-brands fa-linkedin"></i></span><input type="text" id="ed_linkedin" name="edit_linkedin" class="form-control" placeholder="URL LinkedIn"></div>
                <div class="input-group"><span class="input-group-text bg-dark text-white border-secondary"><i class="fa-brands fa-skype"></i></span><input type="text" id="ed_skype" name="edit_skype" class="form-control" placeholder="Usuario Skype"></div>
            </div>
            
            <hr class="border-secondary border-opacity-50">

            <div class="mb-3 d-flex gap-2">
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Nombre de Usuario (Cuenta)</label>
                    <input type="text" class="form-control" id="ed_cuenta" name="edit_cuenta" placeholder="Usuario">
                </div>
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Nueva Contraseña</label>
                    <input type="text" class="form-control" id="ed_contrasena" name="edit_contrasena" placeholder="Dejar vacío para NO cambiar">
                </div>
            </div>

            <div class="mb-3 d-flex gap-2">
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Rol</label>
                    <select class="form-select" id="ed_rol" name="edit_rol" required>
                         <?php
                            $sql_roles_ed = "SELECT cod_seguridad, nombre_seguridad FROM tbl15_seguridad WHERE cod_estado = '1' ORDER BY nombre_seguridad ASC";
                            $res_roles_ed = mysqli_query($conectar, $sql_roles_ed);
                            while($r = mysqli_fetch_assoc($res_roles_ed)){
                                echo "<option value='".$r['cod_seguridad']."'>".$r['nombre_seguridad']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="w-50">
                    <label class="form-label text-light small mb-1">Estado</label>
                    <select class="form-select" id="ed_estado" name="edit_estado" required>
                        <?php
                            $sql_est2 = "SELECT cod_estado_activacion_usuario, nombre_estado_activacion_usuario FROM tbl15_estado_activacion_usuario ORDER BY cod_estado_activacion_usuario ASC";
                            $res_est2 = mysqli_query($conectar, $sql_est2);
                            if ($res_est2 && mysqli_num_rows($res_est2) > 0) {
                                while($e = mysqli_fetch_assoc($res_est2)){
                                    echo "<option value='".$e['cod_estado_activacion_usuario']."'>".$e['nombre_estado_activacion_usuario']."</option>";
                                }
                            } else {
                                echo '<option value="1">Activos</option>';
                                echo '<option value="2">Pendiente</option>';
                                echo '<option value="3">Inactivos</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-warning rounded-pill border-0" id="btn_guardar_edicion"><i class="fa-solid fa-save"></i> Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    let myModalVer = null;
    let myModalEditar = null;

    document.addEventListener('DOMContentLoaded', function() {
        myModalVer = new bootstrap.Modal(document.getElementById('modalVerUsuario'));
        myModalEditar = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));

        // Guardar Edición
        document.getElementById('formEditarGlobal').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('btn_guardar_edicion');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';
            btn.disabled = true;

            const formData = new FormData(this);
            formData.append('op', 'editar_usuario');

            $.ajax({
                url: 'directorio_global_lider_movil_ajax.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(resp) {
                    btn.innerHTML = '<i class="fa-solid fa-save"></i> Guardar Cambios';
                    btn.disabled = false;
                    if(resp.success) {
                        myModalEditar.hide();
                        Swal.fire({
                            icon: 'success', title: '¡Actualizado!', text: resp.mensaje, background: '#1a1f2e', color: 'white', timer: 1500, showConfirmButton: false
                        }).then(() => {
                            buscarUsuarios(true); // Refrescar lista
                        });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: resp.mensaje, background: '#1a1f2e', color: 'white' });
                    }
                },
                error: function() {
                    btn.innerHTML = '<i class="fa-solid fa-save"></i> Guardar Cambios';
                    btn.disabled = false;
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Hubo un error de conexión.', background: '#1a1f2e', color: 'white' });
                }
            });
        });
    });

    function mostrarDetalle(id) {
        Swal.fire({ title: 'Cargando...', allowOutsideClick: false, didOpen: () => Swal.showLoading(), background: '#1a1f2e', color:'white' });
        
        $.ajax({
            url: 'directorio_global_lider_movil_ajax.php',
            type: 'POST',
            data: { op: 'obtener_detalle', id: id },
            dataType: 'json',
            success: function(resp) {
                Swal.close();
                if(resp.success) {
                    const d = resp.data;
                    document.getElementById('vd_nombre').textContent = d.nombres_apellidos_tercero || 'No Registrado';
                    document.getElementById('vd_rol').textContent = d.nombre_seguridad || 'Sin Asignar';
                    document.getElementById('vd_cedula').textContent = (d.nombre_tipo_identificacion ? d.nombre_tipo_identificacion + ' ' : '') + (d.cedula || 'N/A');
                    document.getElementById('vd_sexo').textContent = d.nombre_sexo || 'No Registrado';
                    document.getElementById('vd_fecha_nac').textContent = d.fecha_nac_tercero && d.fecha_nac_tercero !== '0000-00-00' ? d.fecha_nac_tercero : 'No Registrada';
                    document.getElementById('vd_correo').textContent = d.correo_tercero || 'N/A';
                    
                    let tel = d.telefono1_tercero || '';
                    if (d.telefono2_tercero) { tel += (tel ? ' / ' : '') + d.telefono2_tercero; }
                    document.getElementById('vd_telefono').textContent = tel || 'N/A';
                    
                    document.getElementById('vd_direccion').textContent = d.direccion_tercero || 'No Registrada';
                    document.getElementById('vd_barrio').textContent = d.barrio_tercero ? 'Barrio: ' + d.barrio_tercero : '';
                    
                    let loc = d.ciudad || '';
                    if (d.departamento) { loc += (loc ? ', ' : '') + d.departamento; }
                    document.getElementById('vd_dep_ciudad').textContent = loc ? loc : '';
                    
                    let redesInfo = '';
                    if(d.url_redsocial_facebook) redesInfo += `<div class="mb-1"><i class="fa-brands fa-facebook"></i> ${d.url_redsocial_facebook}</div>`;
                    if(d.url_redsocial_twitter) redesInfo += `<div class="mb-1"><i class="fa-brands fa-twitter"></i> ${d.url_redsocial_twitter}</div>`;
                    if(d.url_redsocial_linkedin) redesInfo += `<div class="mb-1"><i class="fa-brands fa-linkedin"></i> ${d.url_redsocial_linkedin}</div>`;
                    if(d.url_redsocial_skype) redesInfo += `<div class="mb-1"><i class="fa-brands fa-skype"></i> ${d.url_redsocial_skype}</div>`;
                    document.getElementById('vd_redes').innerHTML = redesInfo || 'Ninguna registrada';
                    
                    document.getElementById('vd_cuenta').textContent = d.cuenta || 'Sin Asignar';
                    document.getElementById('vd_superior').textContent = d.superior || 'Sin Asignar';
                    document.getElementById('vd_fecha').textContent = d.fecha_creacion || '--';

                    
                    // Estado Detalle
                    let badgeDetalle = '';
                    if(d.cod_estado_activacion_usuario == '1') badgeDetalle = '<span class="status-badge status-activo">Activo</span>';
                    else if(d.cod_estado_activacion_usuario == '3') badgeDetalle = '<span class="status-badge status-inactivo">Inactivo</span>';
                    else if(d.cod_estado_activacion_usuario == '2') badgeDetalle = '<span class="status-badge bg-warning text-dark">Pend/Revisión</span>';
                    else badgeDetalle = '<span class="status-badge bg-secondary text-white">Estado ' + d.cod_estado_activacion_usuario + '</span>';

                    document.getElementById('vd_estado').innerHTML = badgeDetalle;
                    
                    myModalVer.show();
                } else {
                    Swal.fire('Error', resp.mensaje, 'error');
                }
            },
            error: function() {
                Swal.close();
                Swal.fire('Error', 'Fallo al recuperar info del usuario', 'error');
            }
        });
    }

    function mostrarEditar(id) {
        Swal.fire({ title: 'Cargando...', allowOutsideClick: false, didOpen: () => Swal.showLoading(), background: '#1a1f2e', color:'white' });
        
        $.ajax({
            url: 'directorio_global_lider_movil_ajax.php',
            type: 'POST',
            data: { op: 'obtener_detalle', id: id },
            dataType: 'json',
            success: function(resp) {
                Swal.close();
                if(resp.success) {
                    const d = resp.data;
                    document.getElementById('ed_cod_administrador').value = d.cod_administrador;
                    document.getElementById('ed_nombre').value = d.nombres_apellidos_tercero || '';
                    document.getElementById('ed_nombres').value = d.nombres || '';
                    document.getElementById('ed_apellidos').value = d.apellidos || '';
                    document.getElementById('ed_tipo_identificacion').value = d.nombre_tipo_identificacion || 'C.C';
                    document.getElementById('ed_cedula').value = d.cedula || '';
                    document.getElementById('ed_nombre_sexo').value = d.nombre_sexo || '';
                    document.getElementById('ed_fecha_nac').value = d.fecha_nac_tercero && d.fecha_nac_tercero !== '0000-00-00' ? d.fecha_nac_tercero : '';
                    document.getElementById('ed_telefono').value = d.telefono1_tercero || '';
                    document.getElementById('ed_telefono2').value = d.telefono2_tercero || '';
                    document.getElementById('ed_cuenta').value = d.cuenta || '';
                    document.getElementById('ed_correo').value = d.correo_tercero || '';
                    document.getElementById('ed_direccion').value = d.direccion_tercero || '';
                    document.getElementById('ed_barrio').value = d.barrio_tercero || '';
                    document.getElementById('ed_departamento').value = d.departamento || '';
                    document.getElementById('ed_ciudad').value = d.ciudad || '';
                    
                    document.getElementById('ed_facebook').value = d.url_redsocial_facebook || '';
                    document.getElementById('ed_twitter').value = d.url_redsocial_twitter || '';
                    document.getElementById('ed_linkedin').value = d.url_redsocial_linkedin || '';
                    document.getElementById('ed_skype').value = d.url_redsocial_skype || '';
                    document.getElementById('ed_contrasena').value = ''; // Limpiar el campo siempre
                    
                    document.getElementById('ed_rol').value = d.cod_seguridad;
                    document.getElementById('ed_estado').value = d.cod_estado_activacion_usuario;
                    
                    myModalEditar.show();
                } else {
                    Swal.fire('Error', resp.mensaje, 'error');
                }
            },
            error: function() {
                Swal.close();
                Swal.fire('Error', 'Fallo al recuperar info del usuario', 'error');
           }
        });
    }
</script>
</body>
</html>
