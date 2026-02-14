<?php 
$nombre_pagina = "Detalle Aliado";
$cod_seguridad_pag = "1";
$pagina_local = $_SERVER['PHP_SELF'];
$cod_base_caja = "1";
?>
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_asesor.php"); ?>
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_asesor.php"); ?>

<?php
$cod_aliado = isset($_GET['cod_administrador']) ? intval($_GET['cod_administrador']) : 0;

$sql = "SELECT a.*, l.nombres_apellidos_tercero AS nombre_lider, c.nombres_apellidos_tercero AS nombre_coordinador, ase.nombres_apellidos_tercero AS nombre_asesor,
ts.nombre_tipo_sector, ts.descripcion_tipo_sector
FROM tbl15_administrador a 
LEFT JOIN tbl15_administrador l ON a.cod_lider = l.cod_administrador 
LEFT JOIN tbl15_administrador c ON a.cod_coordinador = c.cod_administrador 
LEFT JOIN tbl15_administrador ase ON a.cod_asesor = ase.cod_administrador
LEFT JOIN tbl15_tipo_sector ts ON a.cod_tipo_sector = ts.cod_tipo_sector
WHERE a.cod_administrador = '$cod_aliado'";
$r = mysqli_query($conectar, $sql);
$row = mysqli_fetch_assoc($r);

if (!$row) { header("Location: lista_aliado_asesor_movil.php"); exit; }

// Generar código encriptado del aliado para compartir enlace
$cod_aliado_cryp = DAXCODIFCRYPTOR::encriptardax(DAXCODIFCRYPTOR::encodifdax($cod_aliado));

// Obtener tiendas
$sql_tiendas = "SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE cod_aliado_estrategico = '$cod_aliado'";
$res_tiendas = mysqli_query($conectar, $sql_tiendas);
$tiendas_arr = [];
$nombres_tiendas = [];
while($t = mysqli_fetch_assoc($res_tiendas)) {
    $tiendas_arr[] = $t; // Mantener la estructura del array asociativo
    $nombres_tiendas[] = $t['nombre_tienda']; // Para el texto de resumen
}
$tiendas_texto = count($nombres_tiendas) > 0 ? implode(', ', $nombres_tiendas) : 'Sin tiendas registradas';

// Obtener créditos asociados al aliado
$sql_creditos = "SELECT * FROM tbl_credito WHERE cod_aliado = '$cod_aliado' ORDER BY fecha_credito DESC";
$res_creditos = mysqli_query($conectar, $sql_creditos);
$total_creditos = 0;
$creditos_activos = 0;
$creditos_pagados = 0;

if ($res_creditos) {
    while($credito = mysqli_fetch_assoc($res_creditos)) {
        $total_creditos += $credito['valor_credito'];
        if ($credito['estado_credito'] == 'ACTIVO' || $credito['estado_credito'] == '1') { $creditos_activos += $credito['valor_credito']; } else if ($credito['estado_credito'] == 'PAGADO' || $credito['estado_credito'] == '2') { $creditos_pagados += $credito['valor_credito']; }
    }
    // Resetear el puntero del resultado para usarlo después
    mysqli_data_seek($res_creditos, 0);
}

// Obtener bancos disponibles
$sql_bancos = "SELECT cod_banco, nombre_banco FROM tbl15_banco WHERE cod_estado = '1' ORDER BY nombre_banco ASC";
$res_bancos = mysqli_query($conectar, $sql_bancos);
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
<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
        min-height: 100vh;
        margin: 0; padding: 0; box-sizing: border-box;
    }
    .page-container {
        padding: 1rem;
        padding-bottom: 100px;
        max-width: 800px;
        margin: 0 auto;
    }
    .page-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .back-btn {
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        width: 40px; height: 40px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        text-decoration: none;
    }
    .page-title {
        color: white; margin: 0; font-size: 1.25rem;
    }
    
    .profile-card {
        background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        padding: 2rem 1.5rem;
        text-align: center;
    }
    .profile-avatar {
        width: 100px; height: 100px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        margin: 0 auto 1rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 3rem; color: white;
        border: 4px solid rgba(255,255,255,0.1);
    }
    .profile-name {
        color: white; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;
    }
    .profile-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: rgba(255,255,255,0.2);
        border-radius: 15px;
        color: white; font-size: 0.8rem; font-weight: 600;
        text-transform: uppercase;
    }
    
    .profile-body {
        padding: 1.5rem;
    }
    
    .detail-section {
        margin-bottom: 1.5rem;
    }
    .section-title {
        color: #10b981;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(16, 185, 129, 0.2);
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    .detail-item {
        background: rgba(255,255,255,0.03);
        padding: 0.75rem 1rem;
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .detail-label {
        color: rgba(255,255,255,0.5); font-size: 0.85rem;
    }
    .detail-value {
        color: white; font-weight: 600; font-size: 0.95rem; text-align: right;
    }
    
    .store-list {
        display: flex; flex-direction: column; gap: 0.5rem;
    }
    .store-item {
        background: rgba(16, 185, 129, 0.1);
        padding: 0.75rem;
        border-radius: 10px;
        color: white;
        display: flex; align-items: center; gap: 0.75rem;
    }
    .store-item a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
        width: 100%;
    }
    .store-item a:hover {
        color: #10b981;
        text-decoration: none;
    }
    .store-item i { color: #10b981; }

    /* Estilos para créditos */
    .creditos-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .credito-item {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 1rem;
        transition: all 0.3s ease;
    }
    .credito-item:hover {
        border-color: rgba(16, 185, 129, 0.3);
        background: rgba(255,255,255,0.05);
    }
    .credito-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.5rem;
    }
    .credito-valor {
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
    }
    .credito-fecha {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.6);
    }
    .credito-estado {
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .credito-estado.activo {
        background: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }
    .credito-estado.pagado {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }
    .credito-descripcion {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
        margin: 0.5rem 0;
        padding: 0.5rem;
        background: rgba(255,255,255,0.02);
        border-radius: 8px;
    }
    .credito-vencimiento {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255,255,255,0.6);
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }
    .credito-vencimiento i {
        color: #10b981;
    }
    .credito-empty {
        text-align: center;
        padding: 2rem;
        color: rgba(255,255,255,0.5);
    }
    .credito-empty i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: rgba(16, 185, 129, 0.3);
    }
    .credito-empty p {
        margin: 0;
        font-size: 0.9rem;
    }

    @media(min-width: 600px) {
        .detail-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* Bottom Navigation Styles */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
        border-top: 1px solid rgba(16, 185, 129, 0.2);
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
        color: #10b981;
        text-decoration: none;
    }
    .nav-item.active {
        background: rgba(16, 185, 129, 0.1);
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
    
    /* Sección y Botón Documentación */
    .documentacion-section {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(124, 58, 237, 0.15));
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .documentacion-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    .documentacion-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
    }
    .documentacion-info h4 {
        color: white;
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 0.25rem 0;
    }
    .documentacion-info p {
        color: rgba(255,255,255,0.6);
        font-size: 0.8rem;
        margin: 0;
    }
    .btn-documentacion {
        width: 100%;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border: none;
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
    }
    .btn-documentacion:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.5);
        background: linear-gradient(135deg, #9061ff 0%, #8b5cf6 100%);
    }
    .btn-documentacion i {
        font-size: 1.1rem;
    }
    .documentacion-status {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }
    .doc-badge {
        padding: 0.4rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .doc-badge.complete {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
    }
    .doc-badge.pending {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
    }
    
    /* SweetAlert por encima de modales */
    .swal-on-top-modal {
        z-index: 10000 !important;
    }
</style>
</head>
<body>

<main class="page-container">
    <div class="page-header"><a href="lista_aliado_asesor_movil.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a><h1 class="page-title">Detalle de Aliado</h1></div>

    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar"><i class="fa-solid fa-user"></i></div>
            <h2 class="profile-name"><?php echo !empty($row['nombres_apellidos_tercero']) ? $row['nombres_apellidos_tercero'] : ($row['nombres'] . ' ' . $row['apellidos']); ?></h2>
            <span class="profile-status" style="<?php echo $row['cod_estado_activacion_usuario'] == '1' ? 'background: #10b981;' : 'background: #ef4444;'; ?>"><?php echo $row['cod_estado_activacion_usuario'] == '1' ? 'Activo' : 'Inactivo'; ?></span>
        </div>
        
        <div class="profile-body">
            <div class="detail-section">
                <h3 class="section-title">Información del Administrador</h3>
                <div class="detail-grid">
             
                    <div class="detail-item">
                        <span class="detail-label">Nombre Comercial</span>
                        <span class="detail-value"><?php echo $row['nombres_apellidos_tercero'] ?: 'No registrado'; ?></span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Tipo de Cliente</span>
                        <span class="detail-value">
                            <?php 
                            $tipo_cliente_display = $row['nombre_tipo_cliente'] ?: 'No registrado';
                            if ($tipo_cliente_display == 'PERSONA_NATURAL') {
                                echo '<span style="background: rgba(59, 130, 246, 0.2); color: #3b82f6; padding: 0.25rem 0.6rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600;"><i class="fa-solid fa-user"></i> Persona Natural</span>';
                            } elseif ($tipo_cliente_display == 'PERSONA_JURIDICA' || $tipo_cliente_display == '2') {
                                echo '<span style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 0.25rem 0.6rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600;"><i class="fa-solid fa-building"></i> Persona Jurídica</span>';
                            } else {
                                echo $tipo_cliente_display;
                            }
                            ?>
                        </span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Tipo de Sector</span>
                        <span class="detail-value" title="<?php echo htmlspecialchars($row['descripcion_tipo_sector'] ?: ''); ?>">
                            <?php echo $row['nombre_tipo_sector'] ?: 'No registrado'; ?>
                        </span>
                    </div>
                    
                    <?php if (!empty($row['nit_razon_social'])): ?>
                    <div class="detail-item">
                        <span class="detail-label">NIT Razón Social</span>
                        <span class="detail-value"><?php echo $row['nit_razon_social']; ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="detail-item">
                        <span class="detail-label">Identificación</span>
                        <span class="detail-value"><?php echo $row['cedula']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nombres</span>
                        <span class="detail-value"><?php echo $row['nombres'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Apellidos</span>
                        <span class="detail-value"><?php echo $row['apellidos'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Teléfono</span>
                        <span class="detail-value"><?php echo $row['telefono'] ?: 'No registrado'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Correo</span>
                        <span class="detail-value" style="font-size: 0.8rem;"><?php echo $row['correo'] ?: 'No registrado'; ?></span>
                    </div>
                    <?php if (!empty($row['direccion'])): ?>
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <span class="detail-label">Dirección</span>
                        <span class="detail-value"><?php echo $row['direccion']; ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="detail-section">
                <h3 class="section-title">Información Comercial</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Usuario</span>
                        <span class="detail-value"><?php echo $row['cuenta']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Asesor</span>
                        <span class="detail-value"><?php echo $row['nombre_asesor'] ?: 'Sin asignar'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Líder</span>
                        <span class="detail-value"><?php echo $row['nombre_lider'] ?: 'Sin asignar'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Coordinador</span>
                        <span class="detail-value"><?php echo $row['nombre_coordinador'] ?: 'Sin asignar'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Fecha de Registro</span>
                        <span class="detail-value"><?php echo !empty($row['fecha_creacion']) ? date('d/m/Y', strtotime($row['fecha_creacion'])) : 'No disponible'; ?></span>
                    </div>
                </div>
            </div>
            <!-- Resumen de créditos -->
<!--
            <div class="detail-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; border-bottom: 1px solid rgba(16, 185, 129, 0.2); padding-bottom: 0.5rem;">
                    <h3 class="section-title" style="border: none; margin: 0; padding: 0;">Créditos Asociados</h3>
                    <button onclick="abrirModalCredito()" style="background: rgba(16, 185, 129, 0.2); color: #10b981; border: none; padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-plus"></i> Nuevo Crédito
                    </button>
                </div>
                
                <div class="detail-grid" style="margin-bottom: 1rem;">
                    <div class="detail-item" style="background: rgba(16, 185, 129, 0.1);">
                        <span class="detail-label">Total Créditos</span>
                        <span class="detail-value" style="color: #10b981;">$<?php echo number_format($total_creditos, 0, ',', '.'); ?></span>
                    </div>
                    <div class="detail-item" style="background: rgba(255, 193, 7, 0.1);">
                        <span class="detail-label">Activos</span>
                        <span class="detail-value" style="color: #ffc107;">$<?php echo number_format($creditos_activos, 0, ',', '.'); ?></span>
                    </div>
                    <div class="detail-item" style="background: rgba(40, 167, 69, 0.1);">
                        <span class="detail-label">Pagados</span>
                        <span class="detail-value" style="color: #28a745;">$<?php echo number_format($creditos_pagados, 0, ',', '.'); ?></span>
                    </div>
                </div>
-->
                <!-- Lista de créditos -->
<!--
                <div class="creditos-list">
                    <?php if ($res_creditos && mysqli_num_rows($res_creditos) > 0): ?>
                        <?php while($credito = mysqli_fetch_assoc($res_creditos)): ?>
                        <div class="credito-item">
                            <div class="credito-header">
                                <div class="credito-info">
                                    <div class="credito-valor">$<?php echo number_format($credito['valor_credito'], 0, ',', '.'); ?></div>
                                    <div class="credito-fecha"><?php echo date('d/m/Y', strtotime($credito['fecha_credito'])); ?></div>
                                </div>
                                <span class="credito-estado <?php echo ($credito['estado_credito'] == 'ACTIVO' || $credito['estado_credito'] == '1') ? 'activo' : 'pagado'; ?>">
                                    <?php echo ($credito['estado_credito'] == 'ACTIVO' || $credito['estado_credito'] == '1') ? 'ACTIVO' : 'PAGADO'; ?>
                                </span>
                            </div>
                            <?php if (!empty($credito['descripcion_credito'])): ?>
                            <div class="credito-descripcion"><?php echo $credito['descripcion_credito']; ?></div>
                            <?php endif; ?>
                            <?php if (!empty($credito['fecha_vencimiento'])): ?>
                            <div class="credito-vencimiento">
                                <i class="fa-solid fa-calendar"></i> Vence: <?php echo date('d/m/Y', strtotime($credito['fecha_vencimiento'])); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="credito-empty">
                            <i class="fa-solid fa-credit-card"></i><p>No hay créditos registrados</p></div>
                    <?php endif; ?>
                </div>
-->
            </div>

            <!-- Sección Documentación Legal -->
            <div class="documentacion-section">
                <div class="documentacion-header">
                    <div class="documentacion-icon">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                    <div class="documentacion-info">
                        <h4>Documentación Legal</h4>
                        <p>Compartir enlace para carga de documentos</p>
                    </div>
                </div>
                
                <div class="documentacion-status">
                    <?php 
                    $rut_cargado = !empty($row['url_documentacion_rut_aliado']);
                    $camara_cargada = !empty($row['url_documentacion_camaracomercio_aliado']);
                    $cedula_cargada = !empty($row['url_documentacion_cedula_aliado']);
                    ?>
                    <div class="doc-badge <?php echo $rut_cargado ? 'complete' : 'pending'; ?>"><i class="fa-solid fa-<?php echo $rut_cargado ? 'check-circle' : 'clock'; ?>"></i>RUT</div>
                    <div class="doc-badge <?php echo $camara_cargada ? 'complete' : 'pending'; ?>"><i class="fa-solid fa-<?php echo $camara_cargada ? 'check-circle' : 'clock'; ?>"></i>Cámara de Comercio</div>
                    <div class="doc-badge <?php echo $cedula_cargada ? 'complete' : 'pending'; ?>"><i class="fa-solid fa-<?php echo $cedula_cargada ? 'check-circle' : 'clock'; ?>"></i>Cédula</div>
                </div>
                
                <?php if ($rut_cargado || $camara_cargada || $cedula_cargada): ?>
                <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem;">
                    <?php if ($cedula_cargada): ?>
                    <a href="<?php echo htmlspecialchars($row['url_documentacion_cedula_aliado']); ?>" target="_blank" style="color: #10b981; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: rgba(16, 185, 129, 0.1); border-radius: 8px;">
                        <i class="fa-solid fa-file-pdf"></i>Ver Cédula
                    </a>
                    <?php endif; ?>
                    <?php if ($rut_cargado): ?>
                    <a href="<?php echo htmlspecialchars($row['url_documentacion_rut_aliado']); ?>" target="_blank" style="color: #10b981; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: rgba(16, 185, 129, 0.1); border-radius: 8px;">
                        <i class="fa-solid fa-file-pdf"></i>Ver Documento RUT
                    </a>
                    <?php endif; ?>
                    <?php if ($camara_cargada): ?>
                    <a href="<?php echo htmlspecialchars($row['url_documentacion_camaracomercio_aliado']); ?>" target="_blank" style="color: #10b981; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: rgba(16, 185, 129, 0.1); border-radius: 8px;">
                        <i class="fa-solid fa-file-pdf"></i>Ver Cámara de Comercio
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <button class="btn-documentacion" 
                    data-cod="<?php echo htmlspecialchars($cod_aliado_cryp, ENT_QUOTES); ?>"
                    data-nombre="<?php echo htmlspecialchars(!empty($row['nombres_apellidos_tercero']) ? $row['nombres_apellidos_tercero'] : ($row['nombres'] . ' ' . $row['apellidos']), ENT_QUOTES); ?>"
                    data-telefono="<?php echo htmlspecialchars($row['telefono'], ENT_QUOTES); ?>"
                    data-correo="<?php echo htmlspecialchars($row['correo'], ENT_QUOTES); ?>"
                    data-rut="<?php echo isset($row['url_documentacion_rut_aliado']) ? htmlspecialchars($row['url_documentacion_rut_aliado'], ENT_QUOTES) : ''; ?>"
                    data-camara="<?php echo isset($row['url_documentacion_camaracomercio_aliado']) ? htmlspecialchars($row['url_documentacion_camaracomercio_aliado'], ENT_QUOTES) : ''; ?>"
                    data-cedula="<?php echo isset($row['url_documentacion_cedula_aliado']) ? htmlspecialchars($row['url_documentacion_cedula_aliado'], ENT_QUOTES) : ''; ?>"
                    onclick="abrirModalDocumentacionAliado(this.getAttribute('data-cod'), this.getAttribute('data-nombre'), this.getAttribute('data-telefono'), this.getAttribute('data-correo'), this.getAttribute('data-rut'), this.getAttribute('data-camara'), this.getAttribute('data-cedula'))">
                    <i class="fa-solid fa-share-nodes"></i>Compartir enlace para la carga de documentos
                </button>
            </div>

            <div class="detail-section">
                <h3 class="section-title">Información Bancaria</h3>
                <?php
                // Consultar cuentas bancarias del aliado
                $sql_banco = "SELECT * FROM tbl15_banco_cuenta WHERE cod_aliado_estrategico = '$cod_aliado' AND cod_estado = '1'";
                $res_banco = mysqli_query($conectar, $sql_banco);
                ?>
                <div class="detail-grid" id="listaBancos">
                    <?php if ($res_banco && mysqli_num_rows($res_banco) > 0): ?>
                        <?php while($banco = mysqli_fetch_assoc($res_banco)): ?>
                        <div class="detail-item">
                            <span class="detail-label"><?php echo $banco['nombre_banco_cuenta']; ?></span>
                            <div class="detail-value" style="font-size: 0.8rem;">
                                <?php echo $banco['numero_banco_cuenta']; ?><br>
                                <small style="color: rgba(255,255,255,0.5);">
                                    <?php $tipo = isset($banco['cod_tipo_cuenta_banco']) ? $banco['cod_tipo_cuenta_banco'] : 0; if ($tipo == 1) echo 'Ahorros'; elseif ($tipo == 2) echo 'Corriente'; else echo 'Otro'; ?>
                                    <?php if (!empty($banco['nombre_titular_cuenta'])): ?> - <?php echo $banco['nombre_titular_cuenta']; ?><?php endif; ?>
                                </small>
                                <?php if (!empty($banco['url_certificado_banco_cuenta'])): ?>
                                <br>
                                <a href="<?php echo htmlspecialchars($banco['url_certificado_banco_cuenta']); ?>" target="_blank" style="color: #10b981; font-size: 0.75rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem; margin-top: 0.25rem;">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    Ver Certificado Bancario
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="detail-item" style="grid-column: 1 / -1; justify-content: center; opacity: 0.5;">No hay cuentas registradas</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="detail-section">
                <h3 class="section-title">Tiendas Asociadas</h3>
                <div class="store-list">
                    <?php if (count($tiendas_arr) > 0): ?>
                        <?php foreach($tiendas_arr as $tienda): ?>
                            <div class="store-item"><a href="../admin/ver_detalle_tienda_movil.php?cod_tienda=<?php echo $tienda['cod_tienda']; ?>"><i class="fa-solid fa-store"></i><?php echo $tienda['nombre_tienda']; ?></a></div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="store-item" style="justify-content: center; opacity: 0.5;">No tiene tiendas registradas</div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Sección de Parametrización de Entidades Crediticias -->
            <div class="detail-section">
                <h3 class="section-title"><i class="fa-solid fa-building-columns"></i> Líneas de Crédito</h3>
                
                <?php
                // Consultar entidades crediticias parametrizadas para este aliado (activas e inactivas)
                $sql_entidades_aliado = "SELECT * FROM tbl15_parametrizacion_entidad_crediticia_aliado WHERE (cod_aliado_estrategico = '$cod_aliado') ORDER BY cod_estado DESC, cod_posicion ASC";
                $res_entidades_aliado = mysqli_query($conectar, $sql_entidades_aliado);
                $total_entidades = 0;
                if ($res_entidades_aliado) { $total_entidades = mysqli_num_rows($res_entidades_aliado); }
                ?>
                <div class="entidades-grid" id="listaEntidades" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 0.75rem;">
                    <?php if ($total_entidades > 0): ?>
                        <?php while($entidad = mysqli_fetch_assoc($res_entidades_aliado)): 

                            $cod_parametrizacion_entidad_crediticia_aliado                        = $entidad['cod_parametrizacion_entidad_crediticia_aliado'];
                            $cod_entidad_crediticia                                               = $entidad['cod_entidad_crediticia'];
                            $nombre_entidad_crediticia                                            = $entidad['nombre_entidad_crediticia'];
                            $interes_ptj                                                          = $entidad['interes_ptj'];
                            $cod_estado                                                           = $entidad['cod_estado'];

                            $sql_entidad_crediticia = "SELECT url_entidad_crediticia_imag_min FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
                            $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
                            $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

                            $url_entidad_crediticia_imag_min                                      = $datos_entidad_crediticia['url_entidad_crediticia_imag_min'];

                            $es_activo = ($cod_estado == '1');
                            // Estilos según estado
                            $border_color = $es_activo ? 'rgba(16, 185, 129, 0.3)' : 'rgba(239, 68, 68, 0.3)';
                            $bg_color = $es_activo ? 'rgba(16, 185, 129, 0.05)' : 'rgba(239, 68, 68, 0.05)';
                            $opacity = $es_activo ? '1' : '0.7';
                        ?>
                        <div class="entidad-card" id="entidad_<?php echo $cod_parametrizacion_entidad_crediticia_aliado; ?>" style="background: <?php echo $bg_color; ?>; border: 1px solid <?php echo $border_color; ?>; border-radius: 12px; padding: 0.75rem; position: relative; opacity: <?php echo $opacity; ?>;">
                            <!-- Badge de estado -->
                            <div style="position: absolute; top: 0.5rem; right: 0.5rem;">
                                <?php if ($es_activo): ?>
                                <span style="font-size: 0.6rem; padding: 0.15rem 0.4rem; background: rgba(16, 185, 129, 0.2); color: #10b981; border-radius: 6px; font-weight: 700; text-transform: uppercase;">
                                    Activo
                                </span>
                                <?php else: ?>
                                <span style="font-size: 0.6rem; padding: 0.15rem 0.4rem; background: rgba(239, 68, 68, 0.2); color: #ef4444; border-radius: 6px; font-weight: 700; text-transform: uppercase;">
                                    Inactivo
                                </span>
                                <?php endif; ?>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-top: 0.5rem;">
                                <?php if (!empty($url_entidad_crediticia_imag_min)): ?>
                                <img src="<?php echo $url_entidad_crediticia_imag_min; ?>" alt="" style="width: 40px; height: 40px; object-fit: contain; border-radius: 8px; background: white; padding: 4px; <?php echo !$es_activo ? 'filter: grayscale(50%);' : ''; ?>">
                                <?php else: ?>
                                <div style="width: 40px; height: 40px; background: <?php echo $es_activo ? 'rgba(16, 185, 129, 0.2)' : 'rgba(150, 150, 150, 0.2)'; ?>; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-university" style="color: <?php echo $es_activo ? '#10b981' : '#9ca3af'; ?>;"></i>
                                </div>
                                <?php endif; ?>
                                <div style="flex: 1; min-width: 0;">
                                    <div style="color: <?php echo $es_activo ? 'white' : 'rgba(255,255,255,0.6)'; ?>; font-weight: 600; font-size: 0.85rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?php echo $nombre_entidad_crediticia; ?>
                                    </div>
                                    <div style="display: flex; gap: 0.5rem; margin-top: 0.25rem; flex-wrap: wrap;">
                                        <span style="font-size: 0.7rem; padding: 0.15rem 0.4rem; background: <?php echo $es_activo ? 'rgba(16, 185, 129, 0.2)' : 'rgba(150, 150, 150, 0.2)'; ?>; color: <?php echo $es_activo ? '#10b981' : '#9ca3af'; ?>; border-radius: 6px; font-weight: 600;">
                                            Interés: <?php echo number_format($interes_ptj, 2); ?>%
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div style="grid-column: 1 / -1; text-align: center; padding: 1.5rem; color: rgba(255,255,255,0.5);">
                            <i class="fa-solid fa-building-columns" style="font-size: 2rem; margin-bottom: 0.5rem; opacity: 0.3; display: block;"></i>
                            <p style="margin: 0; font-size: 0.85rem;">No hay líneas de crédito configuradas para este aliado</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
<!--
            <a href="lista_tiendas_aliado_movil.php?cod_aliado_estrategico=<?php echo $row['cod_administrador']; ?>" 
               style="display: block; text-align: center; margin-top: 2rem; padding: 1rem; background: rgba(16, 185, 129, 0.1); color: #10b981; text-decoration: none; border-radius: 12px; font-weight: 600;">
               <i class="fa-solid fa-list"></i> Ver Lista de Tiendas
            </a>
-->

        </div>
    </div>
</main>

<!-- Modal Registro Banco -->
<div class="modal-overlay" id="modalBanco">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-building-columns"></i> Registrar Cuenta</h2>
            <button class="modal-close" onclick="cerrarModalBanco()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="formRegistroBanco">
                <input type="hidden" name="cod_aliado_estrategico" value="<?php echo $cod_aliado; ?>">
                <input type="hidden" id="cod_banco_cuenta_edit" name="cod_banco_cuenta_edit" value="">
                <input type="hidden" id="accion_banco" name="accion_banco" value="registrar">

                <!-- Información del Aliado -->
                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-user" style="color: #10b981; font-size: 1.25rem;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="color: rgba(255,255,255,0.6); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.25rem;">Aliado Estratégico</div>
                            <div style="color: white; font-size: 0.95rem; font-weight: 700;">
                                <?php echo !empty($row['nombres_apellidos_tercero']) ? $row['nombres_apellidos_tercero'] : ($row['nombres'] . ' ' . $row['apellidos']); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Banco *</label>
                    <select class="form-select" name="nombre_banco_cuenta" required>
                        <option value="">Seleccione...</option>
                        <?php 
                        if ($res_bancos && mysqli_num_rows($res_bancos) > 0) {
                            mysqli_data_seek($res_bancos, 0);
                            while($banco = mysqli_fetch_assoc($res_bancos)) {
                                echo '<option value="' . htmlspecialchars($banco['nombre_banco']) . '">' . htmlspecialchars($banco['nombre_banco']) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo de Cuenta *</label>
                    <select class="form-select" name="nombre_tipo_cuenta" required>
                        <option value="Ahorros">Ahorros</option>
                        <option value="Corriente">Corriente</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Número de Cuenta *</label>
                    <input type="number" class="form-input" name="numero_banco_cuenta" required placeholder="Ej: 123456789">
                </div>

                <div class="form-group">
                    <label class="form-label">Titular de la Cuenta</label>
                    <input type="text" class="form-input" name="nombre_titular_cuenta" placeholder="Nombre completo">
                </div>

                <button type="submit" class="submit-btn" id="btn_submit_banco"><i class="fa-solid fa-save"></i> Guardar Cuenta</button>
            </form>
        </div>
    </div>
</div>

<style>
/* Reusing/Ensuring Modal Styles are present */
.modal-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.8); backdrop-filter: blur(5px);
    z-index: 2000; display: none; align-items: center; justify-content: center;
    padding: 1rem;
}
.modal-overlay.show { display: flex; }
.modal-content {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 24px; width: 100%; max-width: 600px;
    padding: 0; animation: fadeInScale 0.3s ease;
    max-height: 90vh; overflow-y: auto;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
}
@keyframes fadeInScale { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
.modal-header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 1.5rem; border-bottom: 1px solid rgba(16, 185, 129, 0.2);
    background: #1a1f2e; border-radius: 24px 24px 0 0;
    position: sticky; top: 0; z-index: 10;
}
.modal-body { padding: 1.5rem; padding-bottom: 2rem; }
.modal-header h2 { color: white; font-size: 1.25rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 0.5rem; }
.modal-close { background: rgba(239, 68, 68, 0.2); color: #ef4444; border: none; width: 40px; height: 40px; border-radius: 12px; cursor: pointer; }

/* Form Styles Matching Lista Tienda */
.form-section-title {
    color: #10b981; font-size: 0.9rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1px; margin: 1.5rem 0 1rem 0; padding-bottom: 0.5rem;
    border-bottom: 1px solid rgba(16, 185, 129, 0.2); display: flex; align-items: center; gap: 0.5rem;
}
.form-group { margin-bottom: 1rem; }
.form-label { display: block; color: rgba(255,255,255,0.8); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; }
.form-input, .form-select {
    width: 100%; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 12px; padding: 0.85rem 1rem; color: white; font-size: 0.95rem; outline: none;
    transition: all 0.3s ease;
}
.form-input:focus, .form-select:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2); }
.form-select {
    appearance: none; cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2310b981' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 1rem center; background-size: 1rem;
    background-color: #1a1f2e; /* Ensure background color matches modal */
}
.form-select option { background-color: #1a1f2e; color: white; }

.form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }

.file-input-wrapper {
    position: relative; border: 2px dashed rgba(16, 185, 129, 0.3); border-radius: 12px;
    padding: 1.5rem; text-align: center; background: rgba(16, 185, 129, 0.05); transition: all 0.3s ease;
}
.file-input-wrapper:hover { border-color: #10b981; background: rgba(16, 185, 129, 0.1); }
.file-input-wrapper input[type="file"] {
    position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;
}
.file-input-icon { font-size: 2rem; color: #10b981; margin-bottom: 0.5rem; }
.file-input-text { font-size: 0.85rem; color: rgba(255,255,255,0.7); }
.image-preview {
    margin-top: 1rem; width: 100%; height: 150px; object-fit: cover; border-radius: 8px;
    display: none; border: 1px solid rgba(16, 185, 129, 0.3);
}

.gps-btn {
    background: #10b981; color: white; border: none; padding: 0.85rem; border-radius: 12px;
    cursor: pointer; width: 100%; display: flex; align-items: center; justify-content: center;
    gap: 0.5rem; font-weight: 600;
}
.gps-status { margin-top: 0.5rem; font-size: 0.8rem; padding: 0.5rem; border-radius: 8px; display: none; }

.submit-btn {
    width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none;
    padding: 1rem; border-radius: 12px; font-size: 1rem; font-weight: 700; cursor: pointer; margin-top: 1rem;
}
</style>

<script>
function abrirModalBanco() {
    // Limpiar formulario para nuevo registro
    document.getElementById('formRegistroBanco').reset();
    document.getElementById('cod_banco_cuenta_edit').value = '';
    document.getElementById('accion_banco').value = 'registrar';
    
    // Actualizar título y botón
    document.querySelector('#modalBanco .modal-header h2').innerHTML = '<i class="fa-solid fa-building-columns"></i> Registrar Cuenta';
    document.getElementById('btn_submit_banco').innerHTML = '<i class="fa-solid fa-save"></i> Guardar Cuenta';
    
    document.getElementById('modalBanco').classList.add('show');
}

function editarBanco(codBanco) {
    // Mostrar loading
    Swal.fire({ 
        title: 'Cargando...', 
        didOpen: () => { Swal.showLoading(); }, 
        background: '#1a1f2e', 
        color: 'white' 
    });
    
    // Obtener datos del banco
    $.ajax({
        url: 'get_banco_ajax.php',
        type: 'POST',
        data: { cod_banco_cuenta: codBanco },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (response.success) {
                const banco = response.banco;
                
                // Llenar formulario con datos
                document.getElementById('cod_banco_cuenta_edit').value = banco.cod_banco_cuenta;
                document.getElementById('accion_banco').value = 'editar';
                document.querySelector('select[name="nombre_banco_cuenta"]').value = banco.nombre_banco_cuenta;
                document.querySelector('select[name="nombre_tipo_cuenta"]').value = banco.nombre_tipo_cuenta_banco || banco.nombre_tipo_cuenta;
                document.querySelector('input[name="numero_banco_cuenta"]').value = banco.numero_banco_cuenta;
                document.querySelector('input[name="nombre_titular_cuenta"]').value = banco.nombre_titular_cuenta || '';
                
                // Actualizar título y botón
                document.querySelector('#modalBanco .modal-header h2').innerHTML = '<i class="fa-solid fa-edit"></i> Editar Cuenta';
                document.getElementById('btn_submit_banco').innerHTML = '<i class="fa-solid fa-save"></i> Actualizar Cuenta';
                
                // Mostrar modal
                document.getElementById('modalBanco').classList.add('show');
            } else {
                Swal.fire({ 
                    icon: 'error', 
                    title: 'Error', 
                    text: response.message || 'No se pudieron obtener los datos', 
                    background: '#1a1f2e', 
                    color: 'white' 
                });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'Error de conexión', 
                background: '#1a1f2e', 
                color: 'white' 
            });
        }
    });
}

function cerrarModalBanco() {
    document.getElementById('modalBanco').classList.remove('show');
}

// Cerrar modal al hacer clic fuera
document.getElementById('modalBanco').addEventListener('click', function(e) { if (e.target === this) { cerrarModalBanco(); } });

document.getElementById('formRegistroBanco').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    
    var accion = document.getElementById('accion_banco').value;
    var titulo = accion === 'editar' ? 'Actualizando...' : 'Guardando...';
    var mensajeExito = accion === 'editar' ? 'Cuenta actualizada correctamente' : 'Cuenta bancaria registrada correctamente';
    var url = accion === 'editar' ? 'edit_banco_ajax.php' : 'reg_banco_modal_asesor_movil_ajax.php';

    Swal.fire({ title: titulo, didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white' });

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({ 
                    icon: 'success', 
                    title: '¡Guardado!', 
                    text: mensajeExito, 
                    timer: 1500, 
                    showConfirmButton: false, 
                    background: '#1a1f2e', 
                    color: 'white' 
                }).then(() => {
                    location.reload(); 
                });
            } else {
                Swal.fire({ 
                    icon: 'error', 
                    title: 'Error', 
                    text: response.message, 
                    background: '#1a1f2e', 
                    color: 'white' 
                });
            }
        },
        error: function() {
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'Error de conexión', 
                background: '#1a1f2e', 
                color: 'white' 
            });
        }
    });
});
</script>

<!-- Modal Registro Crédito -->
<div class="modal-overlay" id="modalCredito">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-credit-card"></i> Registrar Crédito</h2>
            <button class="modal-close" onclick="cerrarModalCredito()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="formRegistroCredito">
                <input type="hidden" name="cod_aliado" value="<?php echo $cod_aliado; ?>">

                <div class="form-group">
                    <label class="form-label">Valor del Crédito *</label>
                    <input type="number" class="form-input" name="valor_credito" required placeholder="Ej: 500000" min="1">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Fecha del Crédito *</label>
                        <input type="date" class="form-input" name="fecha_credito" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fecha de Vencimiento</label>
                        <input type="date" class="form-input" name="fecha_vencimiento">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Estado *</label>
                    <select class="form-select" name="estado_credito" required>
                        <option value="1">Activo</option>
                        <option value="2">Pagado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Descripción / Concepto</label>
                    <textarea class="form-input" name="descripcion_credito" rows="3" placeholder="Descripción del crédito..."></textarea>
                </div>

                <button type="submit" class="submit-btn"><i class="fa-solid fa-save"></i> Registrar Crédito</button>
            </form>
        </div>
    </div>
</div>

<script>
function abrirModalCredito() {
    document.getElementById('modalCredito').classList.add('show');
}
function cerrarModalCredito() {
    document.getElementById('modalCredito').classList.remove('show');
}

// Cerrar modal al hacer clic fuera
document.getElementById('modalCredito').addEventListener('click', function(e) { 
    if (e.target === this) { cerrarModalCredito(); } 
});

document.getElementById('formRegistroCredito').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    Swal.fire({ 
        title: 'Registrando crédito...', 
        didOpen: () => { Swal.showLoading(); }, 
        background: '#1a1f2e', 
        color: 'white' 
    });

    $.ajax({
        url: 'reg_credito_aliado_ajax.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({ 
                    icon: 'success', 
                    title: '¡Registrado!', 
                    text: 'Crédito registrado correctamente', 
                    timer: 1500, 
                    showConfirmButton: false, 
                    background: '#1a1f2e', 
                    color: 'white' 
                }).then(() => {
                    location.reload(); 
                });
            } else {
                Swal.fire({ 
                    icon: 'error', 
                    title: 'Error', 
                    text: response.message, 
                    background: '#1a1f2e', 
                    color: 'white' 
                });
            }
        },
        error: function() {
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'Error de conexión', 
                background: '#1a1f2e', 
                color: 'white' 
            });
        }
    });
});
</script>

<!-- Modal Registro Tienda -->
<div class="modal-overlay" id="modalRegistro" style="align-items: flex-start; padding-top: 20px;">
    <div class="modal-content">
        <div class="modal-header"><h2><i class="fa-solid fa-store"></i> Nueva Tienda</h2><button class="modal-close" onclick="cerrarModalTienda()"><i class="fa-solid fa-times"></i></button></div>
        
        <div class="modal-body">
            <form id="formRegistroTienda" enctype="multipart/form-data">
                <input type="hidden" id="accion" name="accion" value="registrar">
                <input type="hidden" id="cod_tienda_edit" name="cod_tienda_edit" value="">
                <!-- Sección 1: Información Básica -->
                <div class="form-section-title"><i class="fa-solid fa-info-circle"></i> Información Básica</div>
                <div class="form-group">
                    <label class="form-label">Aliado Estratégico</label>
                    <input type="hidden" name="cod_aliado_estrategico" value="<?php echo $cod_aliado; ?>">
                    <select class="form-select" id="cod_aliado_estrategico" disabled>
                        <option value="<?php echo $row['cod_administrador']; ?>" data-comision="<?php echo $row['comision_ptj']; ?>" selected>
                            <?php echo !empty($row['nombres_apellidos_tercero']) ? $row['nombres_apellidos_tercero'] : ($row['nombres'] . ' ' . $row['apellidos']); ?>
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre de la Tienda *</label>
                    <input type="text" class="form-input" name="nombre1_tercero" id="nombre1_tercero" placeholder="Ej: Tienda El Éxito" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">NIT / Documento *</label>
                        <input type="number" class="form-input" name="identificacion_tercero" id="identificacion_tercero" required>
                    </div>
                     <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" name="telefono1_tercero" id="telefono1_tercero" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" class="form-input" name="correo_tercero" id="correo_tercero" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Dirección</label>
                    <input type="text" class="form-input" name="direccion_tercero" id="direccion_tercero">
                </div>


                <!-- Sección 2: Representante Legal -->
                <div class="form-section-title"><i class="fa-solid fa-user-tie"></i> Representante Legal</div>
                
                <div class="form-group">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" class="form-input" name="nombre_representante" id="nombre_representante">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Documento</label>
                        <input type="number" class="form-input" name="documento_representante" id="documento_representante">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-input" name="correo_representante" id="correo_representante">
                    </div>
                </div>

                <!-- Sección 3: Información Financiera -->
                <div class="form-section-title"><i class="fa-solid fa-dollar-sign"></i> Información Financiera</div>
                
                <div class="form-group">
                    <label class="form-label">Banco</label>
                    <select class="form-select" name="cod_banco_cuenta" id="cod_banco_cuenta" disabled><option value="">Seleccione Aliado primero</option></select>
                    <div id="loading_bancos" style="display:none; color: #10b981; font-size: 0.8rem; margin-top: 5px;">Cargando bancos...</div>
                </div>

                <!-- Sección 4: Ubicación GPS (DESHABILITADA) -->
                <!--
                <div class="form-section-title"><i class="fa-solid fa-map-marker-alt"></i> Ubicación GPS</div>
                
                <div class="form-group">
                    <button type="button" class="gps-btn" onclick="obtenerUbicacion()">
                        <i class="fa-solid fa-location-crosshairs"></i> Obtener Ubicación Actual
                    </button>
                    <div id="gpsStatus" class="gps-status"></div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Coordenadas</label>
                    <input type="text" class="form-input" name="ubicacion_gps_tienda" id="ubicacion_gps_tienda" readonly placeholder="Latitud, Longitud">
                </div>
                -->

                <!-- Sección 5: Documentación Legal -->
                <div class="form-section-title"><i class="fa-solid fa-file-contract"></i> Documentación Legal</div>
                
                <div class="form-group">
                    <label class="form-label">RUT (PDF/Imagen)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="url_rut_tienda" id="url_rut_tienda" accept=".pdf,.jpg,.jpeg,.png" onchange="updateFileName(this)">
                        <div class="file-input-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="file-input-text">Seleccionar archivo</div>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="form-label">Cámara de Comercio (PDF/Imagen)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="url_camara_comercio_tienda" id="url_camara_comercio_tienda" accept=".pdf,.jpg,.jpeg,.png" onchange="updateFileName(this)">
                        <div class="file-input-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="file-input-text">Seleccionar archivo</div>
                    </div>
                </div>

                <!-- Sección 6: Imágenes del Establecimiento -->
                <div class="form-section-title"><i class="fa-solid fa-camera"></i> Imágenes del Establecimiento</div>

                 <div class="form-group">
                    <label class="form-label">Logo de la Tienda</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="imagen_tienda" id="imagen_tienda" accept="image/*" onchange="previewImage(this, 'preview_logo')">
                        <div class="file-input-icon"><i class="fa-solid fa-image"></i></div>
                        <div class="file-input-text">Seleccionar imagen</div>
                    </div>
                    <img id="preview_logo" class="image-preview" alt="Vista previa logo">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Fachada</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="url_img_fachada_tienda" id="url_img_fachada_tienda" accept="image/*" onchange="previewImage(this, 'preview_fachada')">
                            <div class="file-input-icon"><i class="fa-solid fa-store"></i></div>
                        </div>
                         <img id="preview_fachada" class="image-preview" alt="Vista previa">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Interna</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="url_img_interna_tienda" id="url_img_interna_tienda" accept="image/*" onchange="previewImage(this, 'preview_interna')">
                            <div class="file-input-icon"><i class="fa-solid fa-person-shelter"></i></div>
                        </div>
                        <img id="preview_interna" class="image-preview" alt="Vista previa">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Selfie con Admin</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="url_img_selfieadmin_tienda" id="url_img_selfieadmin_tienda" accept="image/*" onchange="previewImage(this, 'preview_selfie')">
                        <div class="file-input-icon"><i class="fa-solid fa-camera-retro"></i></div>
                        <div class="file-input-text">Seleccionar selfie</div>
                    </div>
                    <img id="preview_selfie" class="image-preview" alt="Vista previa selfie">
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-save"></i> Registrar Tienda Completa
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Firma Electrónica -->
<div class="modal-overlay" id="modalFirmaElectronica">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-signature"></i> Firma Electrónica</h2>
            <button class="modal-close" onclick="cerrarModalFirmaYRecargar()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="firma_cod_tienda" value="">
            <input type="hidden" id="firma_nombre_tienda" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(5,150,105,0.2)); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                    <i class="fa-solid fa-check-circle" style="font-size: 2.5rem; color: #10b981;"></i>
                    <h3 style="color: #10b981; margin: 0.5rem 0;">¡Tienda Registrada!</h3>
                    <p style="color: rgba(255,255,255,0.7); margin: 0;" id="firma_tienda_nombre_display"></p>
                </div>
                <p style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Ahora comparta el enlace de firma con su cliente para completar el proceso.</p>
            </div>
            
            <div class="form-group">
                <label class="form-label">Correo del Cliente</label>
                <input type="email" class="form-input" id="firma_correo" placeholder="correo@ejemplo.com">
            </div>
            
            <div class="form-group">
                <label class="form-label">Teléfono del Cliente</label>
                <input type="tel" class="form-input" id="firma_telefono" placeholder="3001234567">
            </div>
            
            <!-- Sección Firma Electrónica -->
            <div style="background: rgba(102, 126, 234, 0.1); border: 1px solid rgba(102, 126, 234, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                <h4 style="color: #667eea; margin: 0 0 0.75rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-signature"></i> Firma Electrónica
                </h4>
                <div class="form-group" style="margin-bottom: 0.75rem;">
                    <label class="form-label" style="font-size: 0.8rem;">Enlace de Firma</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" class="form-input" id="firma_enlace" readonly style="flex: 1; font-size: 0.85rem;">
                        <button type="button" onclick="copiarEnlaceFirma()" style="background: #10b981; color: white; border: none; padding: 0.75rem 0.9rem; border-radius: 12px; cursor: pointer;">
                            <i class="fa-solid fa-copy"></i>
                        </button>
                    </div>
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    <button type="button" onclick="enviarFirmaPorWhatsApp()" style="flex: 1; background: #25d366; color: white; border: none; padding: 0.75rem; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </button>
                    <button type="button" onclick="enviarFirmaPorCorreo()" style="flex: 1; background: #3b82f6; color: white; border: none; padding: 0.75rem; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                        <i class="fa-solid fa-envelope"></i> Email
                    </button>
                </div>
            </div>

            <!-- Sección Ubicación GPS -->
            <div style="background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                <h4 style="color: #fbbf24; margin: 0 0 0.75rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-map-marker-alt"></i> Ubicación GPS
                </h4>
                <div class="form-group" style="margin-bottom: 0.75rem;">
                    <label class="form-label" style="font-size: 0.8rem;">Enlace de Ubicación GPS</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" class="form-input" id="gps_enlace" readonly style="flex: 1; font-size: 0.85rem;">
                        <button type="button" onclick="copiarEnlaceGPS()" style="background: #10b981; color: white; border: none; padding: 0.75rem 0.9rem; border-radius: 12px; cursor: pointer;">
                            <i class="fa-solid fa-copy"></i>
                        </button>
                    </div>
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    <button type="button" onclick="enviarGPSPorWhatsApp()" style="flex: 1; background: #25d366; color: white; border: none; padding: 0.75rem; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </button>
                    <button type="button" onclick="enviarGPSPorCorreo()" style="flex: 1; background: #3b82f6; color: white; border: none; padding: 0.75rem; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                        <i class="fa-solid fa-envelope"></i> Email
                    </button>
                </div>
            </div>
            
            <button type="button" onclick="cerrarModalFirmaYRecargar()" class="submit-btn" style="margin-top: 1rem; background: rgba(255,255,255,0.1);">
                <i class="fa-solid fa-check"></i> Finalizar y Cerrar
            </button>
        </div>
    </div>
</div>

<script>
function abrirModalRegistroTienda() {
    const form = document.getElementById('formRegistroTienda');
    form.reset();
    
    // Configurar campos para "Nuevo Registro"
    document.getElementById('accion').value = 'registrar';
    document.getElementById('cod_tienda_edit').value = '';
    
    // Restablecer título y botón
    document.querySelector('#modalRegistro .modal-header h2').innerHTML = '<i class="fa-solid fa-store"></i> Nueva Tienda';
    document.querySelector('#formRegistroTienda .submit-btn').innerHTML = '<i class="fa-solid fa-save"></i> Registrar Tienda Completa';
    document.querySelector('#formRegistroTienda .submit-btn').style.display = 'block';

    // Habilitar todos los inputs excepto el de aliado que siempre es fijo aquí
    Array.from(form.elements).forEach(ele => {
        if (ele.id !== 'cod_aliado_estrategico') { ele.disabled = false; }
    });

    // Como tenemos el aliado fijo en hidden, forzamos la actualización de bancos
    // El select visual está disabled, así que tomamos el valor del hidden
    const codAliadoVal = document.querySelector('input[name="cod_aliado_estrategico"]').value;
    
    // Llamar a actualizar bancos manualmente ya que el 'onchange' no se disparará
    actualizarBancosYComisionManual(codAliadoVal);
    
    // Limpiar previsualizaciones
    document.querySelectorAll('.image-preview').forEach(el => { el.src = ''; el.style.display = 'none'; });
    // document.getElementById('gpsStatus').style.display = 'none'; // GPS deshabilitado
    
    document.getElementById('modalRegistro').classList.add('show');
}

function cerrarModalTienda() {
    document.getElementById('modalRegistro').classList.remove('show');
}

// Cerrar modal al hacer clic fuera
document.getElementById('modalRegistro').addEventListener('click', function(e) { if (e.target === this) { cerrarModalTienda(); } });

// Versión modificada para tomar el valor directamente
function actualizarBancosYComisionManual(codAliado) {
    // Cargar bancos
    var bancoSelect = document.getElementById('cod_banco_cuenta');
    var loading = document.getElementById('loading_bancos');
    
    if (codAliado) {
        bancoSelect.disabled = true;
        loading.style.display = 'block';
        
        $.ajax({
            url: 'obtener_bancos_cuenta_por_aliado_ajax.php',
            type: 'POST',
            data: { cod_aliado_estrategico: codAliado },
            dataType: 'json',
            success: function(response) {
                bancoSelect.innerHTML = '';
                
                if (response.success && response.bancos.length > 0) {
                    bancoSelect.innerHTML = '<option value="">-- Seleccione un banco --</option>';
                    response.bancos.forEach(function(banco) {
                        var textoOpcion = banco.nombre_banco_cuenta + ' - ' + banco.numero_banco_cuenta;
                        if (banco.nombre_titular_cuenta) { textoOpcion += ' (' + banco.nombre_titular_cuenta + ')'; }
                        bancoSelect.innerHTML += '<option value="' + banco.cod_banco_cuenta + '">' + textoOpcion + '</option>';
                    });
                } else {
                    bancoSelect.innerHTML = '<option value="">-- No hay bancos registrados --</option>';
                }
                // Comisión deshabilitada
                bancoSelect.disabled = false;
                loading.style.display = 'none';
            },
            error: function() {
                loading.style.display = 'none';
                bancoSelect.innerHTML = '<option value="">-- Error al cargar bancos --</option>';
                bancoSelect.disabled = false;
            }
        });
    } else {
        bancoSelect.innerHTML = '<option value="">Seleccione Aliado primero</option>';
        bancoSelect.disabled = true;
    }
}

// Mantener función original para compatibilidad si algo la llama, re-enrutando
function actualizarBancosYComision(select) {
    actualizarBancosYComisionManual(select.value);
}

// Obtener ubicación GPS
function obtenerUbicacion() {
    var status = document.getElementById('gpsStatus');
    var input = document.getElementById('ubicacion_gps_tienda');
    
    status.style.display = 'block';
    status.style.background = 'rgba(0, 212, 255, 0.2)';
    status.style.color = '#00d4ff';
    status.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Obteniendo ubicación...';
    
    if (!navigator.geolocation) { status.style.background = 'rgba(239, 68, 68, 0.2)'; status.style.color = '#ef4444'; status.innerHTML = 'Tu navegador no soporta geolocalización'; return; }
    navigator.geolocation.getCurrentPosition(
        function(position) {
            var lat = position.coords.latitude.toFixed(6);
            var lng = position.coords.longitude.toFixed(6);
            input.value = lat + ',' + lng;
            
            status.style.background = 'rgba(16, 185, 129, 0.2)';
            status.style.color = '#10b981';
            status.innerHTML = '<i class="fa fa-check"></i> Ubicación obtenida: ' + lat + ', ' + lng;
        },
        function(error) {
            status.style.background = 'rgba(239, 68, 68, 0.2)';
            status.style.color = '#ef4444';
            status.innerHTML = 'Error al obtener ubicación. Asegúrate de tener el GPS activado.';
        },
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
    );
}

// Previsualizar imagen
function previewImage(input, previewId) {
    var preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}

function updateFileName(input) {
    if (input.files && input.files.length > 0) {
        var fileName = input.files[0].name;
        var wrapper = input.parentElement;
        var textElement = wrapper.querySelector('.file-input-text');
        if (textElement) {
            textElement.textContent = fileName;
            textElement.style.color = '#10b981';
            textElement.style.fontWeight = 'bold';
        }
    }
}

// Envío del formulario
document.getElementById('formRegistroTienda').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    formData.append('cod_administrador', '<?php echo $cod_administrador; ?>');
    
    Swal.fire({ title: 'Registrando...', text: 'Procesando información', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white' });
    $.ajax({
        url: '../admin/reg_tienda_modal_asesor_movil_ajax_reg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                cerrarModalTienda();
                // Abrir modal de firma electrónica
                abrirModalFirma(response.cod_tienda_codifcryp, response.nombre_tienda, response.correo_tercero || '', response.telefono1_tercero || '');
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo procesar', confirmButtonColor: '#10b981', background: '#1a1f2e', color: 'white' });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX:', xhr.responseText);
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'Hubo un problema al enviar los datos. Intenta nuevamente.', confirmButtonColor: '#10b981', background: '#1a1f2e', color: 'white' });
        }
    });
});

// FUNCIONES PARA MODAL DE FIRMA ELECTRÓNICA Y GPS
function abrirModalFirma(codTiendaCryp, nombreTienda, correo, telefono) {
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    
    // Enlace de firma
    var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(codTiendaCryp);
    
    // Enlace de GPS
    var enlaceGPS = window.location.origin + basePath + 'gps_tienda.php?cod=' + encodeURIComponent(codTiendaCryp);
    
    document.getElementById('firma_cod_tienda').value = codTiendaCryp;
    document.getElementById('firma_nombre_tienda').value = nombreTienda;
    document.getElementById('firma_correo').value = correo || '';
    document.getElementById('firma_telefono').value = telefono || '';
    document.getElementById('firma_enlace').value = enlaceFirma;
    document.getElementById('gps_enlace').value = enlaceGPS;
    document.getElementById('firma_tienda_nombre_display').textContent = nombreTienda;
    document.getElementById('modalFirmaElectronica').classList.add('show');
}
function cerrarModalFirma() { document.getElementById('modalFirmaElectronica').classList.remove('show'); }
function cerrarModalFirmaYRecargar() { cerrarModalFirma(); location.reload(); }

// ========== FUNCIONES PARA FIRMA ELECTRÓNICA ==========
function copiarEnlaceFirma() {
    var enlace = document.getElementById('firma_enlace').value;
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(enlace).then(function() {
            Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'Enlace de firma copiado', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
        });
    } else {
        var tempInput = document.createElement('input');
        tempInput.value = enlace;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'Enlace de firma copiado', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
    }
}

function enviarFirmaPorWhatsApp() {
    var telefono = document.getElementById('firma_telefono').value;
    var nombreTienda = document.getElementById('firma_nombre_tienda').value;
    var enlace = document.getElementById('firma_enlace').value;
    var telefonoFormateado = telefono.replace(/[\s\-\(\)\.]/g, '');
    if (!telefonoFormateado.startsWith('+') && !telefonoFormateado.startsWith('57')) { telefonoFormateado = '57' + telefonoFormateado; }
    var mensaje = encodeURIComponent('Hola! Su tienda *' + nombreTienda + '* ha sido registrada.\n\n📝 *FIRMA ELECTRÓNICA*\nPor favor firme el documento aquí: ' + enlace);
    if (telefonoFormateado && telefonoFormateado.length >= 10) { window.open('https://wa.me/' + telefonoFormateado + '?text=' + mensaje, '_blank'); } else { window.open('https://wa.me/?text=' + mensaje, '_blank'); }
}

function enviarFirmaPorCorreo() {
    var correo = document.getElementById('firma_correo').value;
    var nombreTienda = document.getElementById('firma_nombre_tienda').value;
    var enlace = document.getElementById('firma_enlace').value;
    var asunto = encodeURIComponent('Firma Electrónica - ' + nombreTienda);
    var cuerpo = encodeURIComponent('Hola,\n\nSu tienda ' + nombreTienda + ' ha sido registrada.\n\nPor favor firme el documento accediendo al siguiente enlace:\n' + enlace + '\n\nGracias.');
    if (correo && correo !== '') { window.location.href = 'mailto:' + correo + '?subject=' + asunto + '&body=' + cuerpo; } else { window.location.href = 'mailto:?subject=' + asunto + '&body=' + cuerpo; }
}

// ========== FUNCIONES PARA UBICACIÓN GPS ==========
function copiarEnlaceGPS() {
    var enlace = document.getElementById('gps_enlace').value;
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(enlace).then(function() {
            Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'Enlace de GPS copiado', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
        });
    } else {
        var tempInput = document.createElement('input');
        tempInput.value = enlace;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'Enlace de GPS copiado', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
    }
}

function enviarGPSPorWhatsApp() {
    var telefono = document.getElementById('firma_telefono').value;
    var nombreTienda = document.getElementById('firma_nombre_tienda').value;
    var enlace = document.getElementById('gps_enlace').value;
    var telefonoFormateado = telefono.replace(/[\s\-\(\)\.]/g, '');
    if (!telefonoFormateado.startsWith('+') && !telefonoFormateado.startsWith('57')) { telefonoFormateado = '57' + telefonoFormateado; }
    var mensaje = encodeURIComponent('Hola! Su tienda *' + nombreTienda + '* ha sido registrada.\n\n📍 *UBICACIÓN GPS*\nPor favor comparta la ubicación de su tienda aquí: ' + enlace);
    if (telefonoFormateado && telefonoFormateado.length >= 10) { window.open('https://wa.me/' + telefonoFormateado + '?text=' + mensaje, '_blank'); } else { window.open('https://wa.me/?text=' + mensaje, '_blank'); }
}

function enviarGPSPorCorreo() {
    var correo = document.getElementById('firma_correo').value;
    var nombreTienda = document.getElementById('firma_nombre_tienda').value;
    var enlace = document.getElementById('gps_enlace').value;
    var asunto = encodeURIComponent('Ubicación GPS - ' + nombreTienda);
    var cuerpo = encodeURIComponent('Hola,\n\nSu tienda ' + nombreTienda + ' ha sido registrada.\n\nPor favor comparta la ubicación GPS de su tienda accediendo al siguiente enlace:\n' + enlace + '\n\nGracias.');
    if (correo && correo !== '') { window.location.href = 'mailto:' + correo + '?subject=' + asunto + '&body=' + cuerpo; } else { window.location.href = 'mailto:?subject=' + asunto + '&body=' + cuerpo; }
}
function enviarPorCorreo() {
    var correo = document.getElementById('firma_correo').value;
    var nombreTienda = document.getElementById('firma_nombre_tienda').value;
    var enlace = document.getElementById('firma_enlace').value;
    var asunto = encodeURIComponent('Firma Electrónica - ' + nombreTienda);
    var cuerpo = encodeURIComponent('Hola, su tienda ha sido registrada. Firme aquí: ' + enlace);
    if (correo && correo !== '') { window.location.href = 'mailto:' + correo + '?subject=' + asunto + '&body=' + cuerpo; } else { window.location.href = 'mailto:?subject=' + asunto + '&body=' + cuerpo; }
}
</script>

<!-- Modal Agregar Entidad Crediticia -->
<div class="modal-overlay" id="modalAgregarEntidad">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-plus"></i> Agregar Entidad</h2>
            <button class="modal-close" onclick="cerrarModalAgregarEntidad()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="formAgregarEntidad">
                <input type="hidden" name="cod_aliado_estrategico" value="<?php echo $cod_aliado; ?>">
                <input type="hidden" name="accion" value="agregar">

                <div class="form-group">
                    <label class="form-label">Entidad Crediticia *</label>
                    <select class="form-select" name="cod_entidad_crediticia" id="agregar_cod_entidad" required>
                        <option value="">Seleccione...</option>
                        <?php
                        // Cargar entidades crediticias activas que NO están asignadas al aliado
                        $sql_all_entidades = "SELECT ec.cod_entidad_crediticia, ec.nombre_entidad_crediticia 
                        FROM tbl15_entidad_crediticia ec WHERE ec.cod_estado = '1' AND ec.cod_entidad_crediticia NOT IN (SELECT peca.cod_entidad_crediticia 
                        FROM tbl15_parametrizacion_entidad_crediticia_aliado peca WHERE peca.cod_aliado_estrategico = '$cod_aliado' AND peca.cod_estado = '1') ORDER BY ec.cod_posicion ASC";
                        $res_all_entidades = mysqli_query($conectar, $sql_all_entidades);
                        if ($res_all_entidades) {
                            while($ent = mysqli_fetch_assoc($res_all_entidades)) {
                                echo '<option value="'.$ent['cod_entidad_crediticia'].'">'.$ent['nombre_entidad_crediticia'].'</option>';
                            }
                        }
                        ?>
                    </select>
                    <small style="color: rgba(255,255,255,0.5); font-size: 0.75rem; margin-top: 0.25rem; display: block;">
                        Solo se muestran las entidades no asignadas
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label">Interés (%) *</label>
                    <input type="number" step="0.01" min="0" max="100" class="form-input" name="interes_ptj" id="agregar_interes_ptj" required placeholder="0.00">
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" id="agregar_cod_estado_activar_portal" name="cod_estado_activar_portal" value="1" style="width: auto; height: 18px; cursor: pointer;">
                    <label class="form-label" for="agregar_cod_estado_activar_portal" style="margin: 0; cursor: pointer;">Activar Portal</label>
                </div>

                <div class="form-group" id="agregar_grupo_url_portal" style="display: none;">
                    <label class="form-label">Url Portal</label>
                    <input type="url" class="form-input" name="url_pagina_web_consulta" id="agregar_url_pagina_web_consulta" placeholder="https://ejemplo.com">
                </div>

                <button type="submit" class="submit-btn"><i class="fa-solid fa-save"></i> Guardar Entidad</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Entidad Crediticia -->
<div class="modal-overlay" id="modalEditarEntidad">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-edit"></i> Editar Entidad</h2>
            <button class="modal-close" onclick="cerrarModalEditarEntidad()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="formEditarEntidad">
                <input type="hidden" name="cod_parametrizacion" id="editar_cod_parametrizacion">
                <input type="hidden" name="cod_aliado_estrategico" value="<?php echo $cod_aliado; ?>">
                <input type="hidden" name="cod_entidad_crediticia" id="editar_cod_entidad">
                <input type="hidden" name="accion" value="editar">

                <div class="form-group">
                    <label class="form-label">Entidad Crediticia</label>
                    <input type="text" class="form-input" id="editar_nombre_entidad" readonly style="background: rgba(255,255,255,0.05); cursor: not-allowed; color: rgba(255,255,255,0.8);">
                </div>

                <div class="form-group">
                    <label class="form-label">Interés (%) *</label>
                    <input type="number" step="0.01" min="0" max="100" class="form-input" name="interes_ptj" id="editar_interes_ptj" required placeholder="0.00">
                </div>

                <div class="form-group">
                    <label class="form-label">Estado *</label>
                    <select class="form-select" name="cod_estado" id="editar_cod_estado" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <div class="form-group">
                    <div style="display: flex; align-items: center; gap: 0.75rem; background: rgba(16, 185, 129, 0.1); padding: 0.85rem 1rem; border-radius: 12px; border: 1px solid rgba(16, 185, 129, 0.3);">
                        <input type="checkbox" name="cod_estado_activar_portal" id="editar_cod_estado_activar_portal" value="1" onchange="toggleUrlPortal(this)" style="width: 20px; height: 20px; cursor: pointer; accent-color: #10b981;">
                        <label for="editar_cod_estado_activar_portal" style="cursor: pointer; color: white; font-weight: 600; margin: 0;">
                            <i class="fa-solid fa-globe" style="margin-right: 0.5rem; color: #10b981;"></i>Activar Portal
                        </label>
                    </div>
                </div>

                <div class="form-group" id="grupo_url_portal" style="display: none;">
                    <label class="form-label">Url Portal</label>
                    <input type="url" class="form-input" name="url_pagina_web_consulta" id="editar_url_pagina_web_consulta" placeholder="https://ejemplo.com/portal" disabled>
                    <small style="color: rgba(255,255,255,0.5); font-size: 0.75rem; margin-top: 0.25rem; display: block;">
                        URL del portal de consulta de la entidad
                    </small>
                </div>

                <button type="submit" class="submit-btn"><i class="fa-solid fa-save"></i> Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>

<script>
// ========== Funciones para Modal AGREGAR Entidad ==========
function abrirModalEntidad() {
    document.getElementById('formAgregarEntidad').reset();
    // Ocultar el campo de URL al abrir el modal
    document.getElementById('agregar_grupo_url_portal').style.display = 'none';
    document.getElementById('modalAgregarEntidad').classList.add('show');
}

function cerrarModalAgregarEntidad() {
    document.getElementById('modalAgregarEntidad').classList.remove('show');
}

// Control del checkbox "Activar Portal" para mostrar/ocultar campo URL
document.getElementById('agregar_cod_estado_activar_portal').addEventListener('change', function() {
    const grupoUrlPortal = document.getElementById('agregar_grupo_url_portal');
    const inputUrl = document.getElementById('agregar_url_pagina_web_consulta');
    
    if (this.checked) {
        grupoUrlPortal.style.display = 'block';
    } else {
        grupoUrlPortal.style.display = 'none';
        inputUrl.value = ''; // Limpiar el valor del input cuando se desactiva
    }
});

// Cerrar modal al hacer clic fuera
document.getElementById('modalAgregarEntidad').addEventListener('click', function(e) { 
    if (e.target === this) { cerrarModalAgregarEntidad(); } 
});

// Submit del formulario agregar
document.getElementById('formAgregarEntidad').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    Swal.fire({ title: 'Guardando...', didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white' });

    $.ajax({
        url: 'gestionar_entidad_aliado_ajax.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                cerrarModalAgregarEntidad();
                Swal.fire({ 
                    icon: 'success', 
                    title: '¡Guardado!', 
                    text: 'Entidad agregada correctamente', 
                    timer: 1500, 
                    showConfirmButton: false, 
                    background: '#1a1f2e', 
                    color: 'white' 
                }).then(() => { location.reload(); });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'Error al guardar', background: '#1a1f2e', color: 'white' });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión', background: '#1a1f2e', color: 'white' });
        }
    });
});

// ========== Funciones para Modal EDITAR Entidad ==========
function editarEntidad(data) {
    document.getElementById('editar_cod_parametrizacion').value = data.cod_parametrizacion;
    document.getElementById('editar_cod_entidad').value = data.cod_entidad_crediticia;
    document.getElementById('editar_nombre_entidad').value = data.nombre_entidad_crediticia || 'Entidad #' + data.cod_entidad_crediticia;
    document.getElementById('editar_interes_ptj').value = data.interes_ptj || '';
    document.getElementById('editar_cod_estado').value = data.cod_estado || '1';
    
    // Cargar valores de Activar Portal y Url Portal
    var activarPortalCheckbox = document.getElementById('editar_cod_estado_activar_portal');
    var urlPortalInput = document.getElementById('editar_url_pagina_web_consulta');
    var grupoUrlPortal = document.getElementById('grupo_url_portal');
    
    // Verificar si el portal está activado (valor 1 o '1')
    var portalActivo = (data.cod_estado_activar_portal == '1' || data.cod_estado_activar_portal == 1);
    activarPortalCheckbox.checked = portalActivo;
    
    // Cargar URL si existe
    urlPortalInput.value = data.url_pagina_web_consulta || '';
    
    // Mostrar/ocultar y habilitar/deshabilitar el campo URL según el checkbox
    if (portalActivo) {
        grupoUrlPortal.style.display = 'block';
        urlPortalInput.disabled = false;
    } else {
        grupoUrlPortal.style.display = 'none';
        urlPortalInput.disabled = true;
    }
    
    document.getElementById('modalEditarEntidad').classList.add('show');
}

// Función para toggle del campo URL Portal
function toggleUrlPortal(checkbox) {
    var grupoUrlPortal = document.getElementById('grupo_url_portal');
    var urlPortalInput = document.getElementById('editar_url_pagina_web_consulta');
    
    if (checkbox.checked) {
        grupoUrlPortal.style.display = 'block';
        urlPortalInput.disabled = false;
        urlPortalInput.focus();
    } else {
        grupoUrlPortal.style.display = 'none';
        urlPortalInput.disabled = true;
        urlPortalInput.value = '';
    }
}

function cerrarModalEditarEntidad() {
    document.getElementById('modalEditarEntidad').classList.remove('show');
}

// Cerrar modal al hacer clic fuera
document.getElementById('modalEditarEntidad').addEventListener('click', function(e) { 
    if (e.target === this) { cerrarModalEditarEntidad(); } 
});

// Submit del formulario editar
document.getElementById('formEditarEntidad').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    Swal.fire({ title: 'Actualizando...', didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white' });

    $.ajax({
        url: 'gestionar_entidad_aliado_ajax.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                cerrarModalEditarEntidad();
                Swal.fire({ 
                    icon: 'success', 
                    title: '¡Actualizado!', 
                    text: 'Entidad actualizada correctamente', 
                    timer: 1500, 
                    showConfirmButton: false, 
                    background: '#1a1f2e', 
                    color: 'white' 
                }).then(() => { location.reload(); });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'Error al actualizar', background: '#1a1f2e', color: 'white' });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión', background: '#1a1f2e', color: 'white' });
        }
    });
});

// ========== Función para ELIMINAR Entidad ==========
function eliminarEntidad(codParametrizacion, nombreEntidad) {
    Swal.fire({
        title: '¿Eliminar entidad?',
        html: 'Se eliminará <strong>' + nombreEntidad + '</strong> de este aliado.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        background: '#1a1f2e',
        color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({ title: 'Eliminando...', didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white' });
            
            $.ajax({
                url: 'eliminar_entidad_aliado_ajax.php',
                type: 'POST',
                data: { cod_parametrizacion: codParametrizacion },
                dataType: 'json',
                success: function(response) {
                    Swal.close();
                    if (response.success) {
                        $('#entidad_' + codParametrizacion).fadeOut(300, function() { $(this).remove(); });
                        Swal.fire({ icon: 'success', title: '¡Eliminada!', text: 'Entidad eliminada correctamente', timer: 1500, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo eliminar', background: '#1a1f2e', color: 'white' });
                    }
                },
                error: function() {
                    Swal.close();
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión', background: '#1a1f2e', color: 'white' });
                }
            });
        }
    });
}

// Auto-abrir modal de tienda si se pasa el parámetro
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('abrir_modal_tienda') === '1') {
        setTimeout(function() {
            abrirModalRegistroTienda();
        }, 500);
    }
});
</script>

<!-- Modal Documentación Aliado -->
<div class="modal-overlay" id="modalDocumentacionAliado" style="z-index: 3000;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(124, 58, 237, 0.2));">
            <h2><i class="fa-solid fa-file-lines"></i> Documentación</h2>
            <button class="modal-close" onclick="cerrarModalDocumentacionAliado()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="doc_cod_aliado_cryp" value="">
            <input type="hidden" id="doc_telefono_aliado" value="">
            <input type="hidden" id="doc_correo_aliado" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h3 style="color: white; margin-bottom: 0.5rem;" id="doc_nombre_aliado"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Comparta el enlace para que el aliado suba su documentación legal.</p>
            </div>
            
            <!-- Estado de Documentos -->
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                <h4 style="color: rgba(255,255,255,0.8); font-size: 0.85rem; margin: 0 0 0.75rem 0;"><i class="fa-solid fa-folder-open" style="color: #8b5cf6;"></i> Estado de Documentos</h4>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <div id="doc_estado_rut" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: rgba(239, 68, 68, 0.1); border-radius: 8px;">
                        <i class="fa-solid fa-times-circle" style="color: #ef4444;"></i>
                        <span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">RUT: No cargado</span>
                    </div>
                    <div id="doc_estado_camara" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: rgba(239, 68, 68, 0.1); border-radius: 8px;">
                        <i class="fa-solid fa-times-circle" style="color: #ef4444;"></i>
                        <span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">Cámara de Comercio: No cargado</span>
                    </div>
                    <div id="doc_estado_cedula" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: rgba(239, 68, 68, 0.1); border-radius: 8px;">
                        <i class="fa-solid fa-times-circle" style="color: #ef4444;"></i>
                        <span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">Cédula: No cargado</span>
                    </div>
                </div>
            </div>
            
            <!-- Opciones de Compartir -->
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                <h4 style="color: #8b5cf6; margin: 0 0 1rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-share-nodes"></i> Compartir Enlace para Cargue
                </h4>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
                    <button onclick="compartirDocWhatsApp()" style="background: #25D366; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </button>
                    <button onclick="compartirDocEmail()" style="background: #EA4335; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por Email">
                        <i class="fa-solid fa-envelope"></i> Email
                    </button>
                    <button onclick="copiarEnlaceDoc()" style="background: #6366f1; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Copiar enlace">
                        <i class="fa-solid fa-copy"></i> Copiar
                    </button>
                </div>
            </div>
            
            <button onclick="cerrarModalDocumentacionAliado()" style="width: 100%; background: rgba(255,255,255,0.1); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600;">
                <i class="fa-solid fa-times"></i> Cerrar
            </button>
        </div>
    </div>
</div>

<!-- Modal Enviar Documentación por Email -->
<div class="modal-overlay" id="modalEnviarDocumentacionEmail" style="z-index: 4000;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header" style="background: linear-gradient(135deg, rgba(234, 67, 53, 0.2), rgba(219, 68, 55, 0.2));">
            <h2><i class="fa-solid fa-envelope"></i> Enviar por Email</h2>
            <button class="modal-close" onclick="cerrarModalEnviarDocumentacionEmail()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h3 style="color: white; margin-bottom: 0.5rem;" id="emaildoc_nombre_aliado"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Se enviará el enlace de documentación al siguiente correo electrónico:</p>
            </div>
            
            <!-- Campo de correo -->
            <div style="background: rgba(234, 67, 53, 0.1); border: 1px solid rgba(234, 67, 53, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                <label style="display: block; color: rgba(255,255,255,0.8); font-size: 0.85rem; margin-bottom: 0.5rem; font-weight: 600;">
                    <i class="fa-solid fa-at" style="color: #EA4335;"></i> Correo Electrónico
                </label>
                <input type="email" id="emaildoc_correo" readonly 
                    style="width: 100%; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; padding: 0.75rem; color: white; font-size: 0.9rem; cursor: not-allowed;">
            </div>
            
            <!-- Información -->
            <div style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 8px; padding: 0.75rem; margin-bottom: 1.5rem;">
                <div style="color: rgba(255,255,255,0.8); font-size: 0.8rem; line-height: 1.4;">
                    <i class="fa-solid fa-info-circle" style="color: #f59e0b; margin-right: 0.35rem;"></i>
                    El correo contendrá un enlace para que el aliado pueda cargar su documentación legal (RUT, Cámara de Comercio y Cédula).
                </div>
            </div>
            
            <!-- Botones -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                <button onclick="cerrarModalEnviarDocumentacionEmail()" style="background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.875rem; border-radius: 12px; cursor: pointer; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-times"></i> Cancelar
                </button>
                <button onclick="confirmarEnvioDocumentacionEmail()" style="background: linear-gradient(135deg, #EA4335 0%, #DB4437 100%); color: white; border: none; padding: 0.875rem; border-radius: 12px; cursor: pointer; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(234, 67, 53, 0.3);">
                    <i class="fa-solid fa-paper-plane"></i> Enviar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// ====================== FUNCIONES PARA MODAL DOCUMENTACIÓN ALIADO ======================
function abrirModalDocumentacionAliado(codAliadoCryp, nombreAliado, telefono, correo, urlRut, urlCamara, urlCedula) {
    document.getElementById('doc_cod_aliado_cryp').value = codAliadoCryp;
    document.getElementById('doc_nombre_aliado').textContent = nombreAliado;
    document.getElementById('doc_telefono_aliado').value = telefono || '';
    document.getElementById('doc_correo_aliado').value = correo || '';
    
    // Actualizar estado de RUT
    var estadoRut = document.getElementById('doc_estado_rut');
    if (urlRut && urlRut.trim() !== '') {
        estadoRut.style.background = 'rgba(16, 185, 129, 0.1)';
        estadoRut.innerHTML = '<i class="fa-solid fa-check-circle" style="color: #10b981;"></i><span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">RUT: Cargado</span><a href="' + urlRut + '" target="_blank" style="margin-left: auto; color: #8b5cf6; font-size: 0.8rem;"><i class="fa-solid fa-eye"></i></a>';
    } else {
        estadoRut.style.background = 'rgba(239, 68, 68, 0.1)';
        estadoRut.innerHTML = '<i class="fa-solid fa-times-circle" style="color: #ef4444;"></i><span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">RUT: No cargado</span>';
    }
    
    // Actualizar estado de Cámara de Comercio
    var estadoCamara = document.getElementById('doc_estado_camara');
    if (urlCamara && urlCamara.trim() !== '') {
        estadoCamara.style.background = 'rgba(16, 185, 129, 0.1)';
        estadoCamara.innerHTML = '<i class="fa-solid fa-check-circle" style="color: #10b981;"></i><span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">Cámara de Comercio: Cargado</span><a href="' + urlCamara + '" target="_blank" style="margin-left: auto; color: #8b5cf6; font-size: 0.8rem;"><i class="fa-solid fa-eye"></i></a>';
    } else {
        estadoCamara.style.background = 'rgba(239, 68, 68, 0.1)';
        estadoCamara.innerHTML = '<i class="fa-solid fa-times-circle" style="color: #ef4444;"></i><span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">Cámara de Comercio: No cargado</span>';
    }
    
    // Actualizar estado de Cédula
    var estadoCedula = document.getElementById('doc_estado_cedula');
    if (urlCedula && urlCedula.trim() !== '') {
        estadoCedula.style.background = 'rgba(16, 185, 129, 0.1)';
        estadoCedula.innerHTML = '<i class="fa-solid fa-check-circle" style="color: #10b981;"></i><span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">Cédula: Cargado</span><a href="' + urlCedula + '" target="_blank" style="margin-left: auto; color: #8b5cf6; font-size: 0.8rem;"><i class="fa-solid fa-eye"></i></a>';
    } else {
        estadoCedula.style.background = 'rgba(239, 68, 68, 0.1)';
        estadoCedula.innerHTML = '<i class="fa-solid fa-times-circle" style="color: #ef4444;"></i><span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">Cédula: No cargado</span>';
    }
    
    document.getElementById('modalDocumentacionAliado').classList.add('show');
}

function cerrarModalDocumentacionAliado() {
    document.getElementById('modalDocumentacionAliado').classList.remove('show');
}

// Cerrar modal al hacer clic fuera
document.getElementById('modalDocumentacionAliado').addEventListener('click', function(e) { 
    if (e.target === this) { cerrarModalDocumentacionAliado(); } 
});

function getEnlaceDocumentacion() {
    var codAliadoCryp = document.getElementById('doc_cod_aliado_cryp').value;
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    return window.location.origin + basePath + 'documentacion_aliado.php?cod=' + encodeURIComponent(codAliadoCryp);
}

function compartirDocWhatsApp() {
    var codAliadoCryp = document.getElementById('doc_cod_aliado_cryp').value;
    var nombreAliado = document.getElementById('doc_nombre_aliado').textContent;
    var telefono = document.getElementById('doc_telefono_aliado').value.replace(/\D/g, '');
    
    if (!codAliadoCryp) { alert('No se encontró el código del aliado'); return; }
    
    var enlace = getEnlaceDocumentacion();
    var mensaje = '¡Hola ' + nombreAliado + '! Por favor sube tu documentación legal (RUT y Cámara de Comercio) en el siguiente enlace: ' + enlace;
    var urlWhatsApp = 'https://wa.me/' + (telefono ? '57' + telefono : '') + '?text=' + encodeURIComponent(mensaje);
    
    window.open(urlWhatsApp, '_blank');
}

function compartirDocEmail() {
    var nombreAliado = document.getElementById('doc_nombre_aliado').textContent;
    var correoAliado = document.getElementById('doc_correo_aliado').value;
    
    if (!correoAliado || correoAliado.trim() === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Correo no disponible',
            text: 'El aliado no tiene un correo electrónico registrado',
            background: '#1a1f2e',
            color: 'white',
            customClass: { container: 'swal-on-top-modal' }
        });
        return;
    }
    
    // Abrir modal de confirmación de envío de email
    document.getElementById('emaildoc_nombre_aliado').textContent = nombreAliado;
    document.getElementById('emaildoc_correo').value = correoAliado;
    document.getElementById('modalEnviarDocumentacionEmail').classList.add('show');
}

function cerrarModalEnviarDocumentacionEmail() {
    document.getElementById('modalEnviarDocumentacionEmail').classList.remove('show');
}

// Cerrar modal de email al hacer clic fuera
document.getElementById('modalEnviarDocumentacionEmail').addEventListener('click', function(e) { 
    if (e.target === this) { cerrarModalEnviarDocumentacionEmail(); } 
});

function confirmarEnvioDocumentacionEmail() {
    var codAliadoCryp = document.getElementById('doc_cod_aliado_cryp').value;
    var nombreAliado = document.getElementById('doc_nombre_aliado').textContent;
    var correoAliado = document.getElementById('emaildoc_correo').value;
    var enlace = getEnlaceDocumentacion();
    
    if (!correoAliado || correoAliado.trim() === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Correo no disponible',
            text: 'No se puede enviar el correo sin dirección electrónica',
            background: '#1a1f2e',
            color: 'white',
            customClass: { container: 'swal-on-top-modal' }
        });
        return;
    }
    
    // Cerrar modal de confirmación
    cerrarModalEnviarDocumentacionEmail();
    
    // Mostrar indicador de carga
    Swal.fire({
        title: 'Enviando correo...',
        html: '<i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #EA4335;"></i><p style="margin-top: 1rem;">Por favor espere...</p>',
        showConfirmButton: false,
        allowOutsideClick: false,
        background: '#1a1f2e',
        color: 'white',
        customClass: { container: 'swal-on-top-modal' }
    });
    
    // Realizar petición AJAX
    $.ajax({
        url: '../admin/enviar_documentacion_aliado_email.php',
        type: 'POST',
        data: {
            cod_aliado_cryp: codAliadoCryp,
            correo: correoAliado,
            nombre_aliado: nombreAliado,
            enlace: enlace
        },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Enviado!',
                    html: '<p>' + response.mensaje + '</p>',
                    confirmButtonColor: '#10b981',
                    background: '#1a1f2e',
                    color: 'white',
                    customClass: { container: 'swal-on-top-modal' }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.mensaje || 'No se pudo enviar el correo',
                    background: '#1a1f2e',
                    color: 'white',
                    customClass: { container: 'swal-on-top-modal' }
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error('Error:', status, error);
            console.error('Respuesta:', xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error de conexión. Intenta nuevamente.',
                background: '#1a1f2e',
                color: 'white',
                customClass: { container: 'swal-on-top-modal' }
            });
        }
    });
}

function copiarEnlaceDoc() {
    var enlace = getEnlaceDocumentacion();
    
    // Crear elemento temporal para copiar
    var tempInput = document.createElement('textarea');
    tempInput.value = enlace;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    
    Swal.fire({ 
        icon: 'success', 
        title: '¡Copiado!', 
        text: 'El enlace ha sido copiado al portapapeles', 
        timer: 1500, 
        timerProgressBar: true, 
        showConfirmButton: false, 
        background: '#1a1f2e', 
        color: 'white',
        customClass: {
            container: 'swal-on-top-modal'
        }
    });
}
</script>

<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

</body>
</html>
