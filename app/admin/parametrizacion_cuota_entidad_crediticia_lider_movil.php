<?php 
$nombre_pagina          = "Parametrización Cuotas";
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
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* ============================================ */
/* PARAMETRIZACIÓN CUOTAS - TEMA VIOLETA       */
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
    max-width: 800px;
    margin: 0 auto;
}

/* Header */
.page-header {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(139, 92, 246, 0.4);
}

.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.page-header h1 {
    color: white;
    font-size: 1.4rem;
    font-weight: 800;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    z-index: 2;
}

.page-header p {
    color: rgba(255,255,255,0.85);
    font-size: 0.85rem;
    margin-top: 0.5rem;
    position: relative;
    z-index: 2;
}

/* Cards */
.form-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-card-title {
    font-size: 1rem;
    font-weight: 700;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.25rem;
}

.form-card-title i {
    color: #8b5cf6;
}

/* Form Elements */
.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: rgba(255,255,255,0.7);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.form-select, .form-input {
    width: 100%;
    padding: 0.85rem 1rem;
    background: rgba(139, 92, 246, 0.08);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 12px;
    color: white;
    font-size: 0.95rem;
    font-family: 'Inter', sans-serif;
    transition: all 0.3s ease;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
}

.form-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%238b5cf6' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    padding-right: 2.5rem;
}

.form-select option {
    background: #1a1f2e;
    color: white;
}

.form-select:focus, .form-input:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
}

.form-input::placeholder {
    color: rgba(255,255,255,0.3);
}

/* Number input for cuotas */
.cuotas-input-wrapper {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.cuotas-input-wrapper .form-input {
    flex: 1;
    max-width: 200px;
}

.btn-generar {
    padding: 0.85rem 1.5rem;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 0.9rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
}

.btn-generar:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(139, 92, 246, 0.4);
}

.btn-generar:active {
    transform: translateY(0);
}

/* Cuotas Table */
.cuotas-table-wrapper {
    overflow-x: auto;
    margin-top: 1rem;
    border-radius: 16px;
    border: 1px solid rgba(139, 92, 246, 0.2);
}

.cuotas-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 450px;
}

.cuotas-table thead th {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.25) 0%, rgba(124, 58, 237, 0.15) 100%);
    color: #c4b5fd;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 0.85rem 0.75rem;
    text-align: center;
    border-bottom: 1px solid rgba(139, 92, 246, 0.3);
    white-space: nowrap;
}

.cuotas-table tbody tr {
    transition: background 0.2s ease;
}

.cuotas-table tbody tr:hover {
    background: rgba(139, 92, 246, 0.05);
}

.cuotas-table tbody td {
    padding: 0.6rem 0.5rem;
    text-align: center;
    border-bottom: 1px solid rgba(139, 92, 246, 0.1);
}

.cuota-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 10px;
    color: white;
    font-weight: 700;
    font-size: 0.85rem;
    box-shadow: 0 2px 10px rgba(139, 92, 246, 0.3);
}

.cuota-input {
    width: 100%;
    max-width: 100px;
    padding: 0.6rem 0.5rem;
    background: rgba(139, 92, 246, 0.08);
    border: 1px solid rgba(139, 92, 246, 0.25);
    border-radius: 10px;
    color: white;
    font-size: 0.9rem;
    font-family: 'Inter', sans-serif;
    text-align: center;
    transition: all 0.3s ease;
    outline: none;
}

.cuota-input:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
    background: rgba(139, 92, 246, 0.12);
}

.cuota-input.error {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
}

.cuota-input.filled {
    border-color: #34d399;
}

/* Type Switcher Styles */
.type-switcher {
    display: flex;
    justify-content: center;
    gap: 4px;
    margin-top: 4px;
    background: rgba(139, 92, 246, 0.1);
    padding: 2px;
    border-radius: 8px;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
}

.type-btn {
    padding: 2px 6px;
    border-radius: 6px;
    font-size: 0.65rem;
    font-weight: 800;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    color: rgba(255, 255, 255, 0.4);
    background: transparent;
}

.type-btn.active {
    background: #8b5cf6;
    color: white;
    box-shadow: 0 2px 5px rgba(139, 92, 246, 0.3);
}

.type-btn.active[data-type="$"] {
    background: #34d399;
    box-shadow: 0 2px 5px rgba(52, 211, 153, 0.3);
}

/* Entity Chips */
.entity-chips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 0.75rem;
    margin-top: 1rem;
}

.entity-chip {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0.85rem 0.5rem;
    background: rgba(139, 92, 246, 0.08);
    border: 1px solid rgba(139, 92, 246, 0.2);
    border-radius: 16px;
    color: #c4b5fd;
    font-size: 0.85rem;
    font-weight: 600;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    gap: 0.5rem;
}

.entity-chip i {
    font-size: 1.2rem;
    color: #8b5cf6;
    transition: transform 0.3s ease;
}

.entity-chip:hover {
    background: rgba(139, 92, 246, 0.15);
    border-color: #8b5cf6;
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
}

.entity-chip:hover i {
    transform: scale(1.1);
}

.entity-chip.active {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-color: transparent;
    color: white;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
}

.entity-chip.active i {
    color: white;
}

.empty-chips-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.02);
    border: 1px dashed rgba(139, 92, 246, 0.3);
    border-radius: 16px;
    color: rgba(255, 255, 255, 0.4);
    font-size: 0.85rem;
}

/* Save Button */
.btn-save-wrapper {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.btn-save {
    flex: 1;
    padding: 1rem;
    background: linear-gradient(135deg, #34d399 0%, #16a34a 100%);
    border: none;
    border-radius: 14px;
    color: white;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    box-shadow: 0 4px 20px rgba(52, 211, 153, 0.3);
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(52, 211, 153, 0.4);
}

.btn-save:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-cancel {
    padding: 1rem 1.5rem;
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.3);
    border-radius: 14px;
    color: #ef4444;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    background: rgba(239, 68, 68, 0.25);
}

/* Existing Parameterizacion Table */
.existing-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 450px;
}

.existing-table thead th {
    background: linear-gradient(135deg, rgba(52, 211, 153, 0.2) 0%, rgba(22, 163, 106, 0.1) 100%);
    color: #34d399;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 0.85rem 0.75rem;
    text-align: center;
    border-bottom: 1px solid rgba(52, 211, 153, 0.3);
}

.existing-table tbody td {
    padding: 0.75rem 0.5rem;
    text-align: center;
    color: rgba(255,255,255,0.8);
    font-size: 0.85rem;
    border-bottom: 1px solid rgba(139, 92, 246, 0.1);
}

/* Loading spinner */
.loading-spinner {
    display: none;
    text-align: center;
    padding: 2rem;
}

.loading-spinner i {
    font-size: 2rem;
    color: #8b5cf6;
    animation: spinLoader 1s linear infinite;
}

@keyframes spinLoader {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Empty state */
.empty-state {
    text-align: center;
    padding: 2.5rem 1rem;
}

.empty-state i {
    font-size: 3rem;
    color: rgba(139, 92, 246, 0.3);
    margin-bottom: 1rem;
}

.empty-state p {
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem;
}

/* Entity Info Badge */
.entity-info-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 25px;
    color: #c4b5fd;
    font-size: 0.8rem;
    font-weight: 600;
    margin-top: 0.75rem;
}

/* Bottom Navigation */
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

/* Animations */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-in {
    animation: fadeInUp 0.5s ease forwards;
}

.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }
.delay-3 { animation-delay: 0.3s; }
.delay-4 { animation-delay: 0.4s; }

/* Responsive */
@media (max-width: 480px) {
    .cuotas-input-wrapper {
        flex-direction: column;
        align-items: stretch;
    }
    .cuotas-input-wrapper .form-input {
        max-width: 100%;
    }
    .btn-save-wrapper {
        flex-direction: column;
    }
}

/* Badge for existing count */
.badge-count {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 0.2rem 0.6rem;
    border-radius: 10px;
    margin-left: 0.5rem;
}

/* Percent symbol inside input wrapper */
.input-percent-wrapper {
    position: relative;
    display: inline-block;
    width: 100%;
    max-width: 100px;
}

.input-percent-wrapper .cuota-input {
    max-width: 100%;
    padding-right: 1.5rem;
}

.input-percent-wrapper::after {
    content: '%';
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255,255,255,0.4);
    font-size: 0.75rem;
    font-weight: 600;
    pointer-events: none;
}
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Entidades SIN parametrizar
$sql_entidades_nuevas = "SELECT cod_entidad_crediticia, nombre_entidad_crediticia FROM tbl15_entidad_crediticia 
WHERE cod_estado = '1' AND cod_entidad_crediticia NOT IN (SELECT DISTINCT cod_entidad_crediticia FROM tbl15_parametrizacion_entidad_crediticia_cuota) ORDER BY nombre_entidad_crediticia ASC";
$resultado_entidades_nuevas = mysqli_query($conectar, $sql_entidades_nuevas);
// Entidades YA parametrizadas
$sql_entidades_existentes = "SELECT DISTINCT e.cod_entidad_crediticia, e.nombre_entidad_crediticia FROM tbl15_entidad_crediticia e 
INNER JOIN tbl15_parametrizacion_entidad_crediticia_cuota p ON e.cod_entidad_crediticia = p.cod_entidad_crediticia WHERE e.cod_estado = '1' ORDER BY e.nombre_entidad_crediticia ASC";
$resultado_entidades_existentes = mysqli_query($conectar, $sql_entidades_existentes);
?>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-sliders"></i> Parametrización de Cuotas</h1>
        <p>Configure los porcentajes de interés, seguro y fondo de garantía por cuota para cada entidad crediticia.</p>
    </div>

    <!-- Step 1: Seleccionar Entidad -->
    <div class="form-card animate-in delay-1">
        <div class="form-card-title"><i class="fa-solid fa-plus-circle"></i>Nueva Parametrización</div>
        <div class="form-group">
            <label class="form-label">Entidad SIN Configurar</label>
            <select class="form-select" id="selectEntidadCrediticia" onchange="seleccionarNueva()">
                <option value="">-- Seleccione una entidad --</option>
                <?php while ($entidad = mysqli_fetch_assoc($resultado_entidades_nuevas)): ?>
                <option value="<?php echo $entidad['cod_entidad_crediticia']; ?>"><?php echo $entidad['nombre_entidad_crediticia']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div style="margin: 1.5rem 0; height: 1px; background: rgba(139, 92, 246, 0.2);"></div>

        <div class="form-card-title"><i class="fa-solid fa-clock-rotate-left"></i>Parametrizaciones Guardadas</div>
        <div class="entity-chips-grid">
            <?php if (mysqli_num_rows($resultado_entidades_existentes) > 0): ?>
                <?php while ($entidad = mysqli_fetch_assoc($resultado_entidades_existentes)): ?>
                <div class="entity-chip" 
                     onclick="seleccionarChip(this, '<?php echo $entidad['cod_entidad_crediticia']; ?>', '<?php echo addslashes($entidad['nombre_entidad_crediticia']); ?>')">
                    <i class="fa-solid fa-building-columns"></i>
                    <span><?php echo $entidad['nombre_entidad_crediticia']; ?></span>
                    <i class="fa-solid fa-pen-to-square" style="font-size: 0.7rem; opacity: 0.6; margin-left: auto; padding-right: 5px;"></i>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-chips-state"><p>No hay entidades parametrizadas aún</p></div>
            <?php endif; ?>
        </div>
        <div id="entityInfoBadge" style="display:none;">
            <div class="entity-info-badge">
                <i class="fa-solid fa-info-circle"></i>
                <span id="entityInfoText"></span>
            </div>
        </div>
    </div>

    <!-- Step 2: Generar Cuotas (visible after entity selection) -->
    <div class="form-card animate-in delay-2" id="cardGenerarCuotas" style="display:none;">
        <div class="form-card-title" id="titleConfiguracion"><i class="fa-solid fa-gears"></i>Configurar Cuotas</div>
        <div class="form-group">
            <label class="form-label">Número de Cuotas a Parametrizar</label>
            <div class="cuotas-input-wrapper">
                <input type="number" class="form-input" id="inputNumeroCuotas" min="1" max="120" placeholder="Ej: 12" value="">
                <button type="button" class="btn-generar" onclick="generarCuotas()"><i class="fa-solid fa-wand-magic-sparkles"></i> Generar</button>
            </div>
        </div>

        <!-- Tabla de cuotas generada dinámicamente -->
        <div id="cuotasTableContainer" style="display:none;">
            <div class="cuotas-table-wrapper">
                <table class="cuotas-table" id="cuotasTable">
                    <thead>
                        <tr>
                            <th style="width: 15%"><i class="fa-solid fa-hashtag"></i> Cuota</th>
                            <th style="width: 28%"><i class="fa-solid fa-percent"></i> Interés (%)</th>
                            <th style="width: 28%"><i class="fa-solid fa-shield-halved"></i> Seguro</th>
                            <th style="width: 29%"><i class="fa-solid fa-hand-holding-dollar"></i> Fondo Garantía</th>
                        </tr>
                    </thead>
                    <tbody id="cuotasBody">
                    </tbody>
                </table>
            </div>

            <!-- Save/Cancel buttons -->
            <div class="btn-save-wrapper">
                <button type="button" class="btn-save" id="btnGuardar" onclick="guardarParametrizacion()"><i class="fa-solid fa-floppy-disk"></i> Guardar Parametrización</button>
                <button type="button" class="btn-cancel" onclick="limpiarCuotas()"><i class="fa-solid fa-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Step 3: Parametrización Existente -->
    <div class="form-card animate-in delay-3" id="cardExistente" style="display:none;">
        <div class="form-card-title"><i class="fa-solid fa-clock-rotate-left"></i>Parametrización Existente <span class="badge-count" id="badgeExistente">0</span></div>
        <div class="loading-spinner" id="loadingExistente">
            <i class="fa-solid fa-circle-notch"></i>
            <p style="color: rgba(255,255,255,0.5); margin-top: 0.5rem;">Cargando datos...</p>
        </div>
        <div id="existenteContent">
            <div class="empty-state" id="emptyExistente">
                <i class="fa-solid fa-database"></i>
                <p>No hay cuotas parametrizadas para esta entidad</p>
            </div>
        </div>
    </div>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<script>
var codAdministrador = '<?php echo $cod_administrador; ?>';
var codTienda = '<?php echo $cod_tienda; ?>';
var currentCodEntidad = '';
var currentNombreEntidad = '';

// Funciones para manejar la selección de entidades
function seleccionarNueva() {
    var codEntidad = $('#selectEntidadCrediticia').val();
    if (!codEntidad) { resetUI(); return; }
    currentCodEntidad = codEntidad;
    currentNombreEntidad = $('#selectEntidadCrediticia option:selected').text();
    // Deseleccionar chips
    $('.entity-chip').removeClass('active');
    ejecutarCarga(currentCodEntidad, currentNombreEntidad, true);
}
function seleccionarChip(el, codEntidad, nombreEntidad) {
    // UI state
    $('.entity-chip').removeClass('active');
    $(el).addClass('active');
    // Reset the "New" select
    $('#selectEntidadCrediticia').val('');
    currentCodEntidad = codEntidad;
    currentNombreEntidad = nombreEntidad;
    ejecutarCarga(currentCodEntidad, currentNombreEntidad, false);
}
function resetUI() {
    $('#cardGenerarCuotas').slideUp(300);
    $('#cardExistente').slideUp(300);
    $('#entityInfoBadge').fadeOut(200);
}
function ejecutarCarga(codEntidad, nombreEntidad, esNueva) {
    $('#entityInfoText').text('Entidad seleccionada: ' + nombreEntidad);
    $('#entityInfoBadge').fadeIn(200);
    // Mostrar sección de configurar cuotas
    $('#cardGenerarCuotas').slideDown(300);
    limpiarCuotas();
    // Cargar datos existentes (si los hay)
    $('#cardExistente').slideDown(300);
    $('#loadingExistente').show();
    $('#existenteContent').html('');
    
    $.ajax({
        url: '../admin/obtener_cuotas_entidad_crediticia_ajax.php', type: 'POST', data: { cod_entidad_crediticia: codEntidad }, dataType: 'json',
        success: function(response) {
            $('#loadingExistente').hide();
            
            if (response.success && response.cuotas.length > 0) {
                // Si NO es nueva (es edición), cargamos los datos en los inputs del Step 2
                if (!esNueva) {
                    $('#inputNumeroCuotas').val(response.cuotas.length);
                    // Ocultamos el input y botón de generar para que sepa que está editando
                    $('.cuotas-input-wrapper').hide();
                    $('#titleConfiguracion').html('<i class="fa-solid fa-pen-to-square"></i> EDITANDO: ' + nombreEntidad);
                    
                    var tbody = '';
                    response.cuotas.forEach(function(c) {
                        tbody += '<tr>';
                        tbody += '<td><span class="cuota-number">' + c.cuota + '</span></td>';
                        tbody += '<td><div class="input-percent-wrapper"><input type="number" class="cuota-input" id="interes_' + c.cuota + '" step="0.00001" min="0" placeholder="0.00000" value="' + c.interes_ptj + '" required></div></td>';
                        // Seguro con selector de tipo
                        tbody += '<td>';
                        tbody += '<input type="number" class="cuota-input" id="seguro_' + c.cuota + '" step="0.00001" min="0" placeholder="0.00000" value="' + c.ptj_seguro + '" required>';
                        tbody += '<div class="type-switcher" id="switcher_seguro_' + c.cuota + '">';
                        tbody += '<button class="type-btn ' + (c.tipo_ptj_seguro == '%' ? 'active' : '') + '" data-type="%" onclick="toggleValueType(this, \'seguro\', ' + c.cuota + ')">%</button>';
                        tbody += '<button class="type-btn ' + (c.tipo_ptj_seguro == '$' ? 'active' : '') + '" data-type="$" onclick="toggleValueType(this, \'seguro\', ' + c.cuota + ')">$</button>';
                        tbody += '</div>';
                        tbody += '</td>';
                        // Fondo con selector de tipo
                        tbody += '<td>';
                        tbody += '<input type="number" class="cuota-input" id="fondo_' + c.cuota + '" step="0.00001" min="0" placeholder="0.00000" value="' + c.ptj_fondo_garantia + '" required>';
                        tbody += '<div class="type-switcher" id="switcher_fondo_' + c.cuota + '">';
                        tbody += '<button class="type-btn ' + (c.tipo_fondo_garantia == '%' ? 'active' : '') + '" data-type="%" onclick="toggleValueType(this, \'fondo\', ' + c.cuota + ')">%</button>';
                        tbody += '<button class="type-btn ' + (c.tipo_fondo_garantia == '$' ? 'active' : '') + '" data-type="$" onclick="toggleValueType(this, \'fondo\', ' + c.cuota + ')">$</button>';
                        tbody += '</div>';
                        tbody += '</td>';
                        tbody += '</tr>';
                    });
                    $('#cuotasBody').html(tbody);
                    $('#cuotasTableContainer').show();
                } else {
                    // Si es nueva, mostramos el generador normal
                    $('.cuotas-input-wrapper').show();
                    $('.form-card-title:eq(1)').html('<i class="fa-solid fa-table-cells"></i> Generar Cuotas');
                    $('#inputNumeroCuotas').val('');
                }
                // También mostramos la vista previa abajo
                $('#badgeExistente').text(response.cuotas.length);
                var html = '<div class="cuotas-table-wrapper"><table class="existing-table"><thead><tr>';
                html += '<th><i class="fa-solid fa-hashtag"></i> Cuota</th>';
                html += '<th><i class="fa-solid fa-percent"></i> Interés</th>';
                html += '<th><i class="fa-solid fa-shield-halved"></i> Seguro</th>';
                html += '<th><i class="fa-solid fa-hand-holding-dollar"></i> F. Garantía</th>';
                html += '</tr></thead><tbody>';
                
                // Mapa de colores basado en el valor numérico para identificar duplicados en toda la tabla
                var valColorMap = {};
                var colorsList = [
                    'rgba(139, 92, 246, 0.2)', // Violeta
                    'rgba(52, 211, 153, 0.2)', // Esmeralda
                    'rgba(59, 130, 246, 0.2)', // Azul
                    'rgba(245, 158, 11, 0.2)', // Ámbar
                    'rgba(239, 68, 68, 0.2)',  // Rojo
                    'rgba(236, 72, 153, 0.2)', // Rosa
                    'rgba(34, 211, 238, 0.2)', // Cian
                    'rgba(249, 115, 22, 0.2)', // Naranja
                    'rgba(168, 85, 247, 0.2)', // Morado
                    'rgba(132, 204, 22, 0.2)'  // Lima
                ];
                var colorIdx = 0;

                response.cuotas.forEach(function(c) {
                    // Extraemos los valores numéricos con precisión de 5 decimales
                    var vI = parseFloat(c.interes_ptj).toFixed(5);
                    var vS = parseFloat(c.ptj_seguro).toFixed(5);
                    var vF = parseFloat(c.ptj_fondo_garantia).toFixed(5);

                    // Asignamos color al valor si es la primera vez que aparece
                    if (!valColorMap[vI]) valColorMap[vI] = colorsList[colorIdx++ % colorsList.length];
                    if (!valColorMap[vS]) valColorMap[vS] = colorsList[colorIdx++ % colorsList.length];
                    if (!valColorMap[vF]) valColorMap[vF] = colorsList[colorIdx++ % colorsList.length];

                    var cI = valColorMap[vI], cS = valColorMap[vS], cF = valColorMap[vF];
                    
                    html += '<tr>';
                    html += '<td><span class="cuota-number">' + c.cuota + '</span></td>';
                    // Celda Interés
                    html += '<td style="background-color: ' + cI + '; border-left: 3px solid ' + cI.replace('0.2', '0.6') + '; font-weight: 700;">' + vI + '%</td>';
                    // Celda Seguro
                    html += '<td style="background-color: ' + cS + '; border-left: 3px solid ' + cS.replace('0.2', '0.6') + '; font-weight: 700;">' + (c.tipo_ptj_seguro == '$' ? '$' : '') + vS + (c.tipo_ptj_seguro != '$' ? '%' : '') + '</td>';
                    // Celda Fondo
                    html += '<td style="background-color: ' + cF + '; border-left: 3px solid ' + cF.replace('0.2', '0.6') + '; font-weight: 700;">' + (c.tipo_fondo_garantia == '$' ? '$' : '') + vF + (c.tipo_fondo_garantia != '$' ? '%' : '') + '</td>';
                    html += '</tr>';
                });
                html += '</tbody></table></div>';
                html += '<div style="text-align: center; margin-top: 1rem;">';
                html += '<button type="button" class="btn-cancel" onclick="eliminarParametrizacionExistente()" style="width: 100%;">';
                html += '<i class="fa-solid fa-trash-can"></i> Eliminar Parametrización Existente</button></div>';
                $('#existenteContent').html(html);
            } else {
                // Es nueva total (no tiene registros en el servidor)
                $('.cuotas-input-wrapper').show();
                $('#titleConfiguracion').html('<i class="fa-solid fa-table-cells"></i> Generar Cuotas');
                $('#inputNumeroCuotas').val('');
                $('#badgeExistente').text('0');
                $('#existenteContent').html('<div class="empty-state"><i class="fa-solid fa-database"></i><p>No hay cuotas parametrizadas para esta entidad</p></div>');
            }
            
            // Scroll suave para que el usuario vea que se cargó el formulario de edición
            setTimeout(function() {
                document.getElementById('cardGenerarCuotas').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        },
        error: function() {
            $('#loadingExistente').hide();
            $('#existenteContent').html('<div class="empty-state"><i class="fa-solid fa-exclamation-triangle" style="color: #ef4444;"></i><p style="color: #ef4444;">Error al cargar los datos</p></div>');
        }
    });
}
// Function to toggle between % and $
function toggleValueType(btn, field, cuota) {
    $(btn).siblings().removeClass('active');
    $(btn).addClass('active');
}
// Generate cuotas rows
function generarCuotas() {
    var numCuotas = parseInt($('#inputNumeroCuotas').val());
    
    if (!numCuotas || numCuotas < 1 || numCuotas > 120) {
        Swal.fire({ icon: 'warning', title: 'Valor inválido', text: 'Ingrese un número de cuotas válido (entre 1 y 120)', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
        return;
    }
    var tbody = '';
    for (var i = 1; i <= numCuotas; i++) {
        tbody += '<tr>';
        tbody += '<td><span class="cuota-number">' + i + '</span></td>';
        tbody += '<td><div class="input-percent-wrapper"><input type="number" class="cuota-input" id="interes_' + i + '" step="0.00001" min="0" placeholder="0.00000" required></div></td>';
        // Seguro con selector de tipo
        tbody += '<td>';
        tbody += '<input type="number" class="cuota-input" id="seguro_' + i + '" step="0.00001" min="0" placeholder="0.00000" required>';
        tbody += '<div class="type-switcher" id="switcher_seguro_' + i + '">';
        tbody += '<button class="type-btn active" data-type="%" onclick="toggleValueType(this, \'seguro\', ' + i + ')">%</button>';
        tbody += '<button class="type-btn" data-type="$" onclick="toggleValueType(this, \'seguro\', ' + i + ')">$</button>';
        tbody += '</div>';
        tbody += '</td>'; 
        // Fondo con selector de tipo
        tbody += '<td>';
        tbody += '<input type="number" class="cuota-input" id="fondo_' + i + '" step="0.00001" min="0" placeholder="0.00000" required>';
        tbody += '<div class="type-switcher" id="switcher_fondo_' + i + '">';
        tbody += '<button class="type-btn active" data-type="%" onclick="toggleValueType(this, \'fondo\', ' + i + ')">%</button>';
        tbody += '<button class="type-btn" data-type="$" onclick="toggleValueType(this, \'fondo\', ' + i + ')">$</button>';
        tbody += '</div>';
        tbody += '</td>';
        tbody += '</tr>';
    }
    $('#cuotasBody').html(tbody);
    $('#cuotasTableContainer').slideDown(300);
    
    // Add input event listeners for visual feedback
    $('.cuota-input').on('input', function() {
        var val = $(this).val();
        $(this).removeClass('error filled');
        if (val !== '' && !isNaN(val) && parseFloat(val) >= 0) { $(this).addClass('filled'); }
    });
}
// Clear cuotas table
function limpiarCuotas() {
    $('#cuotasBody').html('');
    $('#cuotasTableContainer').slideUp(300);
}
// Save parametrizacion
function guardarParametrizacion() {
    var numCuotas = parseInt($('#inputNumeroCuotas').val());
    
    if (!currentCodEntidad) { Swal.fire({ icon: 'error', title: 'Error', text: 'Seleccione una entidad crediticia', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' }); return; }
    if (!numCuotas || numCuotas < 1) { Swal.fire({ icon: 'error', title: 'Error', text: 'Genere las cuotas primero', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' }); return; }
    // Validate all fields are filled
    var cuotasData = [];
    var hasError = false;
    
    for (var i = 1; i <= numCuotas; i++) {
        var interes = $('#interes_' + i).val();
        var seguro = $('#seguro_' + i).val();
        var fondo = $('#fondo_' + i).val();
        // Obtenemos los tipos seleccionados
        var tipo_seguro = $('#switcher_seguro_' + i + ' .type-btn.active').data('type');
        var tipo_fondo = $('#switcher_fondo_' + i + ' .type-btn.active').data('type');
        // Check if any field is empty
        if (interes === '' || seguro === '' || fondo === '') {
            hasError = true;
            if (interes === '') $('#interes_' + i).addClass('error');
            if (seguro === '') $('#seguro_' + i).addClass('error');
            if (fondo === '') $('#fondo_' + i).addClass('error');
        } else {
            cuotasData.push({ cuota: i, interes_ptj: parseFloat(interes), ptj_seguro: parseFloat(seguro), ptj_fondo_garantia: parseFloat(fondo), tipo_ptj_seguro: tipo_seguro, tipo_fondo_garantia: tipo_fondo });
        }
    }
    if (hasError) { Swal.fire({ icon: 'warning', title: 'Campos obligatorios', text: 'Todos los campos de porcentaje son obligatorios. Complete los campos marcados en rojo.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' }); return; }
    // Confirm save
    Swal.fire({
        title: '¿Guardar parametrización?',
        html: 'Se guardarán <strong>' + numCuotas + ' cuotas</strong> para la entidad <strong>' + currentNombreEntidad + '</strong>.<br><br><small style="color: rgba(255,255,255,0.6);">Si ya existe una parametrización previa, será reemplazada.</small>',
        icon: 'question', showCancelButton: true, confirmButtonColor: '#34d399', cancelButtonColor: '#6b7280', confirmButtonText: '<i class="fa-solid fa-floppy-disk"></i> Sí, Guardar', cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            // Disable button
            $('#btnGuardar').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Guardando...');
            
            $.ajax({
                url: '../admin/guardar_parametrizacion_cuota_entidad_crediticia_ajax.php', type: 'POST', data: { cod_administrador: codAdministrador, cod_tienda: codTienda, cod_entidad_crediticia: currentCodEntidad, nombre_entidad_crediticia: currentNombreEntidad, cuotas: JSON.stringify(cuotasData) }, dataType: 'json',
                success: function(response) {
                    $('#btnGuardar').prop('disabled', false).html('<i class="fa-solid fa-floppy-disk"></i> Guardar Parametrización');
                    if (response.success) { Swal.fire({ icon: 'success', title: '¡Guardado exitosamente!', text: 'La parametrización de ' + numCuotas + ' cuotas ha sido guardada.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#34d399', timer: 3000, showConfirmButton: true }).then(() => { location.reload(); }); } else { Swal.fire({ icon: 'error', title: 'Error al guardar', text: response.message || 'Ocurrió un error al guardar la parametrización.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444' }); }
                },
                error: function() {
                    $('#btnGuardar').prop('disabled', false).html('<i class="fa-solid fa-floppy-disk"></i> Guardar Parametrización');
                    Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444' });
                }
            });
        }
    });
}
// Delete existing parameterizacion
function eliminarParametrizacionExistente() {
    Swal.fire({ 
        title: '¿Eliminar parametrización?', 
        html: 'Se eliminarán todas las cuotas parametrizadas para <strong>' + currentNombreEntidad + '</strong>.', 
        icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', cancelButtonColor: '#6b7280', confirmButtonText: '<i class="fa-solid fa-trash-can"></i> Sí, Eliminar', cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/guardar_parametrizacion_cuota_entidad_crediticia_ajax.php', type: 'POST', data: { accion: 'eliminar', cod_entidad_crediticia: currentCodEntidad }, dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ icon: 'success', title: '¡Eliminado!', text: 'La parametrización ha sido eliminada.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#34d399', timer: 2000 }).then(() => { location.reload(); });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message, background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444' });
                    }
                }
            });
        }
    });
}
</script>

</body>
</html>
