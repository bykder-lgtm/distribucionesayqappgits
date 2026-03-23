<?php 
$nombre_pagina          = "Mis Vendedores";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_coordinador.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_coordinador.php"); ?>

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
<script src="../js/sha1.js"></script>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<script src="../js/sweetalert2.min_adm_tick.js"></script>

<style>
/* ============================================ */
/* LISTA VENDEDORES COORDINADOR - TEMA ÍNDIGO   */
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
}

/* Header */
.page-header {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(99, 102, 241, 0.3);
}

.page-header h1 {
    color: white;
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.page-header p {
    color: rgba(255,255,255,0.8);
    font-size: 0.9rem;
}

.header-stats {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.header-stat {
    background: rgba(255,255,255,0.1);
    padding: 0.5rem 1rem;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.header-stat-value {
    font-size: 1.25rem;
    font-weight: 800;
    color: white;
}

.header-stat-label {
    font-size: 0.7rem;
    color: rgba(255,255,255,0.6);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Search Bar */
.search-bar {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(99, 102, 241, 0.2);
    border-radius: 15px;
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.search-bar i {
    color: #6366f1;
}

.search-bar input {
    background: transparent;
    border: none;
    outline: none;
    color: white;
    width: 100%;
}

.search-bar select {
    background: #1a1f2e;
    border: 1px solid rgba(99, 102, 241, 0.2);
    color: white;
    padding: 0.25rem;
    border-radius: 8px;
    font-size: 0.8rem;
    outline: none;
}

/* Add Button */
.add-button {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: white;
    border: none;
    padding: 0.9rem;
    border-radius: 15px;
    font-size: 0.95rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    margin-bottom: 1.5rem;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
}

/* Grid Vendedores */
.vendor-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.vendor-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(99, 102, 241, 0.2);
    border-radius: 20px;
    padding: 1.25rem;
    transition: all 0.3s ease;
}

.vendor-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.vendor-info {
    flex: 1;
}

.vendor-name {
    color: white;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.vendor-id-text {
    color: rgba(255,255,255,0.4);
    font-size: 0.8rem;
}

.vendor-status {
    font-size: 0.65rem;
    font-weight: 700;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    text-transform: uppercase;
}

.vendor-status.active { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
.vendor-status.inactive { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); }

.vendor-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}

.vendor-detail {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255,255,255,0.6);
    font-size: 0.8rem;
}

.vendor-detail i { color: #6366f1; width: 14px; }

.vendor-actions {
    display: flex;
    gap: 0.75rem;
}

.action-btn {
    flex: 1;
    padding: 0.75rem;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.action-btn.primary { background: rgba(99, 102, 241, 0.1); color: #6366f1; border: 1px solid rgba(99, 102, 241, 0.2); }
.action-btn.secondary { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.8); border: 1px solid rgba(255,255,255,0.1); }

/* Modales */
.modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.8);
    backdrop-filter: blur(5px);
    display: none;
    align-items: flex-end;
    z-index: 2000;
}

.modal-overlay.show { display: flex; }

.modal-content {
    background: #11151c;
    width: 100%;
    border-radius: 30px 30px 0 0;
    padding: 1.5rem;
    max-height: 90vh;
    overflow-y: auto;
    border-top: 2px solid rgba(99, 102, 241, 0.3);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.modal-header h2 { color: white; font-size: 1.25rem; }
.modal-close { background: none; border: none; color: white; font-size: 1.2rem; }

.form-group { margin-bottom: 1rem; }
.form-label { display: block; color: rgba(255,255,255,0.6); font-size: 0.75rem; margin-bottom: 0.5rem; font-weight: 600; text-transform: uppercase; }
.form-input, .form-select {
    width: 100%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(99, 102, 241, 0.2);
    border-radius: 12px;
    padding: 0.75rem;
    color: white;
    outline: none;
}

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.submit-btn { width: 100%; padding: 1rem; border-radius: 15px; border: none; font-weight: 700; cursor: pointer; margin-top: 1rem; }
.submit-btn.primary { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white; }

/* Empty State */
.empty-state { text-align: center; padding: 3rem 1rem; color: rgba(255,255,255,0.4); }
.empty-state i { font-size: 4rem; margin-bottom: 1rem; }

/* Animations */
.animate-in { animation: slideUp 0.5s ease forwards; opacity: 0; transform: translateY(20px); }
@keyframes slideUp { to { opacity: 1; transform: translateY(0); } }
.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }
</style>
</head>
<body>

<?php
// Obtener parámetros de búsqueda
$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conectar, $_GET['busqueda']) : '';
$filtro_estado = isset($_GET['filtro_estado']) ? mysqli_real_escape_string($conectar, $_GET['filtro_estado']) : '';

// Consulta de vendedores asignados a los aliados de este coordinador
$sql = "SELECT v.cod_administrador, v.cedula, v.nombres, v.apellidos, v.cuenta, v.correo, v.telefono,
v.nombres_apellidos_tercero, v.cod_estado_activacion_usuario, v.identificacion_tercero, v.nombre1_tercero, v.apellido1_tercero, v.telefono1_tercero, v.correo_tercero,
v.direccion_tercero, v.cod_vendedor, v.cod_aliado_estrategico, v.fecha, v.fecha_hora, v.codigo_tipo_vendedor, t.nombre_tienda, t.cod_tienda,
a.nombres_apellidos_tercero AS nombre_aliado 
FROM tbl15_administrador v 
INNER JOIN tbl15_tienda t ON v.cod_vendedor = t.cod_tienda 
LEFT JOIN tbl15_administrador a ON v.cod_aliado_estrategico = a.cod_administrador
WHERE v.cod_seguridad = '2' AND v.cod_estado != '0' 
AND v.cod_aliado_estrategico IN (SELECT cod_administrador FROM tbl15_administrador WHERE cod_coordinador = '$cod_administrador' AND cod_seguridad = '23' AND cod_estado != '0') ";

if (!empty($busqueda)) { $sql .= " AND (v.nombres_apellidos_tercero LIKE '%$busqueda%' OR v.identificacion_tercero LIKE '%$busqueda%' OR v.cedula LIKE '%$busqueda%')"; }
if ($filtro_estado !== '') { $sql .= " AND v.cod_estado_activacion_usuario = '$filtro_estado'"; }

$sql .= " ORDER BY v.cod_administrador DESC";
$resultado = mysqli_query($conectar, $sql);

$total_vendedores = 0;
$vendedores_activos = 0;
$vendedores_array = array();

if ($resultado) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $vendedores_array[] = $row;
        $total_vendedores++;
        if ($row['cod_estado_activacion_usuario'] == '1') { $vendedores_activos++; }
    }
}

// Aliados para el registro
$sql_aliados = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_coordinador = '$cod_administrador' AND cod_seguridad = '23' AND cod_estado != '0' ORDER BY nombres_apellidos_tercero ASC";
$res_aliados = mysqli_query($conectar, $sql_aliados);

// Tipos de vendedor
$sql_tipo_vendedor = "SELECT codigo_tipo_vendedor, nombre_tipo_vendedor FROM tbl15_tipo_vendedor WHERE cod_estado = '1' ORDER BY codigo_tipo_vendedor ASC";
$res_tipo_vendedor = mysqli_query($conectar, $sql_tipo_vendedor);
?>

<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<main class="page-container">
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-user-tie"></i> Mis Vendedores</h1>
        <p>Gestiona el equipo comercial de tus aliados</p>
        <div class="header-stats">
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $total_vendedores; ?></div>
                <div class="header-stat-label">Total</div>
            </div>
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $vendedores_activos; ?></div>
                <div class="header-stat-label">Activos</div>
            </div>
        </div>
    </div>

    <div class="search-bar animate-in delay-1">
        <i class="fa-solid fa-search"></i>
        <input type="text" id="searchInput" placeholder="Buscar por nombre o ID..." value="<?php echo htmlspecialchars($busqueda); ?>" onkeyup="filtrar()">
        <select id="filtroEstado" onchange="filtrar()">
            <option value="">Todos</option>
            <option value="1" <?php echo ($filtro_estado == '1') ? 'selected' : ''; ?>>Activos</option>
            <option value="0" <?php echo ($filtro_estado == '0') ? 'selected' : ''; ?>>Inactivos</option>
        </select>
    </div>

    <button class="add-button animate-in delay-1" onclick="abrirModalRegistro()">
        <i class="fa-solid fa-plus"></i> Registrar Vendedor
    </button>

    <div class="vendor-list">
        <?php if ($total_vendedores > 0): ?>
            <?php foreach ($vendedores_array as $v): ?>
                <div class="vendor-card animate-in delay-2">
                    <div class="vendor-card-header">
                        <div class="vendor-info">
                            <div class="vendor-name"><?php echo ucwords(strtolower($v['nombres_apellidos_tercero'])); ?></div>
                            <div class="vendor-id-text">ID: <?php echo $v['identificacion_tercero']; ?></div>
                        </div>
                        <span class="vendor-status <?php echo ($v['cod_estado_activacion_usuario'] == '1') ? 'active' : 'inactive'; ?>">
                            <?php echo ($v['cod_estado_activacion_usuario'] == '1') ? 'Activo' : 'Inactivo'; ?>
                        </span>
                    </div>
                    
                    <div class="vendor-details">
                        <div class="vendor-detail"><i class="fa-solid fa-store"></i> <span><?php echo ucwords(strtolower($v['nombre_tienda'])); ?></span></div>
                        <div class="vendor-detail"><i class="fa-solid fa-handshake"></i> <span><?php echo ucwords(strtolower($v['nombre_aliado'])); ?></span></div>
                        <div class="vendor-detail"><i class="fa-solid fa-phone"></i> <span><?php echo $v['telefono1_tercero']; ?></span></div>
                        <div class="vendor-detail"><i class="fa-solid fa-envelope"></i> <span><?php echo strtolower($v['correo_tercero']); ?></span></div>
                    </div>

                    <div class="vendor-actions">
                        <button class="action-btn primary" onclick='editarVendedor(<?php echo json_encode($v); ?>)'>
                            <i class="fa-solid fa-edit"></i> Editar
                        </button>
                        <button class="action-btn secondary" onclick='verDetalle(<?php echo json_encode($v); ?>)'>
                            <i class="fa-solid fa-eye"></i> Ver
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-solid fa-user-slash"></i>
                <p>No se encontraron vendedores</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Modal Registro/Edición -->
<div class="modal-overlay" id="modalVendedor">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Nuevo Vendedor</h2>
            <button class="modal-close" onclick="cerrarModal()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="formVendedor">
                <input type="hidden" name="cod_administrador" id="cod_administrador_edit">
                
                <div class="form-group">
                    <label class="form-label">Aliado Estratégico *</label>
                    <select class="form-select" name="cod_aliado_estrategico" id="modal_cod_aliado" required onchange="cargarTiendas(this.value)">
                        <option value="">Seleccione un aliado...</option>
                        <?php mysqli_data_seek($res_aliados, 0); while($aliado = mysqli_fetch_assoc($res_aliados)): ?>
                            <option value="<?php echo $aliado['cod_administrador']; ?>"><?php echo $aliado['nombres_apellidos_tercero']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tienda Asignada *</label>
                    <select class="form-select" name="cod_tienda" id="modal_cod_tienda" required>
                        <option value="">Primero seleccione aliado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo Vendedor *</label>
                    <select class="form-select" name="codigo_tipo_vendedor" id="modal_codigo_tipo_vendedor" required>
                        <option value="">Seleccionar...</option>
                        <?php 
                        mysqli_data_seek($res_tipo_vendedor, 0);
                        while ($tv = mysqli_fetch_assoc($res_tipo_vendedor)): 
                        ?>
                        <option value="<?php echo $tv['codigo_tipo_vendedor']; ?>"><?php echo $tv['nombre_tipo_vendedor']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Identificación *</label>
                        <input type="number" class="form-input" name="identificacion_tercero" id="modal_identificacion" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" name="telefono1_tercero" id="modal_telefono" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombres *</label>
                        <input type="text" class="form-input" name="nombre1_tercero" id="modal_nombres" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellidos *</label>
                        <input type="text" class="form-input" name="apellido1_tercero" id="modal_apellidos" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" class="form-input" name="correo_tercero" id="modal_correo" required>
                </div>

                <div class="form-group" id="group_estado" style="display:none;">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="cod_estado_activacion_usuario" id="modal_estado">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn primary" id="btnSubmit">Registrar Vendedor</button>
            </form>
        </div>
    </div>
</div>

<?php include_once("../menu/05_modulo_menu_coordinador_movil.php"); ?>

<script>
function filtrar() {
    var val = document.getElementById('searchInput').value;
    var est = document.getElementById('filtroEstado').value;
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(function() {
        window.location.href = 'lista_vendedor_coordinador_movil.php?busqueda=' + encodeURIComponent(val) + '&filtro_estado=' + est;
    }, 500);
}

function abrirModalRegistro() {
    document.getElementById('modalTitle').textContent = 'Nuevo Vendedor';
    document.getElementById('btnSubmit').textContent = 'Registrar Vendedor';
    document.getElementById('formVendedor').reset();
    document.getElementById('cod_administrador_edit').value = '';
    document.getElementById('modal_codigo_tipo_vendedor').value = '0';
    document.getElementById('group_estado').style.display = 'none';
    document.getElementById('modalVendedor').classList.add('show');
}

function editarVendedor(data) {
    document.getElementById('modalTitle').textContent = 'Editar Vendedor';
    document.getElementById('btnSubmit').textContent = 'Actualizar Datos';
    document.getElementById('cod_administrador_edit').value = data.cod_administrador;
    document.getElementById('modal_cod_aliado').value = data.cod_aliado_estrategico;
    
    // Cargar tiendas y luego seleccionar
    cargarTiendas(data.cod_aliado_estrategico, data.cod_tienda);
    
    document.getElementById('modal_identificacion').value = data.identificacion_tercero;
    document.getElementById('modal_telefono').value = data.telefono1_tercero;
    document.getElementById('modal_nombres').value = data.nombre1_tercero;
    document.getElementById('modal_apellidos').value = data.apellido1_tercero;
    document.getElementById('modal_correo').value = data.correo_tercero;
    document.getElementById('modal_estado').value = data.cod_estado_activacion_usuario;
    document.getElementById('modal_codigo_tipo_vendedor').value = data.codigo_tipo_vendedor || 0;
    document.getElementById('group_estado').style.display = 'block';
    
    document.getElementById('modalVendedor').classList.add('show');
}

function cargarTiendas(codAliado, selected = '') {
    if (!codAliado) return;
    $.ajax({
        url: '../admin/obtener_tiendas_por_aliado_ajax.php',
        type: 'POST',
        data: { cod_aliado_estrategico: codAliado },
        dataType: 'json',
        success: function(resp) {
            var html = '<option value="">Seleccione tienda...</option>';
            if (resp.success && resp.tiendas) {
                resp.tiendas.forEach(t => {
                    html += `<option value="${t.cod_tienda}" ${t.cod_tienda == selected ? 'selected' : ''}>${t.nombre_tienda || t.nombre1_tercero}</option>`;
                });
            }
            $('#modal_cod_tienda').html(html);
        }
    });
}

function cerrarModal() { document.getElementById('modalVendedor').classList.remove('show'); }

$('#formVendedor').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var isEdit = document.getElementById('cod_administrador_edit').value !== '';
    var url = isEdit ? '../admin/act_vendedor_modal_asesor_ajax_reg.php' : '../admin/reg_vendedor_modal_asesor_ajax_reg.php';
    
    Swal.fire({ title: 'Procesando...', didOpen: () => { Swal.showLoading() }, background: '#1a1f2e', color: 'white' });
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(resp) {
            if (resp.success) {
                Swal.fire({ icon: 'success', title: '¡Éxito!', text: resp.message, background: '#1a1f2e', color: 'white' }).then(() => { location.reload(); });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: resp.message, background: '#1a1f2e', color: 'white' });
            }
        }
    });
});

function verDetalle(v) {
    Swal.fire({
        title: ucwords(v.nombres_apellidos_tercero),
        html: `
            <div style="text-align: left; padding: 10px;">
                <p><strong>Tienda:</strong> ${ucwords(v.nombre_tienda)}</p>
                <p><strong>Aliado:</strong> ${ucwords(v.nombre_aliado)}</p>
                <p><strong>ID:</strong> ${v.identificacion_tercero}</p>
                <p><strong>Teléfono:</strong> ${v.telefono1_tercero}</p>
                <p><strong>Correo:</strong> ${v.correo_tercero}</p>
                <p><strong>Usuario:</strong> ${v.cuenta}</p>
                <p><strong>Estado:</strong> ${v.cod_estado_activacion_usuario == '1' ? 'Activo' : 'Inactivo'}</p>
            </div>
        `,
        confirmButtonText: 'Cerrar',
        confirmButtonColor: '#6366f1',
        background: '#1a1f2e',
        color: 'white'
    });
}

function ucwords(str) {
    if (!str) return '';
    return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
        return letter.toUpperCase();
    });
}

// Cerrar modal al click fuera
$('#modalVendedor').on('click', function(e) { if (e.target === this) cerrarModal(); });
</script>

</body>
</html>
