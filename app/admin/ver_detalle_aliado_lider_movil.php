<?php 
$nombre_pagina = "Detalle Aliado";
$cod_seguridad_pag = "1";
$pagina_local = $_SERVER['PHP_SELF'];
$cod_base_caja = "1";
?>
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_lider.php"); ?>
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_lider.php"); ?>

<?php
$cod_aliado = isset($_GET['cod_administrador']) ? intval($_GET['cod_administrador']) : 0;

$sql = "SELECT a.*, l.nombres_apellidos_tercero AS nombre_lider, c.nombres_apellidos_tercero AS nombre_lider, ase.nombres_apellidos_tercero AS nombre_asesor,
ts.nombre_tipo_sector, ts.descripcion_tipo_sector
FROM tbl15_administrador a 
LEFT JOIN tbl15_administrador l ON a.cod_lider = l.cod_administrador 
LEFT JOIN tbl15_administrador c ON a.cod_lider = c.cod_administrador 
LEFT JOIN tbl15_administrador ase ON a.cod_asesor = ase.cod_administrador
LEFT JOIN tbl15_tipo_sector ts ON a.cod_tipo_sector = ts.cod_tipo_sector
WHERE a.cod_administrador = '$cod_aliado'";
$r = mysqli_query($conectar, $sql);
$row = mysqli_fetch_assoc($r);
if (!$row) { header("Location: lista_aliado_lider_movil.php"); exit; }
// Generar código encriptado del aliado para compartir enlace
$cod_aliado_cryp = DAXCODIFCRYPTOR::encriptardax(DAXCODIFCRYPTOR::encodifdax($cod_aliado));
// Obtener tiendas
$sql_tiendas = "SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE cod_aliado_estrategico = '$cod_aliado'";
$res_tiendas = mysqli_query($conectar, $sql_tiendas);
$tiendas_arr = [];
$nombres_tiendas = [];
while($t = mysqli_fetch_assoc($res_tiendas)) { $tiendas_arr[] = $t; /*Mantener la estructura del array asociativo*/ $nombres_tiendas[] = $t['nombre_tienda']; /*Para el texto de resumen*/ }
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
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
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
        color: #8b5cf6;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
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
        background: rgba(139, 92, 246, 0.1);
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
        color: #8b5cf6;
        text-decoration: none;
    }
    .store-item i { color: #8b5cf6; }

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
        border-color: rgba(139, 92, 246, 0.3);
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
        color: #8b5cf6;
    }
    .credito-empty {
        text-align: center;
        padding: 2rem;
        color: rgba(255,255,255,0.5);
    }
    .credito-empty i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: rgba(139, 92, 246, 0.3);
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
        border-top: 1px solid rgba(139, 92, 246, 0.2);
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
        color: #8b5cf6;
        text-decoration: none;
    }
    .nav-item.active {
        background: rgba(139, 92, 246, 0.1);
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
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(79, 70, 229, 0.15));
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
        background: linear-gradient(135deg, #34d399 0%, #8b5cf6 100%);
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
    <div class="page-header">
        <?php 
        // Determinar el link de regreso según si viene con cod_asesor o no
        $cod_asesor_param = isset($_GET['cod_asesor']) ? intval($_GET['cod_asesor']) : 0;
        $back_link = $cod_asesor_param > 0 
            ? 'lista_aliado_asesor_lider_movil.php?cod_asesor=' . $cod_asesor_param 
            : 'lista_aliado_lider_movil.php';
        ?>
        <a href="<?php echo $back_link; ?>" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class="page-title">Detalle de Aliado</h1>
    </div>

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
                                echo '<span style="background: rgba(139, 92, 246, 0.2); color: #8b5cf6; padding: 0.25rem 0.6rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600;"><i class="fa-solid fa-building"></i> Persona Jurídica</span>';
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
                        <span class="detail-label">lider</span>
                        <span class="detail-value"><?php echo $row['nombre_lider'] ?: 'Sin asignar'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Fecha de Registro</span>
                        <span class="detail-value"><?php echo !empty($row['fecha_creacion']) ? date('d/m/Y', strtotime($row['fecha_creacion'])) : 'No disponible'; ?></span>
                    </div>
                </div>
            </div>

            <!-- Sección de Documentación Legal -->
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
                    <a href="<?php echo htmlspecialchars($row['url_documentacion_cedula_aliado']); ?>" target="_blank" style="color: #8b5cf6; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: rgba(139, 92, 246, 0.1); border-radius: 8px;">
                        <i class="fa-solid fa-file-pdf"></i>Ver Cédula
                    </a>
                    <?php endif; ?>
                    <?php if ($rut_cargado): ?>
                    <a href="<?php echo htmlspecialchars($row['url_documentacion_rut_aliado']); ?>" target="_blank" style="color: #8b5cf6; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: rgba(139, 92, 246, 0.1); border-radius: 8px;">
                        <i class="fa-solid fa-file-pdf"></i>Ver Documento RUT
                    </a>
                    <?php endif; ?>
                    <?php if ($camara_cargada): ?>
                    <a href="<?php echo htmlspecialchars($row['url_documentacion_camaracomercio_aliado']); ?>" target="_blank" style="color: #8b5cf6; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem; background: rgba(139, 92, 246, 0.1); border-radius: 8px;">
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
                                <a href="<?php echo htmlspecialchars($banco['url_certificado_banco_cuenta']); ?>" target="_blank" style="color: #8b5cf6; font-size: 0.75rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem; margin-top: 0.25rem;">
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
                            <div class="store-item"><a href="../admin/ver_detalle_tienda_lider_movil.php?cod_tienda=<?php echo $tienda['cod_tienda']; ?>"><i class="fa-solid fa-store"></i><?php echo $tienda['nombre_tienda']; ?></a></div>
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

        </div>
    </div>
</main>

<!-- Modal Documentación Aliado -->
<div class="modal-overlay" id="modalDocumentacionAliado" style="z-index: 3000; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); backdrop-filter: blur(5px); display: none; align-items: center; justify-content: center; padding: 1rem;">
    <div class="modal-content" style="background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%); border-radius: 24px; width: 100%; max-width: 500px; padding: 0; animation: fadeInScale 0.3s ease; max-height: 90vh; overflow-y: auto; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);">
        <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; border-bottom: 1px solid rgba(139, 92, 246, 0.2); background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(79, 70, 229, 0.2)); border-radius: 24px 24px 0 0; position: sticky; top: 0; z-index: 10;">
            <h2 style="color: white; font-size: 1.25rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-file-lines"></i> Documentación</h2>
            <button class="modal-close" onclick="cerrarModalDocumentacionAliado()" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; border: none; width: 40px; height: 40px; border-radius: 12px; cursor: pointer;"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body" style="padding: 1.5rem; padding-bottom: 2rem;">
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
                    <button onclick="copiarEnlaceDoc()" style="background: #8b5cf6; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Copiar enlace">
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

<style>
.modal-overlay.show { display: flex !important; }
@keyframes fadeInScale { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
</style>

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
    
    var codAliadoCryp = document.getElementById('doc_cod_aliado_cryp').value;
    var enlace = getEnlaceDocumentacion();
    
    var asunto = encodeURIComponent('Documentación Legal - ' + nombreAliado);
    var cuerpo = encodeURIComponent('Hola,\n\nPor favor sube tu documentación legal (RUT, Cámara de Comercio y Cédula) en el siguiente enlace:\n' + enlace + '\n\nGracias.');
    
    window.location.href = 'mailto:' + correoAliado + '?subject=' + asunto + '&body=' + cuerpo;
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

<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

</body>
</html>
