<?php 
$nombre_pagina          = "Parametrización % Gestor Operador Crédito";
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
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
    min-height: 100vh;
}

.page-container {
    padding: 1rem;
    padding-bottom: 100px;
    max-width: 860px;
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

.form-card-title i { color: #8b5cf6; }

/* Table */
.gestor-table-wrapper {
    overflow-x: auto;
    border-radius: 16px;
    border: 1px solid rgba(139, 92, 246, 0.2);
}

.gestor-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 520px;
}

.gestor-table thead th {
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

.gestor-table tbody tr {
    transition: background 0.2s ease;
}

.gestor-table tbody tr:hover {
    background: rgba(139, 92, 246, 0.05);
}

.gestor-table tbody td {
    padding: 0.75rem 0.75rem;
    text-align: center;
    border-bottom: 1px solid rgba(139, 92, 246, 0.1);
    color: rgba(255,255,255,0.85);
    font-size: 0.9rem;
}

.gestor-name {
    text-align: left !important;
    font-weight: 600;
    color: white;
}

.gestor-desc {
    text-align: left !important;
    color: rgba(255,255,255,0.6);
    font-size: 0.82rem;
}

/* PTJ Input Inline */
.ptj-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
}

.ptj-input {
    width: 80px;
    padding: 0.5rem 0.5rem;
    background: rgba(139, 92, 246, 0.08);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 10px;
    color: white;
    font-size: 0.95rem;
    font-family: 'Inter', sans-serif;
    text-align: center;
    transition: all 0.3s ease;
    outline: none;
    font-weight: 700;
}

.ptj-input:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
    background: rgba(139, 92, 246, 0.12);
}

.ptj-symbol {
    color: #c4b5fd;
    font-weight: 700;
    font-size: 1rem;
}

.btn-save-row {
    padding: 0.45rem 0.85rem;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 0.8rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    white-space: nowrap;
}

.btn-save-row:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(139, 92, 246, 0.4);
}

.btn-save-row:active { transform: translateY(0); }

/* Estado badge */
.estado-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.3rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
}

.estado-activo {
    background: rgba(52, 211, 153, 0.15);
    color: #34d399;
    border: 1px solid rgba(52, 211, 153, 0.3);
}

.estado-inactivo {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

/* PTJ badge (current value display) */
.ptj-current-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.3rem 0.7rem;
    background: rgba(139, 92, 246, 0.15);
    border: 1px solid rgba(139, 92, 246, 0.35);
    border-radius: 20px;
    color: #c4b5fd;
    font-size: 0.8rem;
    font-weight: 700;
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

.nav-item.active { background: rgba(139, 92, 246, 0.1); }

.nav-item i { font-size: 1.25rem; margin-bottom: 0.25rem; }

.nav-item span {
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
}

/* Loading state */
.loading-row td { opacity: 0.5; }

/* Animations */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-in { animation: fadeInUp 0.5s ease forwards; }
.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }

/* Empty state */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-state i {
    font-size: 3rem;
    color: rgba(139, 92, 246, 0.3);
    margin-bottom: 1rem;
    display: block;
}

.empty-state p {
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem;
}

/* Divider */
.section-divider {
    height: 1px;
    background: rgba(139, 92, 246, 0.15);
    margin: 1rem 0;
}

/* Info tooltip badge */
.info-tip {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.5rem 1rem;
    background: rgba(139, 92, 246, 0.08);
    border: 1px dashed rgba(139, 92, 246, 0.3);
    border-radius: 12px;
    color: rgba(255,255,255,0.6);
    font-size: 0.78rem;
    margin-bottom: 1rem;
}

.info-tip i { color: #8b5cf6; }

/* ============================================ */
/* RESPONSIVE - MOBILE FIRST                   */
/* ============================================ */

/* Tablet y escritorio: tabla normal */
@media (min-width: 640px) {
    .gestor-table { min-width: unset; }
    .page-header h1 { font-size: 1.4rem; }
}

/* Móvil: cada fila se convierte en tarjeta */
@media (max-width: 639px) {

    /* Evitar desbordamiento horizontal global */
    html, body {
        overflow-x: hidden;
        width: 100%;
    }

    .page-container {
        padding: 0.5rem;
        max-width: 100vw;
        overflow-x: hidden;
    }

    .page-header {
        padding: 1rem 0.85rem;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.25);
    }
    .page-header h1 { font-size: 1rem; gap: 0.5rem; }
    .page-header p  { font-size: 0.75rem; }

    .form-card {
        padding: 0.75rem;
        border-radius: 14px;
        overflow: hidden;
    }

    .form-card-title { font-size: 0.9rem; gap: 0.4rem; }

    .info-tip {
        display: flex;
        width: 100%;
        font-size: 0.73rem;
        padding: 0.4rem 0.65rem;
    }

    /* Ocultar cabecera de tabla */
    .gestor-table thead { display: none; }

    /* Eliminar min-width que causa el desbordamiento */
    .gestor-table {
        min-width: 0 !important;
        width: 100%;
        display: block;
    }

    .gestor-table tbody { display: block; }

    /* Quitar borde del wrapper */
    .gestor-table-wrapper {
        border: none;
        background: transparent;
        overflow: visible;
    }

    /* Cada fila = tarjeta contenida */
    .gestor-table tbody tr {
        display: block;
        background: rgba(139, 92, 246, 0.04);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 14px;
        margin-bottom: 0.75rem;
        padding: 0.7rem 0.75rem;
        transition: background 0.2s ease;
        overflow: hidden;
        max-width: 100%;
        box-sizing: border-box;
    }

    .gestor-table tbody tr:hover {
        background: rgba(139, 92, 246, 0.08);
    }

    /* Cada celda = fila flex con etiqueta */
    .gestor-table tbody td {
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-align: right;
        padding: 0.4rem 0;
        border-bottom: 1px solid rgba(139, 92, 246, 0.07);
        font-size: 0.82rem;
        max-width: 100%;
        box-sizing: border-box;
        word-break: break-word;
    }

    .gestor-table tbody td:last-child { border-bottom: none; }

    /* Etiqueta generada desde data-label */
    .gestor-table tbody td::before {
        content: attr(data-label);
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: rgba(139, 92, 246, 0.7);
        text-align: left;
        flex: 0 0 auto;
        margin-right: 0.5rem;
        white-space: nowrap;
    }

    /* Contenido de cada celda */
    .gestor-table tbody td.gestor-name,
    .gestor-table tbody td.gestor-desc {
        text-align: right;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Ocultar columna de número (#) en móvil */
    .gestor-table tbody td.col-num { display: none; }

    /* Input de porcentaje */
    .ptj-wrapper { gap: 0.25rem; }
    .ptj-input { width: 60px; font-size: 0.95rem; padding: 0.4rem; }

    /* Botón guardar contenido dentro de la tarjeta */
    .gestor-table tbody td.col-accion {
        display: block;
        padding: 0.5rem 0 0;
        border-bottom: none;
    }

    .gestor-table tbody td.col-accion::before { display: none; }

    .btn-save-row {
        display: flex;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        justify-content: center;
        align-items: center;
        padding: 0.6rem 0.5rem;
        font-size: 0.85rem;
        border-radius: 10px;
        white-space: nowrap;
        overflow: hidden;
    }
}
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Consultar todos los gestores operadores de crédito activos e inactivos
$sql_gestores = "SELECT cod_gestor_operador_credito, nombre_gestor_operador_credito, descripcion_gestor_operador_credito, ptj_gestor_operador_credito, cod_estado
                 FROM tbl15_gestor_operador_credito
                 ORDER BY nombre_gestor_operador_credito ASC";
$resultado_gestores = mysqli_query($conectar, $sql_gestores) or die(mysqli_error($conectar));
$total_gestores = mysqli_num_rows($resultado_gestores);
?>

<main class="page-container">

    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-percent"></i> % Gestor Operador de Crédito</h1>
        <p>Edite el porcentaje de cada gestor operador de crédito registrado en el sistema.</p>
    </div>

    <!-- Tabla principal -->
    <div class="form-card animate-in delay-1">
        <div class="form-card-title">
            <i class="fa-solid fa-table-list"></i>
            Gestores Registrados
            <span style="background: rgba(139, 92, 246,0.2); color: #c4b5fd; font-size: 0.7rem; font-weight: 700; padding: 0.2rem 0.6rem; border-radius: 10px; margin-left: 0.5rem;"><?php echo $total_gestores; ?></span>
        </div>

        <div class="info-tip">
            <i class="fa-solid fa-circle-info"></i>
            Modifique el porcentaje directamente en cada fila y presione <strong>&nbsp;Guardar&nbsp;</strong> para aplicar el cambio.
        </div>

        <?php if ($total_gestores > 0): ?>
        <div class="gestor-table-wrapper">
            <table class="gestor-table">
                <thead>
                    <tr>
                        <th style="text-align:left; padding-left:1rem;">#</th>
                        <th style="text-align:left;">Nombre</th>
                        <th style="text-align:left;">Descripción</th>
                        <th>% Actual</th>
                        <th>Nuevo %</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $fila = 1; while ($gestor = mysqli_fetch_assoc($resultado_gestores)): ?>
                    <tr id="fila_<?php echo (int)$gestor['cod_gestor_operador_credito']; ?>">
                        <td class="col-num" style="padding-left:1rem; font-weight:700; color: rgba(255,255,255,0.5);"><?php echo $fila++; ?></td>
                        <td class="gestor-name" data-label="Nombre"><?php echo htmlspecialchars($gestor['nombre_gestor_operador_credito']); ?></td>
                        <td class="gestor-desc" data-label="Descripción"><?php echo htmlspecialchars($gestor['descripcion_gestor_operador_credito']); ?></td>
                        <td data-label="% Actual">
                            <span class="ptj-current-badge" id="badge_<?php echo (int)$gestor['cod_gestor_operador_credito']; ?>">
                                <i class="fa-solid fa-percent" style="font-size:0.65rem;"></i>
                                <?php echo (int)$gestor['ptj_gestor_operador_credito']; ?>
                            </span>
                        </td>
                        <td data-label="Nuevo %">
                            <div class="ptj-wrapper">
                                <input
                                    type="number"
                                    class="ptj-input"
                                    id="ptj_<?php echo (int)$gestor['cod_gestor_operador_credito']; ?>"
                                    value="<?php echo (int)$gestor['ptj_gestor_operador_credito']; ?>"
                                    min="0"
                                    max="99"
                                    step="1"
                                    placeholder="0"
                                    onkeydown="if(event.key==='Enter'){ guardarPorcentaje(<?php echo (int)$gestor['cod_gestor_operador_credito']; ?>); }"
                                />
                                <span class="ptj-symbol">%</span>
                            </div>
                        </td>
                        <td data-label="Estado">
                            <?php if ($gestor['cod_estado'] == '1'): ?>
                                <span class="estado-badge estado-activo"><i class="fa-solid fa-circle-check" style="font-size:0.65rem;"></i> Activo</span>
                            <?php else: ?>
                                <span class="estado-badge estado-inactivo"><i class="fa-solid fa-circle-xmark" style="font-size:0.65rem;"></i> Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td class="col-accion">
                            <button
                                class="btn-save-row"
                                id="btn_<?php echo (int)$gestor['cod_gestor_operador_credito']; ?>"
                                onclick="guardarPorcentaje(<?php echo (int)$gestor['cod_gestor_operador_credito']; ?>)"
                                title="Guardar cambio de porcentaje"
                            >
                                <i class="fa-solid fa-floppy-disk"></i> Guardar
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <i class="fa-solid fa-building-columns"></i>
            <p>No hay gestores operadores de crédito registrados en el sistema.</p>
        </div>
        <?php endif; ?>
    </div>

</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<script>
function guardarPorcentaje(codGestor) {
    var inputEl = document.getElementById('ptj_' + codGestor);
    var btnEl   = document.getElementById('btn_' + codGestor);
    var badgeEl = document.getElementById('badge_' + codGestor);

    var nuevoPtj = parseInt(inputEl.value);

    if (isNaN(nuevoPtj) || nuevoPtj < 0 || nuevoPtj > 99) {
        Swal.fire({ icon: 'warning', title: 'Valor inválido', text: 'El porcentaje debe ser un número entero entre 0 y 99.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
        return;
    }

    // Deshabilitar botón mientras procesa
    btnEl.disabled = true;
    btnEl.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Guardando...';

    $.ajax({
        url: '../admin/act_ptj_gestor_operador_credito_ajax.php', type: 'POST', data: { cod_gestor_operador_credito: codGestor, ptj_gestor_operador_credito: nuevoPtj }, dataType: 'json',
        success: function(response) {
            btnEl.disabled = false;
            btnEl.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Guardar';

            if (response.success) {
                // Actualizar badge de valor actual
                badgeEl.innerHTML = '<i class="fa-solid fa-percent" style="font-size:0.65rem;"></i> ' + nuevoPtj;

                // Animación visual de éxito en la fila
                var filaEl = document.getElementById('fila_' + codGestor);
                filaEl.style.background = 'rgba(52, 211, 153, 0.1)';
                setTimeout(function() { filaEl.style.background = ''; }, 2000);

                Swal.fire({ icon: 'success', title: '¡Guardado!', text: 'El porcentaje se actualizó correctamente.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6', timer: 2500, timerProgressBar: true, showConfirmButton: false });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo actualizar el porcentaje. Intente nuevamente.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
            }
        },
        error: function() {
            btnEl.disabled = false;
            btnEl.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Guardar';
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor. Verifique su conexión.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
        }
    });
}
</script>

</body>
</html>
