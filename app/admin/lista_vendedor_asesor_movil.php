<?php 
$nombre_pagina          = "Mis Vendedores";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_asesor.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
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
<script src="../js/sha1.js"></script>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<!-- CSS Separado del módulo vendedor -->
<link rel="stylesheet" href="css/lista_vendedor_asesor.css">
</head>
<body>

<?php
// Obtener parámetros de búsqueda
$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conectar, $_GET['busqueda']) : '';
$filtro_estado = isset($_GET['filtro_estado']) ? mysqli_real_escape_string($conectar, $_GET['filtro_estado']) : '';

// Consulta de vendedores asignados a los aliados de este asesor
// Vendedores: cod_seguridad = '2', vinculados a aliados del asesor via cod_aliado_estrategico
$sql = "SELECT v.cod_administrador, v.cedula, v.nombres, v.apellidos, v.cuenta, v.correo, v.telefono,
v.nombres_apellidos_tercero, v.cod_estado_activacion_usuario, v.identificacion_tercero, v.nombre1_tercero, v.apellido1_tercero, v.telefono1_tercero, v.correo_tercero,
v.direccion_tercero, v.cod_vendedor, v.cod_aliado_estrategico, v.fecha, v.fecha_hora, v.codigo_tipo_vendedor, t.nombre_tienda, t.cod_tienda,
a.nombres_apellidos_tercero AS nombre_aliado FROM tbl15_administrador v INNER JOIN tbl15_tienda t ON v.cod_vendedor = t.cod_tienda LEFT JOIN tbl15_administrador a ON v.cod_aliado_estrategico = a.cod_administrador
WHERE v.cod_seguridad = '2' AND v.cod_estado != '0' AND v.cod_estado_activacion_usuario != '3' AND t.cod_estado != '0' AND v.cod_aliado_estrategico IN (SELECT cod_administrador FROM tbl15_administrador WHERE cod_asesor = '$cod_administrador' AND cod_seguridad = '23') ";
// Filtro de búsqueda
if (!empty($busqueda)) { $sql .= " AND (v.nombres_apellidos_tercero LIKE '%$busqueda%' OR v.identificacion_tercero LIKE '%$busqueda%' OR v.cedula LIKE '%$busqueda%' OR v.telefono1_tercero LIKE '%$busqueda%' OR v.correo_tercero LIKE '%$busqueda%')"; }
// Filtro de estado
if (!empty($filtro_estado)) { $sql .= " AND v.cod_estado_activacion_usuario = '$filtro_estado'"; }

$sql .= " ORDER BY v.cod_administrador DESC";
$resultado = mysqli_query($conectar, $sql);

// Contadores para estadísticas
$total_vendedores = 0;
$vendedores_activos = 0;
$vendedores_inactivos = 0;
$vendedores_array = array();

if ($resultado) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $vendedores_array[] = $row;
        $total_vendedores++;
        if ($row['cod_estado_activacion_usuario'] == '1') { $vendedores_activos++; } else { $vendedores_inactivos++; }
    }
}

// Obtener lista de aliados para el select de registro
$sql_aliados = "SELECT cod_administrador, nombres_apellidos_tercero, cedula FROM tbl15_administrador 
WHERE cod_asesor = '$cod_administrador' AND cod_seguridad = '23' AND cod_estado_activacion_usuario = '1' AND cod_estado != '0' ORDER BY nombres_apellidos_tercero ASC";
$res_aliados = mysqli_query($conectar, $sql_aliados);
?>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-user-tie"></i> Mis Vendedores</h1>
        <p>Gestiona los vendedores de tus aliados estratégicos</p>
        <div class="header-stats">
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $total_vendedores; ?></div>
                <div class="header-stat-label">Total</div>
            </div>
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $vendedores_activos; ?></div>
                <div class="header-stat-label">Activos</div>
            </div>
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $vendedores_inactivos; ?></div>
                <div class="header-stat-label">Inactivos</div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="search-bar animate-in delay-1">
        <i class="fa-solid fa-search"></i>
        <input type="text" id="searchInput" placeholder="Buscar vendedor..." 
               value="<?php echo htmlspecialchars($busqueda); ?>" onkeyup="filtrar()">
        <select id="filtroEstado" onchange="filtrar()">
            <option value="">Todos</option>
            <option value="1" <?php echo ($filtro_estado == '1') ? 'selected' : ''; ?>>Activos</option>
            <option value="0" <?php echo ($filtro_estado == '0') ? 'selected' : ''; ?>>Inactivos</option>
        </select>
    </div>

    <!-- Add Button -->
    <button class="add-button animate-in delay-1" onclick="abrirModal()">
        <i class="fa-solid fa-user-plus"></i> Nuevo Vendedor
    </button>

    <!-- Vendor List -->
    <div class="vendor-list" id="vendorList">
    <?php if ($total_vendedores > 0): ?>
        <?php foreach ($vendedores_array as $vendedor): ?>
            <?php
            $nombre_completo = !empty($vendedor['nombres_apellidos_tercero']) 
                ? ucwords(strtolower($vendedor['nombres_apellidos_tercero']))
                : ucwords(strtolower(trim($vendedor['nombres'] . ' ' . $vendedor['apellidos'])));
            
            // Estado
            $estado = $vendedor['cod_estado_activacion_usuario'];
            $estado_class = ($estado == '1') ? 'active' : 'inactive';
            $estado_texto = ($estado == '1') ? 'Activo' : 'Inactivo';
            
            // Tienda
            $nombre_tienda = !empty($vendedor['nombre_tienda']) ? ucwords(strtolower($vendedor['nombre_tienda'])) : 'Sin tienda';
            
            // Aliado
            $nombre_aliado = !empty($vendedor['nombre_aliado']) ? ucwords(strtolower($vendedor['nombre_aliado'])) : 'N/A';
            
            // Fecha
            $fecha_creacion = '';
            if (!empty($vendedor['fecha'])) {
                $fecha_creacion = date('d/m/Y', strtotime($vendedor['fecha']));
            }
            
            // Datos para JSON (para los modales)
            $vendedor_safe = $vendedor;
            $vendedor_safe['nombre_tienda_display'] = $nombre_tienda;
            $vendedor_safe['nombre_aliado_display'] = $nombre_aliado;
            $data_json = htmlspecialchars(json_encode($vendedor_safe), ENT_QUOTES, 'UTF-8');
            ?>
            <div class="vendor-card animate-in delay-2">
                <div class="vendor-card-header">
                    <div class="vendor-info">
                        <div class="vendor-name"><?php echo htmlspecialchars($nombre_completo); ?></div>
                        <div class="vendor-id-text">CC: <?php echo htmlspecialchars($vendedor['cedula'] ?: $vendedor['identificacion_tercero']); ?></div>
                    </div>
                    <span class="vendor-status <?php echo $estado_class; ?>"><?php echo $estado_texto; ?></span>
                </div>
                
                <div class="vendor-details">
                    <div class="vendor-detail">
                        <i class="fa-solid fa-phone"></i>
                        <span><?php echo htmlspecialchars($vendedor['telefono'] ?: $vendedor['telefono1_tercero'] ?: 'N/A'); ?></span>
                    </div>
                    <div class="vendor-detail">
                        <i class="fa-solid fa-envelope"></i>
                        <span><?php echo htmlspecialchars(strtolower($vendedor['correo'] ?: $vendedor['correo_tercero'] ?: 'N/A')); ?></span>
                    </div>
                    <div class="vendor-detail">
                        <i class="fa-solid fa-store"></i>
                        <span>Tienda: <?php echo htmlspecialchars($nombre_tienda); ?></span>
                    </div>
                    <div class="vendor-detail">
                        <i class="fa-solid fa-handshake"></i>
                        <span>Aliado: <?php echo htmlspecialchars($nombre_aliado); ?></span>
                    </div>
                    <?php if ($fecha_creacion): ?>
                    <div class="vendor-detail">
                        <i class="fa-solid fa-calendar-plus" style="color: #f59e0b;"></i>
                        <span>Registrado: <?php echo $fecha_creacion; ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($vendedor['direccion_tercero'])): ?>
                    <div class="vendor-detail">
                        <i class="fa-solid fa-location-dot"></i>
                        <span><?php echo htmlspecialchars($vendedor['direccion_tercero']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="vendor-actions">
                    <button class="action-btn primary" onclick='abrirModalEditar(<?php echo $data_json; ?>)'>
                        <i class="fa-solid fa-edit"></i> Editar
                    </button>
                    <button class="action-btn secondary" onclick='abrirModalDetalle(<?php echo $data_json; ?>)'>
                        <i class="fa-solid fa-eye"></i> Detalle
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-state">
            <i class="fa-solid fa-user-tie"></i>
            <h3>No hay vendedores registrados</h3>
            <p>Presiona el botón para registrar un nuevo vendedor</p>
        </div>
    <?php endif; ?>
    </div>
</main>

<!-- ======================== MODAL REGISTRO VENDEDOR ======================== -->
<div class="modal-overlay" id="modalRegistro">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-user-plus"></i> Nuevo Vendedor</h2>
            <button class="modal-close" onclick="cerrarModal()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="formRegistro" enctype="multipart/form-data">
                
                <div class="form-section-title">
                    <i class="fa-solid fa-handshake"></i> Asociación
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Aliado Estratégico *</label>
                        <select class="form-select" id="reg_cod_aliado" name="cod_aliado_estrategico" required onchange="cargarTiendasPorAliado(this.value)">
                            <option value="">Seleccione un aliado...</option>
                            <?php 
                            if ($res_aliados && mysqli_num_rows($res_aliados) > 0) {
                                mysqli_data_seek($res_aliados, 0);
                                while ($aliado = mysqli_fetch_assoc($res_aliados)): 
                            ?>
                            <option value="<?php echo $aliado['cod_administrador']; ?>">
                                <?php echo htmlspecialchars($aliado['nombres_apellidos_tercero'] . ' - CC: ' . $aliado['cedula']); ?>
                            </option>
                            <?php endwhile; } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Tienda *</label>
                        <select class="form-select" id="reg_cod_tienda" name="cod_tienda" required>
                            <option value="">Primero seleccione un aliado</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo de Contrato / Vendedor *</label>
                        <select class="form-select" id="reg_codigo_tipo_vendedor" name="codigo_tipo_vendedor" required>
                            <option value="0">NORMAL (Planta)</option>
                            <option value="1">FREELANCER</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-section-title">
                    <i class="fa-solid fa-user"></i> Datos Personales
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Identificación (CC) *</label>
                        <input type="text" class="form-input" id="reg_identificacion" name="identificacion_tercero" 
                               placeholder="Ej: 1234567890" required>
                        <div class="validation-message" id="mensaje_identificacion"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-input" id="reg_direccion" name="direccion_tercero" 
                               placeholder="Ej: Cra 10 #20-30">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombres *</label>
                        <input type="text" class="form-input" id="reg_nombres" name="nombre1_tercero" 
                               placeholder="Ej: Juan Carlos" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellidos *</label>
                        <input type="text" class="form-input" id="reg_apellidos" name="apellido1_tercero" 
                               placeholder="Ej: Pérez López" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" id="reg_telefono" name="telefono1_tercero" 
                               placeholder="Ej: 3001234567" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo *</label>
                        <input type="email" class="form-input" id="reg_correo" name="correo_tercero" 
                               placeholder="Ej: correo@email.com" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Dirección</label>
                    <input type="text" class="form-input" id="reg_direccion" name="direccion_tercero" 
                           placeholder="Ej: Cra 10 #20-30">
                </div>
                
                <button type="submit" id="btnGuardar" class="submit-btn">
                    <i class="fa-solid fa-save"></i> Registrar Vendedor
                </button>
                <button type="button" onclick="cerrarModal()" class="submit-btn secondary-btn">
                    <i class="fa-solid fa-times"></i> Cancelar
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ======================== MODAL EDITAR VENDEDOR ======================== -->
<div class="modal-overlay" id="modalEditar">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-pen-to-square"></i> Editar Vendedor</h2>
            <button class="modal-close" onclick="cerrarModalEditar()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="formEditar" enctype="multipart/form-data">
                <input type="hidden" id="edit_cod_administrador" name="cod_administrador">
                
                <div class="form-section-title">
                    <i class="fa-solid fa-user"></i> Datos Personales
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Identificación (CC) *</label>
                        <input type="text" class="form-input" id="edit_identificacion" name="identificacion_tercero" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-input" id="edit_direccion" name="direccion_tercero">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombres *</label>
                        <input type="text" class="form-input" id="edit_nombres" name="nombre1_tercero" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellidos *</label>
                        <input type="text" class="form-input" id="edit_apellidos" name="apellido1_tercero" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" id="edit_telefono" name="telefono1_tercero" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo *</label>
                        <input type="email" class="form-input" id="edit_correo" name="correo_tercero" required>
                    </div>
                </div>
                

                
                <div class="form-section-title blue">
                    <i class="fa-solid fa-link"></i> Asociación
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Aliado</label>
                        <input type="text" class="form-input" id="edit_aliado_nombre" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tienda</label>
                        <input type="text" class="form-input" id="edit_tienda_nombre" readonly>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo de Contrato / Vendedor *</label>
                        <select class="form-select" id="edit_codigo_tipo_vendedor" name="codigo_tipo_vendedor" required>
                            <option value="0">NORMAL (Planta)</option>
                            <option value="1">FREELANCER</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-section-title">
                    <i class="fa-solid fa-shield-halved"></i> Estado y Acceso
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Estado *</label>
                        <select class="form-select" id="edit_estado" name="cod_estado_activacion_usuario" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-input" id="edit_usuario" readonly>
                    </div>
                </div>
                
                <!-- Botón recuperar contraseña -->
                <div class="form-group">
                    <button type="button" onclick="enviarRecuperacionPassword()" 
                            style="width: 100%; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 0.85rem; border-radius: 12px; font-size: 0.9rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                        <i class="fa-solid fa-key"></i> Enviar Nueva Contraseña por Correo
                    </button>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-save"></i> Actualizar Vendedor
                </button>
                <button type="button" onclick="cerrarModalEditar()" class="submit-btn secondary-btn">
                    <i class="fa-solid fa-times"></i> Cancelar
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ======================== MODAL DETALLE VENDEDOR ======================== -->
<div class="modal-overlay" id="modalDetalle">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-eye"></i> Detalle del Vendedor</h2>
            <button class="modal-close" onclick="cerrarModalDetalle()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div class="detail-avatar" id="detAvatar"></div>
                <h3 style="color: white; margin-bottom: 4px;" id="detNombre"></h3>
                <span class="vendor-status" id="detEstado"></span>
            </div>
            
            <div class="detail-info-card">
                <div class="detail-row">
                    <span class="detail-label"><i class="fa-solid fa-id-card"></i> Cédula</span>
                    <span class="detail-value" id="detCedula"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fa-solid fa-phone"></i> Teléfono</span>
                    <span class="detail-value" id="detTelefono"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fa-solid fa-envelope"></i> Correo</span>
                    <span class="detail-value" id="detCorreo"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fa-solid fa-location-dot"></i> Dirección</span>
                    <span class="detail-value" id="detDireccion"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fa-solid fa-store"></i> Tienda</span>
                    <span class="detail-value" id="detTienda"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fa-solid fa-handshake"></i> Aliado</span>
                    <span class="detail-value" id="detAliado"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fa-solid fa-user-circle"></i> Usuario</span>
                    <span class="detail-value" id="detUsuario"></span>
                </div>
            </div>
            
            <button onclick="cerrarModalDetalle()" class="submit-btn secondary-btn" style="margin-top: 0;">
                <i class="fa-solid fa-times"></i> Cerrar
            </button>
        </div>
    </div>
</div>

<!-- ======================== MODAL CONFIRMACIÓN REGISTRO ======================== -->
<div class="confirm-modal-overlay" id="modalConfirmacion">
    <div class="confirm-modal-box">
        <div class="confirm-success-header">
            <div class="confirm-success-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h3>¡Vendedor Registrado!</h3>
            <p>Se ha creado exitosamente</p>
            <span class="confirm-vendor-name" id="confirm_nombre_display"></span>
        </div>
        
        <div class="confirm-body">
            <div class="confirm-credentials">
                <h4><i class="fa-solid fa-key"></i> Credenciales de Acceso</h4>
                <div class="confirm-credential-row">
                    <span class="confirm-credential-label">Usuario:</span>
                    <span class="confirm-credential-value" id="confirm_usuario"></span>
                </div>
                <div class="confirm-credential-row">
                    <span class="confirm-credential-label">Contraseña:</span>
                    <span class="confirm-credential-value" id="confirm_password"></span>
                </div>
            </div>
        </div>
        
        <div class="confirm-footer">
            <button onclick="registrarOtroVendedor()" class="confirm-action-btn primary">
                <i class="fa-solid fa-user-plus"></i> Registrar Otro Vendedor
            </button>
            <button onclick="cerrarModalConfirmacion()" class="confirm-action-btn ghost">
                <i class="fa-solid fa-check"></i> Finalizar
            </button>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

<script>
// ==================== UTILITY FUNCTIONS ====================
function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}

// ==================== MODAL FUNCTIONS ====================
function abrirModal() { 
    document.getElementById('modalRegistro').classList.add('show');
}

function cerrarModal() { 
    document.getElementById('modalRegistro').classList.remove('show');
    document.getElementById('formRegistro').reset();
    $('#reg_cod_tienda').html('<option value="">Primero seleccione un aliado</option>');
    identificacionValida = false;
    $('#reg_identificacion').css('border-color', '');
    $('#mensaje_identificacion').hide();
    $('#btnGuardar').prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
}

function abrirModalEditar(data) {
    document.getElementById('edit_cod_administrador').value = data.cod_administrador;
    document.getElementById('edit_identificacion').value = data.cedula || data.identificacion_tercero || '';
    document.getElementById('edit_nombres').value = data.nombres || data.nombre1_tercero || '';
    document.getElementById('edit_apellidos').value = data.apellidos || data.apellido1_tercero || '';
    document.getElementById('edit_telefono').value = data.telefono || data.telefono1_tercero || '';
    document.getElementById('edit_correo').value = data.correo || data.correo_tercero || '';
    document.getElementById('edit_direccion').value = data.direccion_tercero || '';
    document.getElementById('edit_estado').value = data.cod_estado_activacion_usuario || '1';
    document.getElementById('edit_usuario').value = data.cuenta || '';
    document.getElementById('edit_aliado_nombre').value = data.nombre_aliado_display || data.nombre_aliado || 'N/A';
    document.getElementById('edit_tienda_nombre').value = data.nombre_tienda_display || data.nombre_tienda || 'Sin tienda';
    document.getElementById('edit_codigo_tipo_vendedor').value = data.codigo_tipo_vendedor || '0';
    
    document.getElementById('modalEditar').classList.add('show');
}

function cerrarModalEditar() { 
    document.getElementById('modalEditar').classList.remove('show');
}

function abrirModalDetalle(data) {
    var nombre = data.nombres_apellidos_tercero || (data.nombres + ' ' + data.apellidos);
    var palabras = nombre.trim().split(' ');
    var iniciales = palabras[0] ? palabras[0].charAt(0).toUpperCase() : '?';
    if (palabras.length > 1) iniciales += palabras[palabras.length - 1].charAt(0).toUpperCase();
    
    document.getElementById('detAvatar').textContent = iniciales;
    document.getElementById('detNombre').textContent = nombre;
    document.getElementById('detCedula').textContent = data.cedula || data.identificacion_tercero || 'N/A';
    document.getElementById('detTelefono').textContent = data.telefono || data.telefono1_tercero || 'No registrado';
    document.getElementById('detCorreo').textContent = data.correo || data.correo_tercero || 'No registrado';
    document.getElementById('detDireccion').textContent = data.direccion_tercero || 'No registrada';
    document.getElementById('detTienda').textContent = data.nombre_tienda_display || data.nombre_tienda || 'Sin tienda';
    document.getElementById('detAliado').textContent = data.nombre_aliado_display || data.nombre_aliado || 'N/A';
    document.getElementById('detUsuario').textContent = data.cuenta || 'N/A';
    
    var badge = document.getElementById('detEstado');
    if (data.cod_estado_activacion_usuario == '1') {
        badge.textContent = 'ACTIVO';
        badge.className = 'vendor-status active';
    } else {
        badge.textContent = 'INACTIVO';
        badge.className = 'vendor-status inactive';
    }
    
    document.getElementById('modalDetalle').classList.add('show');
}

function cerrarModalDetalle() { 
    document.getElementById('modalDetalle').classList.remove('show'); 
}

function cerrarModalConfirmacion() {
    document.getElementById('modalConfirmacion').classList.remove('show');
    location.reload();
}

function registrarOtroVendedor() {
    document.getElementById('modalConfirmacion').classList.remove('show');
    document.getElementById('formRegistro').reset();
    $('#reg_cod_tienda').html('<option value="">Primero seleccione un aliado</option>');
    identificacionValida = false;
    $('#btnGuardar').prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
    document.getElementById('modalRegistro').classList.add('show');
}

// ==================== AJAX: LOAD STORES BY ALLY ====================
function cargarTiendasPorAliado(codAliado) {
    var $select = $('#reg_cod_tienda');
    if (!codAliado || codAliado === '') {
        $select.html('<option value="">Primero seleccione un aliado</option>');
        return;
    }
    $select.html('<option value="">Cargando tiendas...</option>');
    
    $.ajax({
        url: '../admin/obtener_tiendas_por_aliado_ajax.php',
        type: 'POST',
        data: { cod_aliado_estrategico: codAliado },
        dataType: 'json',
        success: function(response) {
            $select.html('<option value="">Seleccione una tienda...</option>');
            if (response.success && response.tiendas && response.tiendas.length > 0) {
                $.each(response.tiendas, function(i, tienda) {
                    $select.append('<option value="' + tienda.cod_tienda + '">' + escapeHtml(tienda.nombre_tienda || tienda.nombre1_tercero) + '</option>');
                });
            } else {
                $select.html('<option value="">No hay tiendas disponibles</option>');
            }
        },
        error: function() {
            $select.html('<option value="">Error al cargar tiendas</option>');
        }
    });
}

// ==================== SEARCH / FILTER ====================
function filtrar() { 
    var busqueda = document.getElementById('searchInput').value;
    var filtro_estado = document.getElementById('filtroEstado').value;
    clearTimeout(window.searchTimeout); 
    window.searchTimeout = setTimeout(function() { 
        window.location.href = 'lista_vendedor_asesor_movil.php?busqueda=' + encodeURIComponent(busqueda) + '&filtro_estado=' + encodeURIComponent(filtro_estado); 
    }, 500); 
}

// ==================== ID VALIDATION ====================
var identificacionValida = false;

$(document).on('blur', '#reg_identificacion', function() {
    var identificacion = $(this).val().trim();
    var inputField = $(this);
    var mensajeDiv = $('#mensaje_identificacion');
    var btnGuardar = $('#btnGuardar');
    
    if (identificacion === '') {
        inputField.css('border-color', '');
        mensajeDiv.hide();
        identificacionValida = false;
        btnGuardar.prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
        return;
    }
    
    var codTienda = $('#reg_cod_tienda').val();
    
    $.ajax({
        url: '../admin/verificar_vendedor_existente_ajax.php',
        type: 'POST',
        data: { identificacion: identificacion, cod_tienda: codTienda },
        dataType: 'json',
        success: function(response) {
            if (response.existe) {
                inputField.css('border-color', '#ef4444');
                mensajeDiv.text('⚠️ Ya existe un vendedor con esta identificación para esta tienda').show();
                identificacionValida = false;
                btnGuardar.prop('disabled', true).css({'opacity': '0.5', 'cursor': 'not-allowed'});
            } else {
                inputField.css('border-color', '#22c55e');
                mensajeDiv.hide();
                identificacionValida = true;
                btnGuardar.prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
            }
        },
        error: function() {
            mensajeDiv.text('Error al verificar la identificación').show();
            identificacionValida = false;
            btnGuardar.prop('disabled', true).css({'opacity': '0.5', 'cursor': 'not-allowed'});
        }
    });
});

// ==================== FORM SUBMIT: REGISTER ====================
$('#formRegistro').on('submit', function(e) {
    e.preventDefault();
    
    var identificacion = $('#reg_identificacion').val().trim();
    if (identificacion === '') {
        Swal.fire({ icon: 'warning', title: 'Campo requerido', text: 'Debe ingresar una identificación', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return false;
    }
    
    var formData = new FormData(this);
    
    Swal.fire({ title: 'Registrando vendedor...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/reg_vendedor_modal_asesor_ajax_reg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(resp) {
            Swal.close();
            if (resp.success) {
                cerrarModal();
                document.getElementById('confirm_nombre_display').textContent = resp.nombre_completo || 'Vendedor registrado';
                document.getElementById('confirm_usuario').textContent = resp.usuario || '';
                document.getElementById('confirm_password').textContent = resp.contrasena_inicial || '';
                document.getElementById('modalConfirmacion').classList.add('show');
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: resp.message || 'No se pudo registrar el vendedor', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr) {
            Swal.close();
            console.log('Error AJAX:', xhr.responseText);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión. Intenta nuevamente.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});

// ==================== FORM SUBMIT: EDIT ====================
$('#formEditar').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    
    Swal.fire({ title: 'Actualizando...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/act_vendedor_modal_asesor_ajax_reg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(resp) {
            Swal.close();
            if (resp.success) {
                cerrarModalEditar();
                Swal.fire({ 
                    icon: 'success', title: '¡Actualizado!', text: resp.message || 'Vendedor actualizado correctamente', 
                    confirmButtonColor: '#f59e0b', background: '#1a1f2e', color: 'white', timer: 2000, timerProgressBar: true,
                    customClass: { container: 'swal-high-zindex' }
                }).then(() => { location.reload(); });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: resp.message || 'No se pudo actualizar', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr) {
            Swal.close();
            console.log('Error AJAX:', xhr.responseText);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión. Intenta nuevamente.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});

// ==================== PASSWORD RECOVERY ====================
function enviarRecuperacionPassword() {
    var codAdministrador = document.getElementById('edit_cod_administrador').value;
    var correo = document.getElementById('edit_correo').value;
    var nombre = document.getElementById('edit_nombres').value + ' ' + document.getElementById('edit_apellidos').value;
    
    if (!codAdministrador || !correo) {
        Swal.fire({ icon: 'warning', title: 'Datos incompletos', text: 'No se puede enviar la recuperación sin correo electrónico', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    Swal.fire({
        title: '¿Enviar nueva contraseña?',
        html: '<div style="text-align: left; padding: 1rem;"><p style="margin-bottom: 0.5rem;">Se generará una nueva contraseña temporal para:</p><strong style="color: #f59e0b;">' + escapeHtml(nombre) + '</strong><p style="margin-top: 0.5rem;">Se enviará al correo: <strong style="color: #f59e0b;">' + escapeHtml(correo) + '</strong></p><p style="margin-top: 0.5rem; color: #ef4444; font-size: 0.85rem;">La contraseña actual quedará inhabilitada.</p></div>',
        icon: 'question', showCancelButton: true,
        confirmButtonColor: '#f59e0b', cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fa-solid fa-envelope"></i> Sí, enviar',
        cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({ title: 'Generando y enviando...', showConfirmButton: false, allowOutsideClick: false, background: '#1a1f2e', color: 'white', didOpen: () => { Swal.showLoading(); }, customClass: { container: 'swal-high-zindex' } });
            
            $.ajax({
                url: '../admin/enviar_correo_recuperar_password_aliado_email_ajax.php',
                type: 'POST',
                data: { cod_administrador: codAdministrador, correo: correo, nombre_aliado: nombre },
                dataType: 'json',
                success: function(response) {
                    Swal.close();
                    if (response.success) {
                        Swal.fire({ icon: 'success', title: '¡Enviado!', 
                            html: '<p>' + (response.mensaje || 'Contraseña enviada') + '</p>' + (response.password_temporal ? '<p style="margin-top: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.7);">Nueva contraseña temporal: <strong style="color: #f59e0b;">' + response.password_temporal + '</strong></p>' : ''),
                            confirmButtonColor: '#f59e0b', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje || 'No se pudo enviar la contraseña', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                    }
                },
                error: function() {
                    Swal.close();
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión. Intenta nuevamente.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                }
            });
        }
    });
}

// ==================== CLOSE MODALS ON OVERLAY CLICK ====================
$('.modal-overlay').on('click', function(e) {
    if (e.target === this) $(this).removeClass('show');
});

document.getElementById('modalConfirmacion').addEventListener('click', function(e) {
    if (e.target === this) cerrarModalConfirmacion();
});

// ==================== NOTIFICATIONS ====================
var notificationCheckInterval = null;

$(document).ready(function() {
    cargarNotificaciones();
    notificationCheckInterval = setInterval(cargarNotificaciones, 30000);
});

function cargarNotificaciones() {
    $.ajax({
        url: '../admin/obtener_notificaciones_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) actualizarUINotificaciones(response.notificaciones, response.count);
        }
    });
}

function actualizarUINotificaciones(notificaciones, count) {
    var $badge = $('#notificationBadge'), $bell = $('#notificationBell'), $list = $('#notificationList');
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
            var iconClass = 'type-' + (notif.tipo || 1), iconSymbol = getNotificationIcon(notif.tipo);
            html += '<div class="notification-item-vendedor" onclick="marcarNotificacionLeida(' + notif.id + ', this)">';
            html += '<div class="notification-icon-vendedor ' + iconClass + '"><i class="fa-solid ' + iconSymbol + '"></i></div>';
            html += '<div class="notification-content-vendedor"><div class="notification-title-vendedor">' + escapeHtml(notif.titulo) + '</div>';
            html += '<div class="notification-desc-vendedor">' + escapeHtml(notif.descripcion) + '</div>';
            html += '<div class="notification-time-vendedor"><i class="fa-regular fa-clock"></i> ' + notif.fecha_corta + '</div></div></div>';
        });
        $list.html(html);
    } else {
        $list.html('<div class="notification-empty-vendedor"><i class="fa-solid fa-bell-slash"></i><p>No hay notificaciones pendientes</p></div>');
    }
}

function getNotificationIcon(tipo) {
    switch(parseInt(tipo)) { case 1: return 'fa-signature'; case 2: return 'fa-exclamation-circle'; case 3: return 'fa-info-circle'; default: return 'fa-bell'; }
}

function toggleNotificationPanel() { $('#notificationPanel').toggleClass('show'); }

$(document).on('click', function(e) {
    if (!$(e.target).closest('#notificationPanel, #notificationBell').length) $('#notificationPanel').removeClass('show');
});

function marcarNotificacionLeida(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php',
        type: 'POST',
        data: { cod_notificacion: codNotificacion },
        dataType: 'json',
        success: function(response) {
            if (response.success) $(element).fadeOut(300, function() { $(this).remove(); cargarNotificaciones(); });
        }
    });
}

function marcarTodasLeidas() {
    Swal.fire({
        title: '¿Marcar todas como leídas?',
        text: 'Se marcarán todas las notificaciones pendientes como leídas',
        icon: 'question', showCancelButton: true,
        confirmButtonColor: '#f59e0b', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, marcar todas', cancelButtonText: 'Cancelar',
        background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/marcar_notificacion_leida_ajax.php',
                type: 'POST',
                data: { marcar_todas: 'si' },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarNotificaciones();
                        Swal.fire({ icon: 'success', title: '¡Listo!', text: 'Todas las notificaciones marcadas como leídas', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
                    }
                }
            });
        }
    });
}
</script>

<!-- Notification Bell -->
<button class="notification-bell-vendedor" id="notificationBell" onclick="toggleNotificationPanel()">
    <i class="fa-solid fa-bell"></i>
    <span class="notification-badge-vendedor" id="notificationBadge" style="display: none;">0</span>
</button>

<div class="notification-panel-vendedor" id="notificationPanel">
    <div class="notification-header-vendedor">
        <h4><i class="fa-solid fa-bell"></i> Notificaciones</h4>
        <div class="notification-header-actions">
            <button onclick="marcarTodasLeidas()"><i class="fa-solid fa-check-double"></i> Leer todas</button>
            <button onclick="toggleNotificationPanel()"><i class="fa-solid fa-times"></i></button>
        </div>
    </div>
    <div class="notification-list-vendedor" id="notificationList">
        <div class="notification-empty-vendedor">
            <i class="fa-solid fa-bell-slash"></i>
            <p>No hay notificaciones pendientes</p>
        </div>
    </div>
</div>

</body>
</html>
