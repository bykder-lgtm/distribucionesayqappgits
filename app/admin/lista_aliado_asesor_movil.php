<?php 
$nombre_pagina          = "Mis Aliados";
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
<!-- SweetAlert2 CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Quill.js - Rich Text Editor (DESHABILITADO - ya no se usa) -->
<!--
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<style>
/* Estilos para el editor Quill en modo oscuro */
.ql-toolbar.ql-snow {
    background: #f3f4f6;
    border-radius: 12px 12px 0 0;
    border: 1px solid rgba(16, 185, 129, 0.3);
}
.ql-container.ql-snow {
    background: rgba(16, 185, 129, 0.05);
    border-radius: 0 0 12px 12px;
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: white;
    font-family: 'Inter', sans-serif;
    min-height: 150px;
}
.ql-editor.ql-blank::before {
    color: rgba(255,255,255,0.4);
    font-style: normal;
}
</style>
-->

<style>
/* ============================================ */
/* LISTA ALIADOS ASESOR - TEMA VERDE ESMERALDA */
/* ============================================ */

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
    min-height: 100vh;
}

/* SweetAlert z-index fix para que aparezca encima de modales */
.swal-high-zindex {
    z-index: 99999 !important;
}

.page-container {
    padding: 1rem;
    padding-bottom: 100px;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

@media (max-width: 768px) {
    .page-container {
        padding: 0.75rem;
        padding-bottom: 80px;
    }
}

@media (max-width: 480px) {
    .page-container {
        padding: 0.5rem;
        padding-bottom: 70px;
    }
}

/* Header */
.page-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(16, 185, 129, 0.4);
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
    font-size: 1.5rem;
    font-weight: 800;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    z-index: 2;
}

.page-header p {
    color: rgba(255,255,255,0.9);
    font-size: 0.85rem;
    margin: 0.5rem 0 0 0;
    position: relative;
    z-index: 2;
}

.header-stats {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    position: relative;
    z-index: 2;
}

.header-stat {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 12px;
    text-align: center;
}

.header-stat-value {
    font-size: 1.25rem;
    font-weight: 800;
    color: white;
}

.header-stat-label {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
}

/* Search & Filter Container */
.search-filter-container {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

@media (min-width: 641px) {
    .search-filter-container {
        flex-direction: row;
        align-items: stretch;
    }
    .search-filter-container .search-bar {
        flex: 2;
        margin-bottom: 0;
    }
    .search-filter-container .filter-group {
        flex: 1;
    }
}

/* Search Bar */
.search-bar {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 16px;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

.search-bar input {
    flex: 1;
    background: transparent;
    border: none;
    color: white;
    font-size: 0.95rem;
    outline: none;
}

.search-bar input::placeholder {
    color: rgba(255,255,255,0.5);
}

.search-bar i {
    color: #10b981;
    font-size: 1.1rem;
}

/* Add Button */
.add-button {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    border-radius: 16px;
    padding: 1rem;
    width: 100%;
    font-size: 1rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    cursor: pointer;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
}

.add-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 30px rgba(16, 185, 129, 0.5);
}

/* Ally List */
.ally-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

/* En pantallas muy pequeñas, volver a una sola columna */
@media (max-width: 640px) {
    .ally-list {
        grid-template-columns: 1fr;
    }
}

.ally-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 16px;
    padding: 1rem;
    transition: all 0.3s ease;
}

.ally-card:hover {
    border-color: #10b981;
    box-shadow: 0 5px 20px rgba(16, 185, 129, 0.2);
}

.ally-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.75rem;
}

.ally-info {
    flex: 1;
    min-width: 0; /* Permite que el texto se trunque */
}

.ally-name {
    font-size: 1rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.25rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.ally-doc {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.5);
}

.ally-role {
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    white-space: nowrap;
}

.ally-details {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.5rem;
    margin-bottom: 1rem;
    border-top: 1px solid rgba(255,255,255,0.05);
    padding-top: 0.75rem;
}

.ally-detail {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.ally-detail i {
    color: #10b981;
    width: 16px;
    font-size: 0.8rem;
    text-align: center;
}

.ally-detail span {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.8);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Ally Stats */
.ally-stats {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid rgba(16, 185, 129, 0.15);
}

.ally-stat-item {
    flex: 1;
    text-align: center;
    padding: 0.4rem;
    border-radius: 8px;
    background: rgba(16, 185, 129, 0.08);
    cursor: pointer;
    transition: all 0.2s ease;
    border: 1px solid rgba(16, 185, 129, 0.05);
}

.ally-stat-item:hover {
    background: rgba(16, 185, 129, 0.15);
    transform: translateY(-1px);
    border-color: rgba(16, 185, 129, 0.2);
}

.ally-stat-number {
    font-size: 1.1rem;
    font-weight: 700;
    color: #10b981;
    display: block;
}

.ally-stat-label {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.6);
    font-weight: 500;
}

/* Quick Action Buttons */
.ally-quick-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.75rem;
}

.btn-quick-action {
    flex: 1;
    padding: 0.5rem 0.75rem;
    border: none;
    border-radius: 8px;
    font-size: 0.72rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
}

.btn-quick-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.btn-quick-action.btn-tienda {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.btn-quick-action.btn-banco {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
}

/* Modal */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.8);
    backdrop-filter: blur(5px);
    z-index: 2000;
    display: none;
    align-items: flex-end;
    justify-content: center;
}

.modal-overlay.show {
    display: flex;
}

.modal-content {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 24px 24px 0 0;
    width: 100%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 0;
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from { transform: translateY(100%); }
    to { transform: translateY(0); }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid rgba(16, 185, 129, 0.2);
    position: sticky;
    top: 0;
    background: #1a1f2e;
    z-index: 10;
}

.modal-body {
    padding: 1.5rem;
}

.modal-header h2 {
    color: white;
    font-size: 1.25rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
}

.modal-close {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 12px;
    cursor: pointer;
    font-size: 1rem;
}

/* Form Styles */
.form-group {
    margin-bottom: 1rem;
}

.form-label {
    display: block;
    color: rgba(255,255,255,0.8);
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-input, .form-select {
    width: 100%;
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 12px;
    padding: 0.85rem 1rem;
    color: white;
    font-size: 0.95rem;
    outline: none;
    transition: all 0.3s ease;
}

.form-select option {
    background-color: #1a1f2e;
    color: white;
}

.form-input:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

@media (max-width: 640px) {
    .form-row {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 0.5rem;
    }
    .form-group {
        margin-bottom: 0.75rem;
    }
}

.submit-btn {
    width: 100%;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    margin-top: 2rem;
    transition: all 0.3s ease;
}

/* Bottom Navigation */
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

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-state i {
    font-size: 4rem;
    color: rgba(16, 185, 129, 0.3);
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: white;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem;
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

/* Actions */
.ally-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid rgba(255,255,255,0.05);
}

@media (max-width: 480px) {
    .ally-actions {
        gap: 0.4rem;
    }
}

.action-btn {
    flex: 1;
    padding: 0.5rem;
    border-radius: 10px;
    border: none;
    font-size: 0.75rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
    transition: all 0.3s ease;
    text-decoration: none;
}

.action-btn.edit {
    background: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
}

.action-btn.edit:hover {
    background: #3b82f6;
    color: white;
}

.action-btn.view {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
}

.action-btn.view:hover {
    background: #10b981;
    color: white;
}

.action-btn.share {
    background: rgba(99, 102, 241, 0.2);
    color: #6366f1;
}

.action-btn.share:hover {
    background: #6366f1;
    color: white;
    transform: translateY(-2px);
}

.action-btn.create-doc {
    background: rgba(139, 92, 246, 0.2);
    color: #8b5cf6;
}

.action-btn.create-doc:hover {
    background: #8b5cf6;
    color: white;
    transform: translateY(-2px);
}

/* Detail Modal Specifics */
.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label-modal {
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem;
}

.detail-value-modal {
    color: white;
    font-weight: 600;
    text-align: right;
}

/* Estilos para selects - Solucionar visibilidad de opciones */
select option {
    background-color: #1a1f2e !important;
    color: #ffffff !important;
    padding: 8px !important;
}

select option:hover,
select option:focus,
select option:checked {
    background-color: #10b981 !important;
    color: #ffffff !important;
}

/* Selects en formularios */
.form-select option {
    background-color: #1a1f2e !important;
    color: #ffffff !important;
}

/* Selects inline de edición */
select[id^="edit_departamento_tienda_"] option,
select[id^="edit_municipio_tienda_"] option {
    background-color: #1a1f2e !important;
    color: #ffffff !important;
    padding: 8px !important;
}

/* ========== MODALES REGISTRO VENDEDOR/PRODUCTO ========== */
.reg-modal-overlay-aliado {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.85);
    backdrop-filter: blur(8px);
    z-index: 5500;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}
.reg-modal-overlay-aliado.show { display: flex; }

.reg-modal-container-aliado {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 20px;
    width: 100%;
    max-width: 550px;
    max-height: 90vh;
    overflow-y: auto;
    animation: regModalFadeIn 0.3s ease;
    border: 1px solid rgba(255,255,255,0.08);
}

@keyframes regModalFadeIn {
    from { opacity: 0; transform: scale(0.92) translateY(20px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}

.reg-modal-header-aliado {
    padding: 1.25rem 1.5rem;
    border-radius: 20px 20px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.reg-modal-header-aliado.vendedor-theme {
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
}
.reg-modal-header-aliado.producto-theme {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}
.reg-modal-header-aliado.firma-theme {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
}
.reg-modal-header-aliado h2 {
    color: white; font-size: 1.15rem; font-weight: 700;
    display: flex; align-items: center; gap: 0.5rem; margin: 0;
}
.reg-modal-header-aliado .modal-close-reg {
    background: rgba(255,255,255,0.2); color: white;
    border: none; width: 36px; height: 36px; border-radius: 10px;
    cursor: pointer; font-size: 0.95rem;
    display: flex; align-items: center; justify-content: center;
}

.reg-modal-body-aliado { padding: 1.5rem; }

.reg-modal-body-aliado .reg-form-input,
.reg-modal-body-aliado .reg-form-select {
    width: 100%;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    padding: 0.8rem 1rem;
    color: white;
    font-size: 0.9rem;
    outline: none;
    transition: all 0.3s ease;
    font-family: 'Inter', sans-serif;
}
.reg-modal-body-aliado .reg-form-input:focus { border-color: #f97316; box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2); }
.reg-modal-body-aliado.producto-body .reg-form-input:focus,
.reg-modal-body-aliado.producto-body .reg-form-select:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2); }
.reg-modal-body-aliado .reg-form-input::placeholder { color: rgba(255,255,255,0.35); }

.reg-form-select {
    appearance: none; cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23f97316' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1rem;
    background-color: #1a1f2e;
}
.reg-form-select option { background-color: #1a1f2e; color: white; }

.reg-form-label { display: block; color: rgba(255,255,255,0.75); font-size: 0.82rem; font-weight: 600; margin-bottom: 0.4rem; }
.reg-form-group { margin-bottom: 0.9rem; }
.reg-form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }

@media (max-width: 640px) {
    .reg-form-row {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 0.5rem;
    }
    .reg-form-group {
        margin-bottom: 0.7rem;
    }
}

.reg-submit-btn-aliado {
    width: 100%; color: white; border: none; padding: 0.85rem;
    border-radius: 12px; font-size: 0.9rem; font-weight: 700;
    cursor: pointer; margin-top: 1rem; transition: all 0.3s ease;
    display: flex; align-items: center; justify-content: center; gap: 0.5rem;
    font-family: 'Inter', sans-serif;
}
.reg-submit-btn-aliado.vendedor-theme { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4); }
.reg-submit-btn-aliado.vendedor-theme:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(249, 115, 22, 0.5); }
.reg-submit-btn-aliado.producto-theme { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4); }
.reg-submit-btn-aliado.producto-theme:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5); }

.reg-tienda-badge-aliado {
    background: rgba(255,255,255,0.1);
    padding: 0.5rem 1rem; border-radius: 12px;
    margin-bottom: 1.25rem; display: flex;
    align-items: center; gap: 0.5rem;
    font-size: 0.82rem; color: rgba(255,255,255,0.8);
}
.reg-tienda-badge-aliado i { color: #10b981; }
.reg-tienda-badge-aliado strong { color: white; }

.reg-items-list-aliado { margin-top: 1.25rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 0.75rem; }
.reg-items-list-title { font-size: 0.78rem; font-weight: 700; color: rgba(255,255,255,0.55); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.6rem; display: flex; align-items: center; gap: 0.5rem; }
.reg-items-list-title .reg-badge-count { background: rgba(255,255,255,0.15); padding: 0.1rem 0.45rem; border-radius: 8px; font-size: 0.72rem; }

.reg-item-card {
    background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px; padding: 0.65rem 0.85rem; margin-bottom: 0.4rem;
    display: flex; align-items: center; gap: 0.65rem;
    animation: regFadeInUp 0.3s ease;
}
@keyframes regFadeInUp { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
.reg-item-card.existente { opacity: 0.75; }
.reg-item-icon { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.reg-item-icon.vendedor-new { background: linear-gradient(135deg, rgba(249, 115, 22, 0.3), rgba(234, 88, 12, 0.3)); color: #fb923c; }
.reg-item-icon.vendedor-exist { background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2)); color: #10b981; }
.reg-item-icon.producto-new { background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(37, 99, 235, 0.3)); color: #60a5fa; }
.reg-item-icon.producto-exist { background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2)); color: #10b981; }
.reg-item-info { flex: 1; min-width: 0; }
.reg-item-info h5 { color: white; font-size: 0.82rem; font-weight: 600; margin: 0 0 0.1rem 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.reg-item-info span { color: rgba(255,255,255,0.4); font-size: 0.72rem; }
.reg-item-check { color: #22c55e; font-size: 0.9rem; }

.reg-modal-footer-aliado { padding: 0 1.5rem 1.25rem; display: flex; gap: 0.6rem; }
.reg-footer-btn-aliado { flex: 1; padding: 0.7rem; border-radius: 10px; border: none; font-size: 0.82rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.35rem; transition: all 0.3s ease; font-family: 'Inter', sans-serif; }
.reg-footer-btn-aliado.back-btn { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.1); }
.reg-footer-btn-aliado.back-btn:hover { background: rgba(255,255,255,0.12); color: white; }
.reg-footer-btn-aliado.finish-btn { background: rgba(34, 197, 94, 0.15); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.3); }
.reg-footer-btn-aliado.finish-btn:hover { background: rgba(34, 197, 94, 0.25); }
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Obtener parámetros de búsqueda
$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conectar, $_GET['busqueda']) : '';
$filtro_doc = isset($_GET['filtro_doc']) ? mysqli_real_escape_string($conectar, $_GET['filtro_doc']) : '';
// --- CONFIGURACIÓN DE PAGINACIÓN ---
$registros_por_pagina = 12;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_actual < 1) $pagina_actual = 1;
$offset = ($pagina_actual - 1) * $registros_por_pagina;
// Primero obtenemos el TOTAL DE REGISTROS para la paginación (con filtros)
$sql_count = "SELECT COUNT(*) as total FROM tbl15_administrador a WHERE a.cod_asesor = '$cod_administrador' AND a.cod_seguridad = '23' AND a.cod_estado != '0'";
if (!empty($busqueda)) { $sql_count .= " AND (a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%')"; }
if ($filtro_doc == '1') { $sql_count .= " AND (a.url_documentacion_rut_aliado != '' OR a.url_documentacion_camaracomercio_aliado != '')"; } elseif ($filtro_doc == '2') { $sql_count .= " AND (a.url_documentacion_rut_aliado != '' AND a.url_documentacion_camaracomercio_aliado != '')"; } elseif ($filtro_doc == '3') { $sql_count .= " AND (a.url_documentacion_rut_aliado = '' AND a.url_documentacion_camaracomercio_aliado = '')"; }
$res_count = mysqli_query($conectar, $sql_count);
$total_registros_filtrados = ($res_count) ? mysqli_fetch_assoc($res_count)['total'] : 0;
$total_paginas = ceil($total_registros_filtrados / $registros_por_pagina);
// Consulta de aliados asignados a este asesor
// La versión de escritorio filtra por cod_asesor = $cod_administrador
$sql = "SELECT a.cod_administrador, a.cedula, a.nombres, a.apellidos, a.cuenta, a.correo, a.telefono, a.nombres_apellidos_tercero, a.cod_estado_activacion_usuario, a.cod_estado_usuario_prueba, a.comision_ptj, a.cod_asesor, a.url_documentacion_rut_aliado, a.url_documentacion_camaracomercio_aliado, a.url_documentacion_cedula_aliado, a.nombre_tipo_cliente, a.nombre_tipo_identificacion, a.cod_tipo_sector, a.nit_razon_social, a.nombre_razon_social, a.direccion_tercero, a.barrio_tercero, a.cod_departamento, a.cod_municipio, a.fecha, a.fecha_hora FROM tbl15_administrador a WHERE a.cod_asesor = '$cod_administrador' AND a.cod_seguridad = '23' AND a.cod_estado != '0'";
if (!empty($busqueda)) { $sql .= " AND (a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%')"; }
// Filtro de documentación
if ($filtro_doc == '1') { $sql .= " AND (a.url_documentacion_rut_aliado != '' OR a.url_documentacion_camaracomercio_aliado != '' OR (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))"; } elseif ($filtro_doc == '2') { $sql .= " AND (a.url_documentacion_rut_aliado != '' AND a.url_documentacion_camaracomercio_aliado != '' AND (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))"; } elseif ($filtro_doc == '3') { $sql .= " AND (a.url_documentacion_rut_aliado = '' AND a.url_documentacion_camaracomercio_aliado = '' AND (a.url_documentacion_cedula_aliado IS NULL OR a.url_documentacion_cedula_aliado = ''))"; }
$sql .= " ORDER BY a.cod_administrador DESC LIMIT $registros_por_pagina OFFSET $offset";
$resultado = mysqli_query($conectar, $sql);
// Si la consulta falla (posiblemente porque el campo url_documentacion_cedula_aliado no existe), intentar sin ese campo
if (!$resultado) {
    $sql = "SELECT a.cod_administrador, a.cedula, a.nombres, a.apellidos, a.cuenta, a.correo, a.telefono, a.nombres_apellidos_tercero, a.cod_estado_activacion_usuario, a.cod_estado_usuario_prueba, a.comision_ptj, 
    a.cod_asesor, a.url_documentacion_rut_aliado, a.url_documentacion_camaracomercio_aliado, a.nombre_tipo_cliente, a.nombre_tipo_identificacion, a.cod_tipo_sector, a.nit_razon_social, a.nombre_razon_social, a.direccion_tercero, a.barrio_tercero, a.cod_departamento, a.cod_municipio, a.fecha, a.fecha_hora FROM tbl15_administrador a WHERE a.cod_asesor = '$cod_administrador' AND a.cod_seguridad = '23' AND a.cod_estado != '0'";
    if (!empty($busqueda)) { $sql .= " AND (a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%')"; }
    // Filtro de documentación (sin el campo de cédula)
    if ($filtro_doc == '1') { $sql .= " AND (a.url_documentacion_rut_aliado != '' OR a.url_documentacion_camaracomercio_aliado != '')"; } elseif ($filtro_doc == '2') { $sql .= " AND (a.url_documentacion_rut_aliado != '' AND a.url_documentacion_camaracomercio_aliado != '')"; } elseif ($filtro_doc == '3') { $sql .= " AND (a.url_documentacion_rut_aliado = '' AND a.url_documentacion_camaracomercio_aliado = '')"; }
    $sql .= " ORDER BY a.cod_administrador DESC LIMIT $registros_por_pagina OFFSET $offset";
    $resultado = mysqli_query($conectar, $sql);
}
$registros_en_pagina = $resultado ? mysqli_num_rows($resultado) : 0;

// Consulta original sin LIMIT para saber el TOTAL TOTAL (para el header)
$sql_total_base = "SELECT COUNT(*) as total FROM tbl15_administrador WHERE cod_asesor = '$cod_administrador' AND cod_seguridad = '23' AND cod_estado != '0'";
$res_total_base = mysqli_query($conectar, $sql_total_base);
$total_aliados_header = ($res_total_base) ? mysqli_fetch_assoc($res_total_base)['total'] : 0;
// --- TOTALES PARA EL HEADER ---
// Tiendas totales de los aliados de este asesor
$sql_total_tiendas = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_aliado_estrategico IN (SELECT cod_administrador FROM tbl15_administrador WHERE cod_asesor = '$cod_administrador' AND cod_seguridad = '23' AND cod_estado != '0')";
$res_total_tiendas = mysqli_query($conectar, $sql_total_tiendas);
$total_tiendas_header = ($res_total_tiendas) ? mysqli_fetch_assoc($res_total_tiendas)['total'] : 0;
// Cuentas bancarias totales de los aliados de este asesor
$sql_total_bancos = "SELECT COUNT(*) as total FROM tbl15_banco_cuenta WHERE cod_aliado_estrategico IN (SELECT cod_administrador FROM tbl15_administrador WHERE cod_asesor = '$cod_administrador' AND cod_seguridad = '23') AND cod_estado = '1'";
$res_total_bancos = mysqli_query($conectar, $sql_total_bancos);
$total_bancos_header = ($res_total_bancos) ? mysqli_fetch_assoc($res_total_bancos)['total'] : 0;
// -----------------------------
// Consultas para combos - Líder (20)
$sql_lider = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '20' AND cod_estado != '0' ORDER BY cod_administrador DESC";
$res_lider = mysqli_query($conectar, $sql_lider);
// Consultas para combos - Coordinador (21)
$sql_coord = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '21' AND cod_estado != '0' ORDER BY cod_administrador DESC";
$res_coord = mysqli_query($conectar, $sql_coord);
// Consultas para combos - Asesor (22)// Por defecto se preselecciona el actual
$sql_asesor = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '22' AND cod_estado != '0' ORDER BY cod_administrador DESC";
$res_asesor = mysqli_query($conectar, $sql_asesor);
// Consulta de entidades crediticias
$sql_entidades = "SELECT cod_entidad_crediticia, nombre_entidad_crediticia, url_pagina_web_consulta, aliado_estrategico_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado = '1' ORDER BY cod_posicion ASC";
$res_entidades = mysqli_query($conectar, $sql_entidades);
// Consulta de entidades crediticias
$sql_entidades = "SELECT cod_entidad_crediticia, nombre_entidad_crediticia, url_pagina_web_consulta, aliado_estrategico_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado = '1' ORDER BY cod_posicion ASC";
$res_entidades = mysqli_query($conectar, $sql_entidades);
// Consulta de bancos disponibles
$sql_bancos = "SELECT cod_banco, nombre_banco FROM tbl15_banco WHERE cod_estado = '1' ORDER BY cod_posicion ASC";
$res_bancos = mysqli_query($conectar, $sql_bancos);
// Consulta de tipos de cliente
$sql_tipo_cliente = "SELECT cod_tipo_cliente, nombre_tipo_cliente FROM tbl15_tipo_cliente WHERE cod_estado = '1' ORDER BY cod_tipo_cliente ASC";
$res_tipo_cliente = mysqli_query($conectar, $sql_tipo_cliente);
// Consulta de tipos de sector
$sql_tipo_sector = "SELECT cod_tipo_sector, nombre_tipo_sector, descripcion_tipo_sector FROM tbl15_tipo_sector WHERE cod_estado = '1' ORDER BY cod_tipo_sector ASC";
$res_tipo_sector = mysqli_query($conectar, $sql_tipo_sector);
// Consulta de tipos de sector
$sql_tipo_identificacion = "SELECT cod_tipo_doc, tipo_doc_abrev, nombre_tipo_doc FROM tbl15_tipo_doc ORDER BY cod_tipo_doc ASC";
$res_tipo_identificacion = mysqli_query($conectar, $sql_tipo_identificacion);
?>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-users"></i> Mis Aliados</h1><p>Gestiona tu red de aliados estratgicos (Total: <?php echo $total_aliados_header; ?>)</p>
        <div class="header-stats">
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $total_registros_filtrados; ?></div><div class="header-stat-label">Encontrados</div></div>
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $total_tiendas_header; ?></div>
                <div class="header-stat-label">Tiendas</div>
            </div>
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $total_bancos_header; ?></div>
                <div class="header-stat-label">Cuentas</div>
            </div>
        </div>
    </div>

    <!-- Search Bar and Filter -->
    <div class="search-filter-container animate-in delay-1">
        <div class="search-bar">
            <i class="fa-solid fa-search"></i>
            <input type="text" id="searchInput" placeholder="Buscar aliado..." value="<?php echo htmlspecialchars($busqueda); ?>" onkeyup="filtrar()">
        </div>
        <div class="filter-group">
            <select id="filtroDoc" class="form-select" onchange="filtrar()" style="height: 100%;">
                <option value="" <?php echo $filtro_doc == '' ? 'selected' : ''; ?>>Todos los documentos</option>
                <option value="1" <?php echo $filtro_doc == '1' ? 'selected' : ''; ?>>Con documentación (Al menos uno)</option>
                <option value="2" <?php echo $filtro_doc == '2' ? 'selected' : ''; ?>>Documentación completa (Los 3)</option>
                <option value="3" <?php echo $filtro_doc == '3' ? 'selected' : ''; ?>>Sin documentación</option>
            </select>
        </div>
    </div>
    <!-- Botones de Acción -->
    <div style="display: flex; gap: 0.75rem; margin-bottom: 1.5rem;" class="animate-in delay-1">
        <button class="add-button" style="margin-bottom: 0; flex: 1.5;" onclick="abrirModal()">
            <i class="fa-solid fa-plus"></i> Registrar Nuevo Aliado
        </button>
        <!--
        <button class="add-button" style="margin-bottom: 0; flex: 1; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);" onclick="abrirModalRapido()">
            <i class="fa-solid fa-bolt"></i> Registro Rápido
        </button>
-->
        <a href="lista_firma_digital_documentos_asesor_movil.php" class="add-button" style="margin-bottom: 0; flex: 1; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; text-decoration: none;">
            <i class="fa-solid fa-file-signature"></i> Ver Firmas
        </a>
    </div>

    <!-- List -->
    <div class="ally-list" id="allyList">
        <?php if ($registros_en_pagina > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($resultado)): 
                $nombre_completo = !empty($row['nombres_apellidos_tercero']) ? $row['nombres_apellidos_tercero'].' ('.$row['nombres'].' '.$row['apellidos'].')' : trim($row['nombres'].' '.$row['apellidos']);
                $cod_estado = $row['cod_estado_activacion_usuario'];
                // Determinar estado y colores
                if ($cod_estado == '1') { $estado_texto = 'Activo'; $estado_bg = 'rgba(16, 185, 129, 0.2)'; $estado_color = '#10b981'; } elseif ($cod_estado == '2') { $estado_texto = 'En Espera'; $estado_bg = 'rgba(245, 158, 11, 0.2)'; $estado_color = '#f59e0b'; } else { $estado_texto = 'Inactivo'; $estado_bg = 'rgba(239, 68, 68, 0.2)'; $estado_color = '#ef4444'; }
                // Obtener tiendas asociadas a este aliado
                $cod_aliado = $row['cod_administrador'];
                $sql_tiendas = "SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE cod_aliado_estrategico = '$cod_aliado' LIMIT 3";
                $res_tiendas = mysqli_query($conectar, $sql_tiendas);
                $tiendas_arr = [];
                while($t = mysqli_fetch_assoc($res_tiendas)) { $tiendas_arr[] = '<a href="ver_detalle_tienda_movil.php?cod_tienda=' . $t['cod_tienda'] . '" style="color: #10b981; text-decoration: underline; font-weight: 600;">' . htmlspecialchars($t['nombre_tienda']) . '</a>'; }
                $tiendas_texto = count($tiendas_arr) > 0 ? implode(', ', $tiendas_arr) : 'Sin tiendas';
                
                // --- NUEVAS ESTADÍSTICAS ---
                // Contar tiendas totales de este aliado
                $sql_count_tiendas = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_aliado_estrategico = '$cod_aliado'";
                $res_count_tiendas = mysqli_query($conectar, $sql_count_tiendas);
                $total_tiendas_aliado = ($res_count_tiendas) ? mysqli_fetch_assoc($res_count_tiendas)['total'] : 0;
                
                // Contar cuentas bancarias de este aliado
                $sql_count_bancos = "SELECT COUNT(*) as total FROM tbl15_banco_cuenta WHERE cod_aliado_estrategico = '$cod_aliado' AND cod_estado = '1'";
                $res_count_bancos = mysqli_query($conectar, $sql_count_bancos);
                $total_bancos_aliado = ($res_count_bancos) ? mysqli_fetch_assoc($res_count_bancos)['total'] : 0;
                // ---------------------------

                // Obtener líneas de crédito asociadas a este aliado
                $sql_lineas_credito = "SELECT ec.nombre_entidad_crediticia, peca.interes_ptj 
                FROM tbl15_parametrizacion_entidad_crediticia_aliado peca INNER JOIN tbl15_entidad_crediticia ec ON peca.cod_entidad_crediticia = ec.cod_entidad_crediticia 
                WHERE peca.cod_aliado_estrategico = '$cod_aliado' AND peca.cod_estado = '1' ORDER BY ec.cod_posicion ASC";
                $res_lineas_credito = mysqli_query($conectar, $sql_lineas_credito);
                $lineas_credito_html = '';
                $count_lineas = 0;
                while($lc = mysqli_fetch_assoc($res_lineas_credito)) { 
                    $lineas_credito_html .= '<span style="display: inline-block; background: rgba(16, 185, 129, 0.15); color: #10b981; padding: 0.2rem 0.5rem; border-radius: 8px; font-size: 0.7rem; font-weight: 600; margin: 0.15rem;">' . htmlspecialchars($lc['nombre_entidad_crediticia']) . ' <strong>' . number_format($lc['interes_ptj'], 2) . '%</strong></span> ';
                    $count_lineas++;
                }
                $lineas_credito_texto = $count_lineas > 0 ? $lineas_credito_html : '<span style="color: rgba(255,255,255,0.5); font-size: 0.75rem;">Sin entidades</span>';
            ?>
            <div class="ally-card animate-in delay-2">
                <div class="ally-header">
                    <div class="ally-info">
                        <div class="ally-name"><?php echo ucwords(strtolower($nombre_completo)); ?></div>
                        <div class="ally-doc">CC: <?php echo $row['cedula']; ?></div>
                    </div>
                    <span class="ally-role" style="background: <?php echo $estado_bg; ?>; color: <?php echo $estado_color; ?>;">
                        <?php echo $estado_texto; ?>
                    </span>
                    <?php if ($row['cod_estado_usuario_prueba'] == '1'): ?>
                    <span class="ally-role" style="background: rgba(245, 158, 11, 0.2); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); margin-left: 0.5rem;">
                        <i class="fa-solid fa-bolt" style="margin-right: 0.25rem;"></i> PRUEBA
                    </span>
                    <?php endif; ?>
                </div>
                
                <div class="ally-details">
                    <?php if(!empty($row['telefono'])): ?><div class="ally-detail"><i class="fa-solid fa-phone"></i><span><?php echo $row['telefono']; ?></span></div><?php endif; ?>
                    <?php if(!empty($row['correo'])): ?><div class="ally-detail"><i class="fa-solid fa-envelope"></i><span><?php echo strtolower($row['correo']); ?></span></div><?php endif; ?>
                    <?php if(!empty($row['cuenta'])): ?><div class="ally-detail"><i class="fa-solid fa-building-columns"></i><span>Usuario: <?php echo $row['cuenta']; ?></span></div><?php endif; ?>
                    <div class="ally-detail"><i class="fa-solid fa-store"></i><span><?php echo $tiendas_texto; ?></span></div>
                    <?php if(!empty($row['fecha'])): ?><div class="ally-detail"><i class="fa-solid fa-calendar-plus" style="color: #f59e0b;"></i><span>Registrado: <?php echo date('d/m/Y', strtotime($row['fecha'])); ?></span></div><?php endif; ?>
                    <!--
                    <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 0.5rem; padding-top: 0.5rem;">
                        <div style="display: flex; align-items: flex-start; gap: 0.5rem; margin-bottom: 0.25rem;">
                            <i class="fa-solid fa-credit-card" style="color: #10b981; font-size: 0.8rem; margin-top: 0.25rem; flex-shrink: 0;"></i>
                            <div style="flex: 1; min-width: 0;">
                                <div style="color: rgba(255,255,255,0.7); font-size: 0.75rem; font-weight: 600; margin-bottom: 0.35rem;">Líneas de Crédito:</div>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; line-height: 1.4;">
                                    <?php echo $lineas_credito_texto; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

                <div class="ally-stats">
                    <div class="ally-stat-item" onclick="abrirModalVerTiendas(<?php echo $row['cod_administrador']; ?>, '<?php echo addslashes($row['nombres_apellidos_tercero']); ?>')">
                        <span class="ally-stat-number"><?php echo $total_tiendas_aliado; ?></span>
                        <span class="ally-stat-label">Tiendas</span>
                    </div>
                    <div class="ally-stat-item" onclick="abrirModalVerCuentas(<?php echo $row['cod_administrador']; ?>, '<?php echo addslashes($row['nombres_apellidos_tercero']); ?>')">
                        <span class="ally-stat-number"><?php echo $total_bancos_aliado; ?></span>
                        <span class="ally-stat-label">Cuentas</span>
                    </div>
                </div>

                <div class="ally-quick-actions">
                    <button class="btn-quick-action btn-tienda" onclick="window.location.href='lista_tienda_asesor_movil.php?registrar_tienda=1&cod_aliado=<?php echo $row['cod_administrador']; ?>'">
                        <i class="fa-solid fa-store"></i> +Tienda
                    </button>
                    <button class="btn-quick-action btn-banco" onclick="abrirModalAgregarBanco(<?php echo $row['cod_administrador']; ?>)">
                        <i class="fa-solid fa-university"></i> +Banco
                    </button>
                </div>

                <div class="ally-actions">
                    <a href="ver_detalle_aliado_movil.php?cod_administrador=<?php echo $row['cod_administrador']; ?>" class="action-btn view"><i class="fa-solid fa-eye"></i> Detalles</a>
                    <button class="action-btn edit" onclick="abrirModalEditar(<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>)"><i class="fa-solid fa-edit"></i> Editar Todo</button>
                    <?php if ($row['cod_estado_usuario_prueba'] == '1'): ?>
                    <button class="action-btn" style="background: #10b981; color: white;" onclick="habilitarAliado(<?php echo $row['cod_administrador']; ?>, '<?php echo addslashes($row['nombres_apellidos_tercero']); ?>')">
                        <i class="fa-solid fa-check-circle"></i> Habilitar
                    </button>
                    <?php endif; ?>
                    <button class="action-btn create-doc" onclick="crearDocumento(<?php echo $row['cod_administrador']; ?>)"><i class="fa-solid fa-file-signature"></i> Firma</button>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state"><i class="fa-solid fa-users-slash"></i><h3>No hay aliados</h3><p>No se encontraron registros</p></div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_paginas > 1): ?>
    <div class="pagination-container animate-in delay-3">
        <a href="?pagina=1<?php echo (!empty($busqueda) ? '&busqueda='.urlencode($busqueda) : '').(!empty($filtro_doc) ? '&filtro_doc='.urlencode($filtro_doc) : ''); ?>" 
           class="pagination-btn <?php echo ($pagina_actual <= 1) ? 'disabled' : ''; ?>" title="Primera página">
            <i class="fa-solid fa-angles-left"></i>
        </a>
        
        <a href="?pagina=<?php echo $pagina_actual - 1; ?><?php echo (!empty($busqueda) ? '&busqueda='.urlencode($busqueda) : '').(!empty($filtro_doc) ? '&filtro_doc='.urlencode($filtro_doc) : ''); ?>" 
           class="pagination-btn <?php echo ($pagina_actual <= 1) ? 'disabled' : ''; ?>" title="Página anterior">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        
        <div class="pagination-info">
            Pág. <span><?php echo $pagina_actual; ?></span> de <span><?php echo $total_paginas; ?></span>
        </div>
        
        <a href="?pagina=<?php echo $pagina_actual + 1; ?><?php echo (!empty($busqueda) ? '&busqueda='.urlencode($busqueda) : '').(!empty($filtro_doc) ? '&filtro_doc='.urlencode($filtro_doc) : ''); ?>" 
           class="pagination-btn <?php echo ($pagina_actual >= $total_paginas) ? 'disabled' : ''; ?>" title="Siguiente página">
            <i class="fa-solid fa-chevron-right"></i>
        </a>
        
        <a href="?pagina=<?php echo $total_paginas; ?><?php echo (!empty($busqueda) ? '&busqueda='.urlencode($busqueda) : '').(!empty($filtro_doc) ? '&filtro_doc='.urlencode($filtro_doc) : ''); ?>" 
           class="pagination-btn <?php echo ($pagina_actual >= $total_paginas) ? 'disabled' : ''; ?>" title="Última página">
            <i class="fa-solid fa-angles-right"></i>
        </a>
    </div>
    <?php endif; ?>
</main>
<!-- Modal Registro -->
<div class="modal-overlay" id="modalRegistro" style="align-items: flex-start; padding-top: 20px;">
    <div class="modal-content">
        <div class="modal-header"><h2><i class="fa-solid fa-user-plus"></i> Nuevo Aliado</h2><button class="modal-close" onclick="cerrarModal()"><i class="fa-solid fa-times"></i></button></div>
        
        <div class="modal-body">
            <form id="formRegistro">
                <input type="hidden" name="tabla" value="tbl15_administrador">
                <input type="hidden" name="cod_seguridad" value="25">
                <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo de Cliente *</label>
                        <select class="form-select" id="nombre_tipo_cliente" name="nombre_tipo_cliente" required onchange="cambiarTipoCliente()">
                            <option value="">Seleccione...</option>
                            <?php 
                            mysqli_data_seek($res_tipo_cliente, 0);
                            while ($tipo_cliente = mysqli_fetch_assoc($res_tipo_cliente)): 
                            ?>
                            <option value="<?php echo $tipo_cliente['nombre_tipo_cliente']; ?>"><?php echo $tipo_cliente['nombre_tipo_cliente']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipo de Sector *</label>
                        <select class="form-select" id="cod_tipo_sector" name="cod_tipo_sector" required>
                            <option value="">Seleccione...</option>
                            <?php 
                            mysqli_data_seek($res_tipo_sector, 0);
                            while ($tipo_sector = mysqli_fetch_assoc($res_tipo_sector)): 
                            ?>
                            <option value="<?php echo $tipo_sector['cod_tipo_sector']; ?>" title="<?php echo htmlspecialchars($tipo_sector['descripcion_tipo_sector']); ?>"><?php echo $tipo_sector['nombre_tipo_sector']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" id="label_nombre_comercial">Nombre Comercial *</label>
                        <input type="text" class="form-input" id="nombres_apellidos_tercero" name="nombres_apellidos_tercero" required>
                        <small id="mensaje_identificacion_comercial" style="display:none; color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;"></small>
                    </div>
                    <div class="form-group" style="padding-top: 1.6rem;">
                        <div style="background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.25); border-radius: 12px; padding: 0.75rem 1rem;">
                            <label style="display: flex; align-items: center; gap: 0.6rem; cursor: pointer; margin: 0;">
                                <input type="checkbox" id="crear_tienda_al_guardar" name="crear_tienda_al_guardar" value="1" checked style="accent-color: #10b981; width: 18px; height: 18px; cursor: pointer;">
                                <span style="color: rgba(255,255,255,0.95); font-size: 0.85rem; font-weight: 600;"><i class="fa-solid fa-store" style="color: #10b981; margin-right: 0.25rem;"></i> Crear Tienda</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" id="container_nit_razon_social" style="display:none;">
                        <label class="form-label">NIT Razón Social *</label>
                        <input type="text" class="form-input" id="nit_razon_social" name="nit_razon_social">
                    </div>
                    <div class="form-group" id="container_nombre_razon_social" style="display:none;">
                        <label class="form-label">Razón Social *</label>
                        <input type="text" class="form-input" id="nombre_razon_social" name="nombre_razon_social">
                    </div>
                </div>



                <label class="form-label" style="color: #10b981; font-weight: 700; margin-bottom: 0.75rem; display: block;"><i class="fa-solid fa-building-columns"></i> Datos del Representante Legal</label>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Identificación *</label>
                        <input type="number" class="form-input" id="identificacion_tercero" name="identificacion_tercero" required>
                        <small id="mensaje_identificacion" style="display:none; color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;"></small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipo de Documento *</label>
                        <select class="form-select" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" required>
                            <option value="">Seleccione...</option>
                            <?php 
                            mysqli_data_seek($res_tipo_identificacion, 0);
                            while ($tipo_identificacion = mysqli_fetch_assoc($res_tipo_identificacion)): 
                            ?>
                            <option value="<?php echo $tipo_identificacion['tipo_doc_abrev']; ?>" title="<?php echo htmlspecialchars($tipo_identificacion['tipo_doc_abrev']); ?>"><?php echo $tipo_identificacion['nombre_tipo_doc']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-input" name="nombre1_tercero" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellido *</label>
                        <input type="text" class="form-input" name="apellido1_tercero" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" name="telefono1_tercero" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo *</label>
                        <input type="email" class="form-input" name="correo_tercero" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Departamento *</label>
                        <select class="form-select" id="cod_departamento" name="cod_departamento" required onchange="cargarMunicipiosRegistro(this.value)">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Municipio *</label>
                        <select class="form-select" id="cod_municipio" name="cod_municipio" required>
                            <option value="">Primero seleccione departamento</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Dirección *</label>
                        <input type="text" class="form-input" id="direccion_tercero" name="direccion_tercero" placeholder="Ej: Cra 10 #20-30" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Barrio *</label>
                        <input type="text" class="form-input" id="barrio_tercero" name="barrio_tercero" placeholder="Ej: Centro, Santa Isabel..." required>
                    </div>
                </div>

                <!-- Parametrización de Lineas de Credito -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <label class="form-label" style="color: #10b981; font-weight: 700; margin-bottom: 0.75rem; display: block;"><i class="fa-solid fa-building-columns"></i> Lineas de Credito</label>
                    <div style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 0.75rem; max-height: 350px; overflow-y: auto;">
                        <?php 
                        mysqli_data_seek($res_entidades, 0);
                        while ($entidad = mysqli_fetch_assoc($res_entidades)): 
                        ?>
                        <div style="display: grid; grid-template-columns: auto 1fr auto auto auto; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem; padding: 0.6rem 0.75rem; background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.15); border-radius: 10px;">
                            <input type="checkbox" name="entidades[]" value="<?php echo $entidad['cod_entidad_crediticia']; ?>" id="ent_<?php echo $entidad['cod_entidad_crediticia']; ?>" style="accent-color: #10b981; width: 18px; height: 18px; cursor: pointer; margin: 0;">
                            <label for="ent_<?php echo $entidad['cod_entidad_crediticia']; ?>" style="color: rgba(255,255,255,0.95); font-size: 0.9rem; font-weight: 600; cursor: pointer; margin: 0;">
                                <?php echo $entidad['nombre_entidad_crediticia']; ?>
                            </label>
                            <div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">
                                <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">% Adtvo:</label>
                                <input type="number" step="0.01" min="0" max="100" class="form-input" name="interes_<?php echo $entidad['cod_entidad_crediticia']; ?>" value="<?php echo $entidad['aliado_estrategico_interes_ptj']; ?>" placeholder="0.00" style="width: 70px; padding: 0.3rem 0.4rem; font-size: 0.8rem; text-align: center;">
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">
                                <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">Portal:</label>
                                <input type="checkbox" name="cod_estado_entrar_portal_<?php echo $entidad['cod_entidad_crediticia']; ?>" value="1" style="accent-color: #10b981; width: 16px; height: 16px; cursor: pointer; margin: 0;" title="Acceso al portal">
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #10b981; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Selecciona las lineas de credito disponibles para este aliado e ingresa el porcentaje de interés correspondiente.
                        </div>
                    </div>
                </div>

                <!-- Parametrización de Bancos -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <label class="form-label" style="color: #10b981; font-weight: 700; margin-bottom: 0.75rem; display: block;">
                        <i class="fa-solid fa-university"></i> Cuentas Bancarias
                    </label>
                    <div id="contenedor_bancos" style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 0.75rem; max-height: 350px; overflow-y: auto;">
                        <?php 
                        if ($res_bancos && mysqli_num_rows($res_bancos) > 0) {
                            mysqli_data_seek($res_bancos, 0);
                            while ($banco = mysqli_fetch_assoc($res_bancos)): 
                        ?>
                        <div style="margin-bottom: 0.5rem; padding: 0.6rem 0.75rem; background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.15); border-radius: 10px;">
                            <div style="display: grid; grid-template-columns: auto 1fr auto auto; align-items: center; gap: 0.75rem;">
                                <input type="checkbox" name="bancos[]" value="<?php echo $banco['cod_banco']; ?>" id="banco_<?php echo $banco['cod_banco']; ?>" style="accent-color: #10b981; width: 18px; height: 18px; cursor: pointer; margin: 0;" onchange="toggleBancoInputs(<?php echo $banco['cod_banco']; ?>)">
                                <label for="banco_<?php echo $banco['cod_banco']; ?>" style="color: rgba(255,255,255,0.95); font-size: 0.9rem; font-weight: 600; cursor: pointer; margin: 0;">
                                    <?php echo $banco['nombre_banco']; ?>
                                </label>
                                <div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">
                                    <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">Número:</label>
                                    <input type="number" class="form-input banco-input" name="numero_cuenta_<?php echo $banco['cod_banco']; ?>" id="numero_cuenta_<?php echo $banco['cod_banco']; ?>" placeholder="123456789" style="width: 120px; padding: 0.3rem 0.4rem; font-size: 0.8rem;" disabled>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">
                                    <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">Tipo:</label>
                                    <select class="form-select banco-input" name="tipo_cuenta_<?php echo $banco['cod_banco']; ?>" id="tipo_cuenta_<?php echo $banco['cod_banco']; ?>" style="width: 110px; padding: 0.3rem 0.4rem; font-size: 0.8rem; background-color: rgba(16, 185, 129, 0.1);" disabled>
                                        <option value="1">Ahorros</option>
                                        <option value="2">Corriente</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Campos adicionales del titular -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 0.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">
                                    <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">Titular:</label>
                                    <input type="text" class="form-input banco-input" name="nombre_titular_cuenta_<?php echo $banco['cod_banco']; ?>" id="nombre_titular_cuenta_<?php echo $banco['cod_banco']; ?>" placeholder="Nombre Titular" style="width: 100%; padding: 0.3rem 0.4rem; font-size: 0.8rem;" disabled>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">
                                    <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">CC Titular:</label>
                                    <input type="number" class="form-input banco-input" name="identificacion_titular_cuenta_<?php echo $banco['cod_banco']; ?>" id="identificacion_titular_cuenta_<?php echo $banco['cod_banco']; ?>" placeholder="CC Titular" style="width: 100%; padding: 0.3rem 0.4rem; font-size: 0.8rem;" disabled>
                                </div>
                            </div>
                            <!-- Campo certificado bancario -->
                            <div id="cert_container_<?php echo $banco['cod_banco']; ?>" style="display: none; margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px solid rgba(255,255,255,0.1);">
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;"><i class="fa-solid fa-file-certificate"></i> Certificado:</label>
                                    <input type="file" class="banco-input" name="certificado_banco_<?php echo $banco['cod_banco']; ?>" id="certificado_banco_<?php echo $banco['cod_banco']; ?>" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx" style="flex: 1; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.3rem; border-radius: 6px; font-size: 0.7rem;" disabled>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endwhile;
                        }
                        ?>
                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #10b981; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Selecciona los bancos e ingresa el número de cuenta y tipo de cuenta para este aliado.
                        </div>
                    </div>
                </div>

                <!-- Documentación Legal -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <label class="form-label" style="color: #10b981; font-weight: 700; margin-bottom: 0.75rem; display: block;">
                        <i class="fa-solid fa-file-contract"></i> Documentación Legal
                    </label>
                    <div style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 0.75rem;">

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-id-card"></i> Cédula
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_cedula_aliado" accept=".pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formato permitido: PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-pdf"></i> RUT (Registro Único Tributario)
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_rut_aliado" accept=".pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formato permitido: PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-building"></i> Cámara de Comercio
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_camaracomercio_aliado" accept=".pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formato permitido: PDF</small>
                        </div>

                        <!--
                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-signature"></i> Contrato Firmado
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_contratofirma_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-alt"></i> Documento Extra 1 (Opcional)
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_extra1_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-alt"></i> Documento Extra 2 (Opcional)
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_extra2_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>
                        -->

                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #10b981; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Adjunta la documentación legal requerida para el aliado estratégico.
                        </div>
                    </div>
                </div>

                <!-- Checkbox creado arriba junto al nombre comercial -->
                
                <button type="submit" class="submit-btn" id="btnGuardar"><i class="fa-solid fa-save"></i> Guardar Aliado</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal-overlay" id="modalEditar" style="align-items: flex-start; padding-top: 20px;">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-user-edit"></i> Editar Aliado</h2>
            <button class="modal-close" onclick="cerrarModalEditar()"><i class="fa-solid fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <form id="formEditar">
                <input type="hidden" name="tabla" value="tbl15_administrador">
                <input type="hidden" name="action" value="editar">
                <input type="hidden" name="cod_administrador" id="edit_cod_administrador">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo de Cliente *</label>
                        <select class="form-select" id="edit_nombre_tipo_cliente" name="nombre_tipo_cliente" required onchange="cambiarTipoClienteEditar(true)">
                            <option value="">Seleccione...</option>
                            <?php 
                            mysqli_data_seek($res_tipo_cliente, 0);
                            while ($tipo_cliente = mysqli_fetch_assoc($res_tipo_cliente)): 
                            ?>
                            <option value="<?php echo $tipo_cliente['nombre_tipo_cliente']; ?>"><?php echo $tipo_cliente['nombre_tipo_cliente']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipo de Sector *</label>
                        <select class="form-select" id="edit_cod_tipo_sector" name="cod_tipo_sector" required>
                            <option value="">Seleccione...</option>
                            <?php 
                            mysqli_data_seek($res_tipo_sector, 0);
                            while ($tipo_sector = mysqli_fetch_assoc($res_tipo_sector)): 
                            ?>
                            <option value="<?php echo $tipo_sector['cod_tipo_sector']; ?>" title="<?php echo htmlspecialchars($tipo_sector['descripcion_tipo_sector']); ?>"><?php echo $tipo_sector['nombre_tipo_sector']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" id="edit_label_nombre_comercial">Nombre Comercial *</label>
                        <input type="text" class="form-input" id="edit_nombres_apellidos_tercero" name="nombres_apellidos_tercero" required>
                    </div>
                    <div class="form-group" style="padding-top: 1.6rem;">
                        <!-- Espacio para mantener simetría -->
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" id="edit_container_nit_razon_social" style="display:none;">
                        <label class="form-label">NIT Razón Social *</label>
                        <input type="text" class="form-input" id="edit_nit_razon_social" name="nit_razon_social">
                    </div>
                    <div class="form-group" id="edit_container_nombre_razon_social" style="display:none;">
                        <label class="form-label">Razón Social *</label>
                        <input type="text" class="form-input" id="edit_nombre_razon_social" name="nombre_razon_social">
                    </div>
                </div>

                <label class="form-label" style="color: #10b981; font-weight: 700; margin-bottom: 0.75rem; display: block;"><i class="fa-solid fa-building-columns"></i> Datos del Representante Legal</label>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Identificación *</label>
                        <input type="number" class="form-input" id="edit_identificacion" name="identificacion_tercero" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipo de Documento *</label>
                        <select class="form-select" id="edit_nombre_tipo_identificacion" name="nombre_tipo_identificacion" required>
                            <option value="">Seleccione...</option>
                            <?php 
                            mysqli_data_seek($res_tipo_identificacion, 0);
                            while ($tipo_identificacion = mysqli_fetch_assoc($res_tipo_identificacion)): 
                            ?>
                            <option value="<?php echo $tipo_identificacion['tipo_doc_abrev']; ?>" title="<?php echo htmlspecialchars($tipo_identificacion['tipo_doc_abrev']); ?>"><?php echo $tipo_identificacion['nombre_tipo_doc']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-input" id="edit_nombre" name="nombre1_tercero" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellido *</label>
                        <input type="text" class="form-input" id="edit_apellido" name="apellido1_tercero" required>
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

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Departamento *</label>
                        <select class="form-select" id="edit_cod_departamento" name="cod_departamento" required onchange="cargarMunicipiosEdicion(this.value)">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Municipio *</label>
                        <select class="form-select" id="edit_cod_municipio" name="cod_municipio" required>
                            <option value="">Primero seleccione departamento</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Dirección *</label>
                        <input type="text" class="form-input" id="edit_direccion_tercero" name="direccion_tercero" placeholder="Ej: Cra 10 #20-30" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Barrio *</label>
                        <input type="text" class="form-input" id="edit_barrio_tercero" name="barrio_tercero" placeholder="Ej: Centro, Santa Isabel..." required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Asesor</label>
                    <select class="form-select" id="edit_cod_asesor" disabled style="background: rgba(0,0,0,0.3); cursor: not-allowed;">
                        <option value="">Seleccione</option>
                        <?php mysqli_data_seek($res_asesor, 0);
                        while ($r = mysqli_fetch_assoc($res_asesor)): ?>
                        <option value="<?php echo $r['cod_administrador']; ?>"><?php echo $r['nombres_apellidos_tercero']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <input type="hidden" name="cod_asesor" id="edit_cod_asesor_hidden">
                </div>

                <!-- Sección de Credenciales de Acceso -->
                <div class="form-group">
                    <div style="border-top: 1px solid rgba(255,255,255,0.1); margin: 1rem 0; padding-top: 1rem;">
                        <label class="form-label" style="color: #10b981; font-weight: 700; margin-bottom: 0.75rem; display: block;">
                            <i class="fa-solid fa-key"></i> Credenciales de Acceso
                        </label>
                        
                        <!-- Nombre de Usuario -->
                        <div class="form-group" style="margin-bottom: 1rem;">
                            <label class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-input" name="usuario" id="edit_usuario" placeholder="Nombre de usuario" readonly style="background: rgba(0,0,0,0.3); cursor: not-allowed;">
                            <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 0.5rem; margin-top: 0.5rem;">
                                <div style="color: rgba(255,255,255,0.7); font-size: 0.7rem;">
                                    <i class="fa-solid fa-lock" style="color: #3b82f6; margin-right: 0.5rem;"></i>
                                    El nombre de usuario no se puede modificar
                                </div>
                            </div>
                        </div>

                        <!-- Cambio de Contraseña por Correo -->
                        <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
                            <label class="form-label" style="color: #f59e0b; font-weight: 700; margin-bottom: 0.75rem; display: block;">
                                <i class="fa-solid fa-key"></i> Cambiar Contraseña
                            </label>
                            <div style="text-align: center;">
                                <button type="button" onclick="enviarRecuperacionPassword()" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 12px; font-size: 0.9rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(245, 158, 11, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(245, 158, 11, 0.3)'">
                                    <i class="fa-solid fa-envelope"></i> Enviar Nueva Contraseña por Correo
                                </button>
                                <div style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.75rem;">
                                    <div style="color: rgba(255,255,255,0.8); font-size: 0.75rem; line-height: 1.4;">
                                        <i class="fa-solid fa-lightbulb" style="color: #f59e0b; margin-right: 0.35rem;"></i>
                                        Se generará una nueva contraseña temporal y se enviará al correo registrado del aliado.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="cod_estado_activacion_usuario" id="edit_estado" disabled style="background: rgba(100, 116, 139, 0.2); cursor: not-allowed; opacity: 0.7;"><option value="1">Activo</option><option value="2">En Espera para Activación</option><option value="3">Inactivo</option></select>
                    <input type="hidden" name="cod_estado_activacion_usuario" id="edit_estado_hidden">
                    <div style="background: rgba(100, 116, 139, 0.1); border: 1px solid rgba(100, 116, 139, 0.3); border-radius: 8px; padding: 0.5rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.7); font-size: 0.75rem;">
                            <i class="fa-solid fa-info-circle" style="color: #94a3b8; margin-right: 0.35rem;"></i>
                            El estado no se puede modificar desde aquí.
                        </div>
                    </div>
                </div>

                <!-- Parametrización de Lineas de Credito -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                        <label class="form-label" style="color: #10b981; font-weight: 700; margin: 0;"><i class="fa-solid fa-building-columns"></i> Lineas de Credito</label>
                        <button type="button" onclick="abrirModalAgregarEntidad()" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.75rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; transition: all 0.3s ease; white-space: nowrap;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-plus-circle"></i> Agregar
                        </button>
                    </div>
                    <div id="contenedor_entidades_editar" style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 0.5rem; max-height: 300px; overflow-y: auto;">
                        <div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                            <p style="margin: 0; font-size: 0.85rem;">Cargando entidades...</p>
                        </div>
                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; padding: 0.5rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.3;">
                            <i class="fa-solid fa-info-circle" style="color: #10b981; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Aquí se muestran las lineas de credito asignadas a este aliado.
                        </div>
                    </div>
                </div>

                <!-- Parametrización de Bancos -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                        <label class="form-label" style="color: #10b981; font-weight: 700; margin: 0;">
                            <i class="fa-solid fa-university"></i> Cuentas Bancarias
                        </label>
                        <button type="button" onclick="abrirModalAgregarBanco(document.getElementById('edit_cod_administrador').value)" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.75rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; transition: all 0.3s ease; white-space: nowrap;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-plus-circle"></i> Agregar
                        </button>
                    </div>
                    <div id="contenedor_bancos_editar" style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 0.75rem; max-height: 350px; overflow-y: auto;">
                        <div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                            <p style="margin: 0; font-size: 0.85rem;">Cargando bancos...</p>
                        </div>
                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #10b981; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Aquí se muestran las cuentas bancarias asignadas a este aliado.
                        </div>
                    </div>
                </div>

                <!-- Parametrización de Tiendas -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                        <label class="form-label" style="color: #10b981; font-weight: 700; margin: 0;">
                            <i class="fa-solid fa-store"></i> Tiendas Asociadas
                        </label>
                        <button type="button" onclick="abrirModalAgregarTienda()" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.75rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; transition: all 0.3s ease; white-space: nowrap;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-plus-circle"></i> Agregar
                        </button>
                    </div>
                    <div id="contenedor_tiendas_editar" style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 0.75rem; max-height: 350px; overflow-y: auto;">
                        <div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                            <p style="margin: 0; font-size: 0.85rem;">Cargando tiendas...</p>
                        </div>
                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #10b981; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Aquí se muestran las tiendas asociadas a este aliado.
                        </div>
                    </div>
                </div>

                <!-- Documentación Legal -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <label class="form-label" style="color: #10b981; font-weight: 700; margin-bottom: 0.75rem; display: block;">
                        <i class="fa-solid fa-file-contract"></i> Documentación Legal
                    </label>
                    <div style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 0.75rem;">

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);"><i class="fa-solid fa-id-card"></i> Cédula</label>
                            <!-- Documento existente -->
                            <div id="edit_cedula_actual" style="display: none; padding: 0.75rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; text-align: center;">
                                <a href="#" target="_blank" style="color: #10b981; text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 600;">
                                    <i class="fa-solid fa-file-check" style="font-size: 1.2rem;"></i>Ver Cédula Cargada</a>
                            </div>
                            <!-- Input para cargar nuevo documento -->
                            <div id="edit_cedula_input" style="display: none;">
                                <input type="file" class="form-input" name="url_documentacion_cedula_aliado" accept=".pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                                <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formato permitido: PDF</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);"><i class="fa-solid fa-file-pdf"></i> RUT (Registro Único Tributario)</label>
                            <!-- Documento existente -->
                            <div id="edit_rut_actual" style="display: none; padding: 0.75rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; text-align: center;">
                                <a href="#" target="_blank" style="color: #10b981; text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 600;">
                                    <i class="fa-solid fa-file-check" style="font-size: 1.2rem;"></i>Ver Documento RUT Cargado</a>
                            </div>
                            <!-- Input para cargar nuevo documento -->
                            <div id="edit_rut_input" style="display: none;">
                                <input type="file" class="form-input" name="url_documentacion_rut_aliado" accept=".pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                                <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formato permitido: PDF</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);"><i class="fa-solid fa-building"></i> Cámara de Comercio</label>
                            <!-- Documento existente -->
                            <div id="edit_camara_actual" style="display: none; padding: 0.75rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; text-align: center;">
                                <a href="#" target="_blank" style="color: #10b981; text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 600;">
                                    <i class="fa-solid fa-file-check" style="font-size: 1.2rem;"></i>Ver Cámara de Comercio Cargada</a>
                            </div>
                            <!-- Input para cargar nuevo documento -->
                            <div id="edit_camara_input" style="display: none;">
                                <input type="file" class="form-input" name="url_documentacion_camaracomercio_aliado" accept=".pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                                <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formato permitido: PDF</small>
                            </div>
                        </div>

                        <!--
                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-signature"></i> Contrato Firmado
                            </label>
                            <div id="edit_contrato_actual" style="display: none; margin-bottom: 0.5rem; padding: 0.5rem; background: rgba(16, 185, 129, 0.1); border-radius: 6px;">
                                <a href="#" target="_blank" style="color: #10b981; text-decoration: none; font-size: 0.75rem;">
                                    <i class="fa-solid fa-file-check"></i> Ver documento actual
                                </a>
                            </div>
                            <input type="file" class="form-input" name="url_documentacion_contratofirma_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-alt"></i> Documento Extra 1 (Opcional)
                            </label>
                            <div id="edit_extra1_actual" style="display: none; margin-bottom: 0.5rem; padding: 0.5rem; background: rgba(16, 185, 129, 0.1); border-radius: 6px;">
                                <a href="#" target="_blank" style="color: #10b981; text-decoration: none; font-size: 0.75rem;">
                                    <i class="fa-solid fa-file-check"></i> Ver documento actual
                                </a>
                            </div>
                            <input type="file" class="form-input" name="url_documentacion_extra1_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-alt"></i> Documento Extra 2 (Opcional)
                            </label>
                            <div id="edit_extra2_actual" style="display: none; margin-bottom: 0.5rem; padding: 0.5rem; background: rgba(16, 185, 129, 0.1); border-radius: 6px;">
                                <a href="#" target="_blank" style="color: #10b981; text-decoration: none; font-size: 0.75rem;">
                                    <i class="fa-solid fa-file-check"></i> Ver documento actual
                                </a>
                            </div>
                            <input type="file" class="form-input" name="url_documentacion_extra2_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>
                        -->

                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #10b981; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Si carga un nuevo documento, reemplazará el actual. Deje vacío para mantener el documento existente.
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="btnEditar"><i class="fa-solid fa-save"></i> Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detalles -->
<div class="modal-overlay" id="modalDetalle" style="align-items: flex-end;">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-circle-info"></i> Detalle Aliado</h2>
            <button class="modal-close" onclick="cerrarModalDetalle()"><i class="fa-solid fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="width: 80px; height: 80px; background: rgba(16, 185, 129, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="fa-solid fa-user" style="font-size: 2.5rem; color: #10b981;"></i>
                </div>
                <h3 id="detNombre" style="color: white; font-size: 1.5rem; margin-bottom: 0.5rem;"></h3>
                <span id="detEstado" style="padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.8rem; font-weight: 600;"></span>
            </div>

            <div class="detail-row">
                <span class="detail-label-modal">Identificación</span>
                <span class="detail-value-modal" id="detCedula"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label-modal">Teléfono</span>
                <span class="detail-value-modal" id="detTelefono"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label-modal">Correo</span>
                <span class="detail-value-modal" id="detCorreo"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label-modal">Dirección</span>
                <span class="detail-value-modal" id="detDireccion"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label-modal">Cuenta</span>
                <span class="detail-value-modal" id="detCuenta"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label-modal">Comisión</span>
                <span class="detail-value-modal" id="detComision"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label-modal">Tiendas</span>
                <span class="detail-value-modal" id="detTiendas"></span>
            </div>

            <button class="submit-btn" onclick="cerrarModalDetalle()" style="background: rgba(255,255,255,0.1); margin-top: 1.5rem;">Cerrar</button>
        </div>
    </div>
</div>

<!-- Modal Agregar Entidad -->
<div class="modal-overlay" id="modalAgregarEntidad" style="align-items: center; z-index: 3000;">
    <div class="modal-content" style="max-width: 500px; border-radius: 20px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-plus-circle"></i> Agregar Entidad</h2>
            <button class="modal-close" onclick="cerrarModalAgregarEntidad()">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <form id="formAgregarEntidad">
                <input type="hidden" id="agregar_cod_administrador" name="cod_administrador">
                
                <div class="form-group">
                    <label class="form-label">Entidad Crediticia *</label>
                    <select class="form-select" id="agregar_cod_entidad" name="cod_entidad_crediticia" required>
                        <option value="">Cargando...</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Porcentaje de Interés *</label>
                    <input type="number" step="0.01" min="0" max="100" class="form-input" id="agregar_interes" name="interes_ptj" placeholder="0.00" required>
                </div>

                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: rgba(255,255,255,0.9); font-size: 0.9rem;">
                        <input type="checkbox" id="agregar_cod_estado_entrar_portal" name="cod_estado_entrar_portal" value="1" style="accent-color: #10b981; width: 18px; height: 18px; cursor: pointer;">
                        <span>Habilitar acceso al portal</span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">URL de Consulta</label>
                    <input type="text" class="form-input" id="agregar_url" name="url_pagina_web_consulta" placeholder="https://...">
                </div>

                <div class="form-row" style="gap: 0.5rem;">
                    <button type="button" onclick="cerrarModalAgregarEntidad()" style="flex: 1; background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-times"></i> Cancelar
                    </button>
                    <button type="submit" style="flex: 1; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Agregar Banco -->
<div class="modal-overlay" id="modalAgregarBanco" style="align-items: center; z-index: 3000;">
    <div class="modal-content" style="max-width: 500px; border-radius: 20px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-plus-circle"></i> Agregar Cuenta Bancaria</h2>
            <button class="modal-close" onclick="cerrarModalAgregarBanco()">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <form id="formAgregarBanco">
                <input type="hidden" id="agregar_banco_cod_administrador" name="cod_administrador">
                <input type="hidden" id="agregar_banco_cod_aliado_estrategico" name="cod_aliado_estrategico">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Banco *</label>
                        <select class="form-select" id="agregar_banco" name="cod_banco" required><option value="">Cargando...</option></select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Número de Cuenta *</label>
                        <input type="text" class="form-input" id="agregar_numero_cuenta" name="numero_banco_cuenta" placeholder="Ej: 1234567890" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo de Cuenta *</label>
                        <select class="form-select" id="agregar_tipo_cuenta" name="cod_tipo_cuenta_banco" required><option value="1">Ahorros</option><option value="2">Corriente</option></select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Estado *</label>
                        <select class="form-select" id="agregar_estado_cuenta" name="cod_estado" required><option value="1">Activo</option><option value="0">Inactivo</option></select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Titular de la Cuenta</label>
                        <input type="text" class="form-input" id="agregar_nombre_titular" name="nombre_titular_cuenta" placeholder="Nombre completo">
                    </div>
                    <div class="form-group">
                        <label class="form-label">CC / NIT Titular</label>
                        <input type="text" class="form-input" id="agregar_id_titular" name="identificacion_titular_cuenta" placeholder="Documento">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-file-certificate"></i> Certificado Bancario</label>
                    <div style="background: rgba(16, 185, 129, 0.05); border: 2px dashed rgba(16, 185, 129, 0.3); border-radius: 10px; padding: 1rem; text-align: center; cursor: pointer; transition: all 0.3s ease;" onclick="document.getElementById('agregar_certificado_banco').click()" onmouseover="this.style.borderColor='rgba(16, 185, 129, 0.6)'" onmouseout="this.style.borderColor='rgba(16, 185, 129, 0.3)'">
                        <input type="file" id="agregar_certificado_banco" name="certificado_banco" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx" style="display: none;" onchange="mostrarNombreArchivoCertificado(this, 'preview_certificado_agregar')">
                        <div id="preview_certificado_agregar">
                            <i class="fa-solid fa-cloud-upload-alt" style="font-size: 2rem; color: rgba(16, 185, 129, 0.6); margin-bottom: 0.5rem;"></i>
                            <p style="margin: 0; color: rgba(255,255,255,0.7); font-size: 0.85rem;">Clic para seleccionar archivo</p>
                            <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.7rem;">Imagen o documento (JPG, PNG, PDF, DOC)</p>
                        </div>
                    </div>
                </div>

                <div class="form-row" style="gap: 0.5rem;">
                    <button type="button" onclick="cerrarModalAgregarBanco()" style="flex: 1; background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-times"></i> Cancelar
                    </button>
                    <button type="submit" style="flex: 1; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Agregar Tienda -->
<div class="modal-overlay" id="modalAgregarTienda" style="align-items: flex-start; padding-top: 20px; z-index: 3000;">
    <div class="modal-content" style="max-width: 550px; border-radius: 20px; max-height: 90vh; overflow-y: auto;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-store"></i> Nueva Tienda</h2>
            <button class="modal-close" onclick="cerrarModalAgregarTienda()"><i class="fa-solid fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <form id="formAgregarTienda" enctype="multipart/form-data">
                <input type="hidden" id="agregar_tienda_cod_aliado" name="cod_aliado_estrategico">
                
                <!-- Sección 1: Información Básica -->
                <div style="background: rgba(16, 185, 129, 0.1); padding: 0.5rem 0.75rem; border-radius: 8px; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-info-circle" style="color: #10b981;"></i>
                    <span style="color: #10b981; font-weight: 600; font-size: 0.85rem;">Información Básica</span>
                </div>



                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" id="label_tienda_nombre_comercial">Nombre Comercial *</label>
                        <input type="text" class="form-input" name="nombre1_tercero" id="tienda_nombre" placeholder="Ej: Tienda El Éxito" required>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Departamento *</label>
                        <select class="form-select" name="cod_departamento" id="tienda_departamento" required onchange="cargarMunicipiosTienda(this.value, '#tienda_municipio')">
                            <option value="">-- Seleccione --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Municipio *</label>
                        <select class="form-select" name="cod_municipio" id="tienda_municipio" required>
                            <option value="">-- Primero seleccione departamento --</option>
                        </select>
                    </div>
                </div>

                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Dirección *</label>
                        <input type="text" class="form-input" name="direccion_tercero" id="tienda_direccion" placeholder="Ej: Calle 10 # 20-30" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Barrio *</label>
                        <input type="text" class="form-input" name="barrio_tercero" id="tienda_barrio" placeholder="Ej: Centro, Santa Isabel..." required>
                    </div>
                </div>


                <!-- Sección 2: Información del Negocio -->
                <div style="background: rgba(59, 130, 246, 0.1); padding: 0.5rem 0.75rem; border-radius: 8px; margin: 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-briefcase" style="color: #3b82f6;"></i>
                    <span style="color: #3b82f6; font-weight: 600; font-size: 0.85rem;">Información del Negocio</span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">¿Existe en RUES?</label>
                        <select class="form-select" name="existe_rues" id="tienda_existe_rues">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">¿Venta Presencial?</label>
                        <select class="form-select" name="venta_presencial" id="tienda_venta_presencial">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">¿Venta Online?</label>
                        <select class="form-select" name="venta_online" id="tienda_venta_online">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Plataforma E-commerce</label>
                        <input type="text" class="form-input" name="nombre_plataforma_ecommerce" id="tienda_ecommerce" placeholder="Ej: Shopify, WooCommerce...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Sistema Contable</label>
                    <input type="text" class="form-input" name="nombre_sistema_contable" id="tienda_sistema_contable" placeholder="Ej: Siigo, World Office, Alegra...">
                </div>

                <!-- Sección 4: Imágenes -->
                <div style="background: rgba(236, 72, 153, 0.1); padding: 0.5rem 0.75rem; border-radius: 8px; margin: 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-camera" style="color: #ec4899;"></i>
                    <span style="color: #ec4899; font-weight: 600; font-size: 0.85rem;">Imágenes del Establecimiento</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Logo de la Tienda</label>
                    <div style="background: rgba(16, 185, 129, 0.05); border: 2px dashed rgba(16, 185, 129, 0.3); border-radius: 10px; padding: 0.75rem; text-align: center; cursor: pointer;" onclick="document.getElementById('tienda_logo').click()">
                        <input type="file" id="tienda_logo" name="imagen_tienda" accept="image/*" style="display: none;" onchange="mostrarImagenPreviewTienda(this, 'preview_logo_tienda')">
                        <div id="preview_logo_tienda">
                            <i class="fa-solid fa-image" style="font-size: 1.5rem; color: rgba(16, 185, 129, 0.6);"></i>
                            <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.6); font-size: 0.75rem;">Clic para seleccionar</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Fachada</label>
                        <div style="background: rgba(16, 185, 129, 0.05); border: 2px dashed rgba(16, 185, 129, 0.3); border-radius: 10px; padding: 0.5rem; text-align: center; cursor: pointer;" onclick="document.getElementById('tienda_fachada').click()">
                            <input type="file" id="tienda_fachada" name="url_img_fachada_tienda" accept="image/*" style="display: none;" onchange="mostrarImagenPreviewTienda(this, 'preview_fachada_tienda')">
                            <div id="preview_fachada_tienda">
                                <i class="fa-solid fa-store" style="font-size: 1.2rem; color: rgba(16, 185, 129, 0.6);"></i>
                                <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.65rem;">Fachada</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Interna</label>
                        <div style="background: rgba(16, 185, 129, 0.05); border: 2px dashed rgba(16, 185, 129, 0.3); border-radius: 10px; padding: 0.5rem; text-align: center; cursor: pointer;" onclick="document.getElementById('tienda_interna').click()">
                            <input type="file" id="tienda_interna" name="url_img_interna_tienda" accept="image/*" style="display: none;" onchange="mostrarImagenPreviewTienda(this, 'preview_interna_tienda')">
                            <div id="preview_interna_tienda">
                                <i class="fa-solid fa-person-shelter" style="font-size: 1.2rem; color: rgba(16, 185, 129, 0.6);"></i>
                                <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.65rem;">Interna</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Selfie con Admin</label>
                    <div style="background: rgba(16, 185, 129, 0.05); border: 2px dashed rgba(16, 185, 129, 0.3); border-radius: 10px; padding: 0.75rem; text-align: center; cursor: pointer;" onclick="document.getElementById('tienda_selfie').click()">
                        <input type="file" id="tienda_selfie" name="url_img_selfieadmin_tienda" accept="image/*" style="display: none;" onchange="mostrarImagenPreviewTienda(this, 'preview_selfie_tienda')">
                        <div id="preview_selfie_tienda">
                            <i class="fa-solid fa-camera-retro" style="font-size: 1.5rem; color: rgba(16, 185, 129, 0.6);"></i>
                            <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.6); font-size: 0.75rem;">Clic para seleccionar</p>
                        </div>
                    </div>
                </div>

                <div class="form-row" style="gap: 0.5rem; margin-top: 1rem;">
                    <button type="button" onclick="cerrarModalAgregarTienda()" style="flex: 1; background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-times"></i> Cancelar
                    </button>
                    <button type="submit" style="flex: 1; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-save"></i> Registrar Tienda
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Confirmación Registro Exitoso -->
<div class="modal-overlay" id="modalConfirmacionRegistro" style="z-index: 4000; align-items: center;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <h2><i class="fa-solid fa-circle-check"></i> ¡Aliado Registrado!</h2>
            <button class="modal-close" onclick="cerrarModalConfirmacionRegistro()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="confirm_cod_aliado" value="">
            <input type="hidden" id="confirm_cod_aliado_cryp" value="">
            <input type="hidden" id="confirm_nombre_aliado" value="">
            <input type="hidden" id="confirm_telefono_aliado" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="width: 80px; height: 80px; margin: 0 auto 1rem; background: rgba(16, 185, 129, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-circle-check" style="font-size: 3rem; color: #10b981;"></i>
                </div>
                <h3 style="color: white; margin-bottom: 0.5rem;" id="confirm_nombre_display"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">El aliado ha sido registrado exitosamente.</p>
            </div>

            <!-- Sección de Tienda (Solo si se creó tienda) -->
            <div id="section_confirm_tienda" style="display: none; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                    <div style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa-solid fa-store" style="font-size: 1.25rem; color: #10b981;"></i>
                    </div>
                    <div>
                        <h4 style="color: white; margin: 0; font-size: 0.95rem;">Tienda también registrada</h4>
                        <p style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin: 0;">Se ha creado el establecimiento para el aliado.</p>
                    </div>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <button id="btn_registrar_vendedores_tienda_rapida" style="width: 100%; background: #10b981; color: white; border: none; padding: 0.75rem; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-solid fa-users-gear"></i> Registrar Vendedores
                    </button>
                    <button id="btn_registrar_productos_tienda_rapida" style="width: 100%; background: #10b981; color: white; border: none; padding: 0.75rem; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-solid fa-users-gear"></i> Registrar Productos
                    </button>
                    <input type="hidden" id="confirm_cod_tienda_actual" value="">
                </div>
            </div>
            
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                <h4 style="color: #8b5cf6; margin: 0 0 0.75rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-tasks"></i> Acciones del Aliado
                </h4>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <button onclick="registrarOtroAliado()" style="width: 100%; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                        <i class="fa-solid fa-user-plus"></i> Registrar Otro Aliado
                    </button>

                    <button onclick="abrirDocumentacionDesdeConfirmacion()" style="width: 100%; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                        <i class="fa-solid fa-file-contract"></i> Compartir Enlace de Documentación
                    </button>
                    
                    <button onclick="abrirRegistroTiendaDesdeConfirmacion()" style="width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                        <i class="fa-solid fa-store"></i> Registrar Nueva Tienda
                    </button>
                </div>
            </div>
            
            <button onclick="cerrarModalConfirmacionRegistro()" style="width: 100%; background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.85rem; border-radius: 12px; cursor: pointer; font-weight: 600;">
                <i class="fa-solid fa-check"></i> Finalizar
            </button>
        </div>
    </div>
</div>

<!-- Modal Registro de Vendedores (desde Confirmación Aliado) -->
<div class="reg-modal-overlay-aliado" id="modalRegVendedorAliado">
    <div class="reg-modal-container-aliado">
        <div class="reg-modal-header-aliado vendedor-theme">
            <h2><i class="fa-solid fa-user-plus"></i> Registrar Vendedor</h2>
            <button class="modal-close-reg" onclick="cerrarModalRegVendedorAliado()"><i class="fa-solid fa-times"></i></button>
        </div>
        
        <div class="reg-modal-body-aliado">
            <div class="reg-tienda-badge-aliado">
                <i class="fa-solid fa-store"></i>
                Tienda: <strong id="regVendedorNombreTienda"></strong>
            </div>
            
            <form id="formRegVendedorAliado">
                <input type="hidden" id="regVendedor_cod_tienda" name="cod_tienda" value="">
                
                <div class="reg-form-group">
                    <label class="reg-form-label">Identificación (Cédula) *</label>
                    <input type="text" class="reg-form-input" name="identificacion_tercero" id="regVendedor_identificacion" placeholder="Ej: 1234567890" required>
                </div>
                
                <div class="reg-form-row">
                    <div class="reg-form-group">
                        <label class="reg-form-label">Nombres *</label>
                        <input type="text" class="reg-form-input" name="nombre1_tercero" id="regVendedor_nombre" placeholder="Ej: Juan Carlos" required>
                    </div>
                    <div class="reg-form-group">
                        <label class="reg-form-label">Apellidos *</label>
                        <input type="text" class="reg-form-input" name="apellido1_tercero" id="regVendedor_apellido" placeholder="Ej: Pérez López" required>
                    </div>
                </div>
                
                <div class="reg-form-row">
                    <div class="reg-form-group">
                        <label class="reg-form-label">Teléfono *</label>
                        <input type="tel" class="reg-form-input" name="telefono1_tercero" id="regVendedor_telefono" placeholder="Ej: 3001234567" required>
                    </div>
                    <div class="reg-form-group">
                        <label class="reg-form-label">Correo *</label>
                        <input type="email" class="reg-form-input" name="correo_tercero" id="regVendedor_correo" placeholder="correo@email.com" required>
                    </div>
                </div>
                
                <button type="submit" class="reg-submit-btn-aliado vendedor-theme">
                    <i class="fa-solid fa-user-plus"></i> Registrar Vendedor
                </button>
            </form>
            
            <!-- Lista de vendedores registrados -->
            <div class="reg-items-list-aliado" id="listaRegVendedoresAliado" style="display: none;">
                <div class="reg-items-list-title">
                    <i class="fa-solid fa-users"></i> Vendedores Registrados
                    <span class="reg-badge-count" id="contadorRegVendedoresAliado">0</span>
                </div>
                <div id="regVendedoresListAliado"></div>
            </div>
        </div>
        
        <div class="reg-modal-footer-aliado">
            <button class="reg-footer-btn-aliado back-btn" onclick="volverAConfirmacionDesdeVendedor()">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </button>
            <button class="reg-footer-btn-aliado finish-btn" onclick="finalizarRegistroDesdeModal()">
                <i class="fa-solid fa-check"></i> Finalizar
            </button>
        </div>
    </div>
</div>

<!-- Modal Registro de Productos (desde Confirmación Aliado) -->
<div class="reg-modal-overlay-aliado" id="modalRegProductoAliado">
    <div class="reg-modal-container-aliado">
        <div class="reg-modal-header-aliado producto-theme">
            <h2><i class="fa-solid fa-box-open"></i> Registrar Producto</h2>
            <button class="modal-close-reg" onclick="cerrarModalRegProductoAliado()"><i class="fa-solid fa-times"></i></button>
        </div>
        
        <div class="reg-modal-body-aliado producto-body">
            <div class="reg-tienda-badge-aliado">
                <i class="fa-solid fa-store"></i>
                Tienda: <strong id="regProductoNombreTienda"></strong>
            </div>
            
            <form id="formRegProductoAliado" enctype="multipart/form-data">
                <input type="hidden" id="regProducto_cod_tienda" name="cod_tienda" value="">
                <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                <input type="hidden" name="cod_estado" value="1">
                
                <div class="reg-form-row">
                    <div class="reg-form-group">
                        <label class="reg-form-label">Código de Barras *</label>
                        <input type="text" class="reg-form-input" name="cod_producto_barra" id="regProducto_codigo" placeholder="Ej: 7701234567890" required>
                    </div>
                    <div class="reg-form-group">
                        <label class="reg-form-label">Categoría</label>
                        <select class="reg-form-select" name="cod_categoria" id="regProducto_categoria">
                            <option value="0">Sin categoría</option>
                            <?php
                            $sql_cat_aliado = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE cod_estado = '1' ORDER BY nombre_categoria ASC";
                            $res_cat_aliado = mysqli_query($conectar, $sql_cat_aliado);
                            if ($res_cat_aliado) {
                                while ($cat_a = mysqli_fetch_assoc($res_cat_aliado)) {
                                    echo '<option value="'.$cat_a['cod_categoria'].'">'.ucwords(strtolower($cat_a['nombre_categoria'])).'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="reg-form-group">
                    <label class="reg-form-label">Nombre del Producto *</label>
                    <input type="text" class="reg-form-input" name="nombre_producto" id="regProducto_nombre" placeholder="Ej: Arroz Diana x 500g" required>
                </div>
                
                <div class="reg-form-row">
                    <div class="reg-form-group">
                        <label class="reg-form-label">Precio Compra ($)</label>
                        <input type="text" class="reg-form-input" inputmode="numeric" id="regProducto_precio_compra" placeholder="$ 0" value="0" oninput="formatearPrecioAliado(this)">
                        <input type="hidden" name="precio_compra_producto" id="regProducto_precio_compra_hidden" value="0">
                    </div>
                    <div class="reg-form-group">
                        <label class="reg-form-label">Precio Venta ($) *</label>
                        <input type="text" class="reg-form-input" inputmode="numeric" id="regProducto_precio_venta" placeholder="$ 0" oninput="formatearPrecioAliado(this)">
                        <input type="hidden" name="precio_venta_producto" id="regProducto_precio_venta_hidden" value="0">
                    </div>
                </div>
                
                <div class="reg-form-row">
                    <div class="reg-form-group">
                        <label class="reg-form-label">IVA (%)</label>
                        <select class="reg-form-select" name="iva_ptj" id="regProducto_iva">
                            <option value="0">0%</option>
                            <option value="5">5%</option>
                            <option value="19">19%</option>
                        </select>
                    </div>
                    <div class="reg-form-group">
                        <label class="reg-form-label">Imagen</label>
                        <input type="file" name="imagen_producto" id="regProducto_imagen" accept="image/*" style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); border-radius:12px; padding:0.6rem; color:white; font-size:0.8rem;">
                    </div>
                </div>
                
                <div class="reg-form-group">
                    <label class="reg-form-label">Descripción</label>
                    <textarea class="reg-form-input" name="descripcion_producto" id="regProducto_descripcion" rows="2" placeholder="Descripción del producto (opcional)" style="resize: vertical; min-height: 50px;"></textarea>
                </div>
                
                <button type="submit" class="reg-submit-btn-aliado producto-theme">
                    <i class="fa-solid fa-box-open"></i> Registrar Producto
                </button>
            </form>
            
            <!-- Lista de productos registrados -->
            <div class="reg-items-list-aliado" id="listaRegProductosAliado" style="display: none;">
                <div class="reg-items-list-title">
                    <i class="fa-solid fa-boxes-stacked"></i> Productos Registrados
                    <span class="reg-badge-count" id="contadorRegProductosAliado">0</span>
                </div>
                <div id="regProductosListAliado"></div>
            </div>
        </div>
        
        <div class="reg-modal-footer-aliado">
            <button class="reg-footer-btn-aliado back-btn" onclick="volverAConfirmacionDesdeProducto()">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </button>
            <button class="reg-footer-btn-aliado finish-btn" onclick="finalizarRegistroDesdeModal()">
                <i class="fa-solid fa-check"></i> Finalizar
            </button>
        </div>
    </div>
</div>

<!-- Modal Confirmación Tienda Registrada -->
<div class="modal-overlay" id="modalConfirmacionTienda" style="z-index: 4500; align-items: center;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <h2><i class="fa-solid fa-store"></i> ¡Tienda Registrada!</h2>
            <button class="modal-close" onclick="cerrarModalConfirmacionTienda()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="confirm_tienda_cod" value="">
            <input type="hidden" id="confirm_tienda_nombre" value="">
            <input type="hidden" id="confirm_tienda_cod_aliado" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="width: 80px; height: 80px; margin: 0 auto 1rem; background: rgba(16, 185, 129, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-store" style="font-size: 3rem; color: #10b981;"></i>
                </div>
                <h3 style="color: white; margin-bottom: 0.5rem;" id="confirm_tienda_nombre_display"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">La tienda ha sido registrada exitosamente.</p>
            </div>
            
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                <h4 style="color: #10b981; margin: 0 0 0.75rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-tasks"></i> ¿Qué deseas hacer ahora?
                </h4>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin: 0;">Selecciona una de las siguientes opciones:</p>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1rem;">
                <button onclick="registrarOtraTienda()" style="width: 100%; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-store"></i>
                    Registrar Otra Tienda
                </button>

                <button onclick="irATiendaRegistrada()" style="width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-users-gear"></i>
                    Registrar Vendedores / Productos
                </button>
            </div>
            
            <button onclick="cerrarModalConfirmacionTienda()" style="width: 100%; background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.85rem; border-radius: 12px; cursor: pointer; font-weight: 600;">
                <i class="fa-solid fa-check"></i> Finalizar
            </button>
        </div>
    </div>
</div>

<!-- Modal Documentación Aliado -->
<div class="modal-overlay" id="modalDocumentacionAliado" style="z-index: 5000; align-items: center;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(124, 58, 237, 0.2));">
            <h2><i class="fa-solid fa-file-lines"></i> Documentación</h2>
            <button class="modal-close" onclick="cerrarModalDocumentacionAliado()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="doc_cod_aliado_cryp" value="">
            <input type="hidden" id="doc_telefono_aliado" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h3 style="color: white; margin-bottom: 0.5rem;" id="doc_nombre_aliado"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Comparta el enlace para que el aliado suba su documentación legal.</p>
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
            
            <!-- Botón para Generar Documento de Firma Digital -->
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                <h4 style="color: #10b981; margin: 0 0 1rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-file-signature"></i> Firma Digital
                </h4>
                <button onclick="generarDocumentoFirma()" style="width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                    <i class="fa-solid fa-file-signature"></i> Generar Documento para Firma
                </button>
            </div>
            
            <button onclick="cerrarModalDocumentacionAliado()" style="width: 100%; background: rgba(255,255,255,0.1); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600;">
                <i class="fa-solid fa-times"></i> Cerrar
            </button>
        </div>
    </div>
</div>

<!-- Modal Compartir Enlace Firma Digital -->
<div class="modal-overlay" id="modalFirmaDigital" style="z-index: 5100; align-items: center;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));">
            <h2><i class="fa-solid fa-file-signature"></i> Documento para Firma Digital</h2>
            <button class="modal-close" onclick="cerrarModalFirmaDigital()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="firma_cod_aliado_cryp" value="">
            <input type="hidden" id="firma_telefono_aliado" value="">
            <input type="hidden" id="firma_token" value="">
            <input type="hidden" id="firma_url" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);">
                    <i class="fa-solid fa-file-signature" style="font-size: 2rem; color: white;"></i>
                </div>
                <h3 style="color: white; margin-bottom: 0.5rem;" id="firma_nombre_aliado"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">El documento para firma digital ha sido generado exitosamente.</p>
            </div>
            
            <!-- Opciones de Compartir -->
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                <h4 style="color: #10b981; margin: 0 0 1rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-share-nodes"></i> Compartir Enlace para Firmado
                </h4>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
                    <button onclick="compartirFirmaWhatsApp()" style="background: #25D366; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </button>
                    <button onclick="compartirFirmaEmail()" style="background: #EA4335; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por Email">
                        <i class="fa-solid fa-envelope"></i> Email
                    </button>
                    <button onclick="copiarEnlaceFirma()" style="background: #6366f1; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Copiar enlace">
                        <i class="fa-solid fa-copy"></i> Copiar
                    </button>
                </div>
            </div>
            
            <button onclick="cerrarModalFirmaDigital()" style="width: 100%; background: rgba(255,255,255,0.1); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600;">
                <i class="fa-solid fa-times"></i> Cerrar
            </button>
        </div>
    </div>
</div>

<!-- Modal Compartir Documentación -->
<div class="modal-overlay" id="modalCompartirDocs" style="align-items: center; z-index: 3500;">
    <div class="modal-content" style="max-width: 600px; border-radius: 20px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-share-nodes"></i> Compartir Documentación</h2>
            <button class="modal-close" onclick="cerrarModalCompartirDocs()">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <div id="loadingCompartir" style="display: none; text-align: center; padding: 40px;">
                <i class="fa-solid fa-spinner fa-spin" style="font-size: 3rem; color: #6366f1;"></i>
                <p style="margin-top: 20px; color: rgba(255,255,255,0.7);">Generando archivo ZIP...</p>
            </div>
            
            <div id="contenidoCompartir" style="display: none;">
                <!-- Información del aliado -->
                <div style="background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.3); border-radius: 12px; padding: 15px; margin-bottom: 20px;">
                    <h3 style="margin: 0 0 10px 0; color: white; font-size: 1rem;">
                        <i class="fa-solid fa-user"></i> <span id="compartir_aliado_nombre"></span>
                    </h3>
                    <p style="margin: 0; color: rgba(255,255,255,0.6); font-size: 0.85rem;">
                        <i class="fa-solid fa-id-card"></i> Cédula: <span id="compartir_aliado_cedula"></span>
                    </p>
                </div>
                
                <!-- Lista de archivos comprimidos -->
                <div style="margin-bottom: 20px;">
                    <h4 style="color: white; font-size: 0.9rem; margin-bottom: 10px;">
                        <i class="fa-solid fa-file-zipper"></i> Archivos incluidos:
                    </h4>
                    <div id="lista_archivos_zip" style="background: rgba(255,255,255,0.05); border-radius: 10px; padding: 10px;">
                        <!-- Se llenará dinámicamente -->
                    </div>
                </div>
                
                <!-- Opciones de compartir -->
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Enviar por email -->
                    <button onclick="mostrarFormularioEmail()" style="width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 15px; border-radius: 12px; font-size: 0.95rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: transform 0.2s;">
                        <i class="fa-solid fa-envelope"></i> Enviar por Email
                    </button>
                    
                    <!-- Descargar ZIP -->
                    <button onclick="descargarZip()" style="width: 100%; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 15px; border-radius: 12px; font-size: 0.95rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: transform 0.2s;">
                        <i class="fa-solid fa-download"></i> Descargar ZIP
                    </button>
                    
                    <!-- Generar enlace -->
                    <button onclick="generarEnlace()" style="width: 100%; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 15px; border-radius: 12px; font-size: 0.95rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: transform 0.2s;">
                        <i class="fa-solid fa-link"></i> Generar Enlace
                    </button>
                </div>
                
                <!-- Formulario de email (inicialmente oculto) -->
                <div id="formularioEmail" style="display: none; margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(99, 102, 241, 0.3);">
                    <h4 style="color: white; font-size: 0.9rem; margin-bottom: 15px;">
                        <i class="fa-solid fa-paper-plane"></i> Enviar por correo electrónico
                    </h4>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 5px;">Email destino *</label>
                        <input type="email" id="email_destino" placeholder="ejemplo@correo.com" style="width: 100%; background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.3); color: white; padding: 12px; border-radius: 8px; font-size: 0.9rem;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 5px;">Mensaje adicional (opcional)</label>
                        <textarea id="mensaje_email" rows="3" placeholder="Escribe un mensaje..." style="width: 100%; background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.3); color: white; padding: 12px; border-radius: 8px; font-size: 0.9rem; resize: vertical;"></textarea>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button onclick="ocultarFormularioEmail()" style="flex: 1; background: rgba(255,255,255,0.1); color: white; border: none; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                            <i class="fa-solid fa-times"></i> Cancelar
                        </button>
                        <button onclick="enviarEmail()" style="flex: 1; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                            <i class="fa-solid fa-paper-plane"></i> Enviar
                        </button>
                    </div>
                </div>
                
                <!-- Enlace generado (inicialmente oculto) -->
                <div id="enlaceGenerado" style="display: none; margin-top: 20px; padding: 15px; background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.3); border-radius: 12px;">
                    <h4 style="color: white; font-size: 0.9rem; margin-bottom: 10px;">
                        <i class="fa-solid fa-link"></i> Enlace generado
                    </h4>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="text" id="input_enlace" readonly style="flex: 1; background: rgba(255,255,255,0.05); border: 1px solid rgba(99, 102, 241, 0.3); color: white; padding: 10px; border-radius: 8px; font-size: 0.85rem;">
                        <button onclick="copiarEnlace()" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; white-space: nowrap;">
                            <i class="fa-solid fa-copy"></i> Copiar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Documento Firma -->
<div class="reg-modal-overlay-aliado" id="modalCrearDocumentoFirma">
    <div class="reg-modal-container-aliado" style="max-width: 500px;">
        <div class="reg-modal-header-aliado firma-theme">
            <h2><i class="fa-solid fa-file-signature"></i> Firma de Aliado</h2>
            <button class="modal-close-reg" onclick="cerrarModalCrearDocumento()"><i class="fa-solid fa-times"></i></button>
        </div>
        
        <div class="reg-modal-body-aliado">
            <!-- Paso 1: Confirmación -->
            <div id="step_confirmar_firma" style="text-align: center; padding: 1rem 0;">
                <div style="width: 80px; height: 80px; background: rgba(139, 92, 246, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fa-solid fa-file-signature" style="font-size: 2.5rem; color: #8b5cf6;"></i>
                </div>
                <h3 style="color: white; margin-bottom: 1rem;">¿Crear documento de firma?</h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 1.5rem;">
                    Se generará un nuevo registro para capturar la firma digital del aliado. 
                </p>

                <!-- Selección de Tienda -->
                <div class="reg-form-group" style="text-align: left; margin-bottom: 2rem;">
                    <label class="reg-form-label" style="color: rgba(255,255,255,0.6); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Seleccionar Tienda (Opcional)</label>
                    <select id="firma_tienda_cod" class="reg-form-input" style="background: rgba(255,255,255,0.05); border-color: rgba(139, 92, 246, 0.3); color: white;">
                        <option value="0">Cargando tiendas...</option>
                    </select>
                </div>
                <input type="hidden" id="firma_aliado_cod" value="">
                <button type="button" class="reg-submit-btn-aliado" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);" onclick="procesarCreacionDocumento()">
                    <i class="fa-solid fa-check"></i> Sí, crear documento
                </button>
            </div>

            <!-- Paso 2: Compartir (inicialmente oculto) -->
            <div id="step_compartir_firma" style="display: none;">
                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem; text-align: center;">
                    <i class="fa-solid fa-circle-check" style="font-size: 2rem; color: #10b981; margin-bottom: 0.5rem;"></i>
                    <h4 style="color: #10b981; margin: 0;">¡Documento Generado!</h4>
                </div>

                <div class="reg-form-group">
                    <label class="reg-form-label">Enlace de Firma</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" class="reg-form-input" id="input_enlace_signature" readonly style="flex: 1; font-size: 0.8rem;">
                        <button onclick="copiarEnlaceSignature()" style="background: #8b5cf6; color: white; border: none; padding: 0 1rem; border-radius: 12px; cursor: pointer;">
                            <i class="fa-solid fa-copy"></i>
                        </button>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 1.5rem;">
                    <button onclick="enviarSignaturePorWhatsApp()" style="background: #25d366; color: white; border: none; padding: 0.85rem; border-radius: 12px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </button>
                    <button onclick="enviarSignaturePorEmail()" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 0.85rem; border-radius: 12px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-solid fa-envelope"></i> Email
                    </button>
                </div>
                
                <p style="text-align: center; color: rgba(255,255,255,0.5); font-size: 0.75rem; margin-top: 1.5rem;">
                    <i class="fa-solid fa-info-circle"></i> El aliado podrá firmar desde su dispositivo móvil usando este enlace.
                </p>
                
                <!-- Datos ocultos para compartir -->
                <input type="hidden" id="share_firma_aliado_nombre" value="">
                <input type="hidden" id="share_firma_aliado_tel" value="">
                <input type="hidden" id="share_firma_aliado_email" value="">
            </div>
        </div>
        
        <div class="reg-modal-footer-aliado">
            <button class="reg-footer-btn-aliado back-btn" style="flex: 1;" onclick="cerrarModalCrearDocumento()">
                <i class="fa-solid fa-times"></i> Cerrar
            </button>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

<script>
// Inicializar Quill Editor (DESHABILITADO - ya no se usa en modal de tienda)
/*
var quill;
$(document).ready(function() {
    quill = new Quill('#editor_garantia', {
        theme: 'snow',
        placeholder: 'Escribe aquí los términos de la garantía...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['clean']
            ]
        }
    });
});
*/

// JS Modals
function abrirModal() { 
    document.getElementById('modalRegistro').classList.add('show'); 
    // Marcar todas las entidades crediticias por defecto
    setTimeout(function() {
        $('input[name="entidades[]"]').prop('checked', true);
    }, 100);
    // Cargar departamentos en el select del modal de registro
    cargarDepartamentosRegistro();
}

// Cargar departamentos para el modal de registro de aliado
function cargarDepartamentosRegistro() {
    var $select = $('#cod_departamento');
    $select.html('<option value="">Cargando...</option>');
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            $select.html('<option value="">Seleccione...</option>');
            if (response.success && response.departamentos) {
                $.each(response.departamentos, function(i, dept) {
                    $select.append('<option value="' + dept.cod_departamento + '">' + dept.nombre_departamento + '</option>');
                });
            }
        },
        error: function() { $select.html('<option value="">Error al cargar</option>'); }
    });
}

// Cargar municipios según departamento seleccionado (modal registro)
function cargarMunicipiosRegistro(codDepartamento) {
    var $select = $('#cod_municipio');
    if (!codDepartamento || codDepartamento === '') {
        $select.html('<option value="">Primero seleccione departamento</option>');
        return;
    }
    $select.html('<option value="">Cargando...</option>');
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php?cod_departamento=' + codDepartamento, type: 'GET', dataType: 'json',
        success: function(response) {
            $select.html('<option value="">Seleccione...</option>');
            if (response.success && response.municipios) {
                $.each(response.municipios, function(i, muni) {
                    $select.append('<option value="' + muni.cod_municipio + '">' + muni.nombre_municipio + '</option>');
                });
            }
        },
        error: function() { $select.html('<option value="">Error al cargar</option>'); }
    });
}

// Cargar departamentos para el modal de edición con preselección
function cargarDepartamentosEdicion(selectedDept, selectedMuni) {
    var $select = $('#edit_cod_departamento');
    $select.html('<option value="">Cargando...</option>');
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            $select.html('<option value="">Seleccione...</option>');
            if (response.success && response.departamentos) {
                $.each(response.departamentos, function(i, dept) {
                    var selected = (dept.cod_departamento == selectedDept) ? ' selected' : '';
                    $select.append('<option value="' + dept.cod_departamento + '"' + selected + '>' + dept.nombre_departamento + '</option>');
                });
                // Si hay departamento preseleccionado, cargar municipios
                if (selectedDept) {
                    cargarMunicipiosEdicion(selectedDept, selectedMuni);
                }
            }
        },
        error: function() { $select.html('<option value="">Error al cargar</option>'); }
    });
}

// Cargar municipios según departamento seleccionado (modal edición)
function cargarMunicipiosEdicion(codDepartamento, selectedMuni) {
    var $select = $('#edit_cod_municipio');
    if (!codDepartamento || codDepartamento === '') {
        $select.html('<option value="">Primero seleccione departamento</option>');
        return;
    }
    $select.html('<option value="">Cargando...</option>');
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php?cod_departamento=' + codDepartamento, type: 'GET', dataType: 'json',
        success: function(response) {
            $select.html('<option value="">Seleccione...</option>');
            if (response.success && response.municipios) {
                $.each(response.municipios, function(i, muni) {
                    var selected = (selectedMuni && muni.cod_municipio == selectedMuni) ? ' selected' : '';
                    $select.append('<option value="' + muni.cod_municipio + '"' + selected + '>' + muni.nombre_municipio + '</option>');
                });
            }
        },
        error: function() { $select.html('<option value="">Error al cargar</option>'); }
    });
}
function cerrarModal() { 
    document.getElementById('modalRegistro').classList.remove('show');
    // Resetear validación de identificación
    identificacionValida = false;
    $('#identificacion_tercero').css('border-color', '');
    $('#mensaje_identificacion').hide();
    // Habilitar botón de guardar
    $('#btnGuardar').prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
    // Limpiar formulario
    $('#formRegistro')[0].reset();
}
// Función para habilitar/deshabilitar campos de banco
function toggleBancoInputs(codBanco) {
    var checkbox = document.getElementById('banco_' + codBanco);
    var numeroInput = document.getElementById('numero_cuenta_' + codBanco);
    var tipoSelect = document.getElementById('tipo_cuenta_' + codBanco);
    var certContainer = document.getElementById('cert_container_' + codBanco);
    var certInput = document.getElementById('certificado_banco_' + codBanco);
    var nombreTitularInput = document.getElementById('nombre_titular_cuenta_' + codBanco);
    var idTitularInput = document.getElementById('identificacion_titular_cuenta_' + codBanco);
    
    if (checkbox.checked) {
        numeroInput.disabled = false;
        tipoSelect.disabled = false;
        numeroInput.required = true;
        if (certContainer) certContainer.style.display = 'block';
        if (certInput) certInput.disabled = false;
        if (nombreTitularInput) nombreTitularInput.disabled = false;
        if (idTitularInput) idTitularInput.disabled = false;
    } else {
        numeroInput.disabled = true;
        tipoSelect.disabled = true;
        numeroInput.required = false;
        numeroInput.value = '';
        tipoSelect.selectedIndex = 0;
        if (certContainer) certContainer.style.display = 'none';
        if (certInput) {
            certInput.disabled = true;
            certInput.value = '';
        }
        if (nombreTitularInput) {
            nombreTitularInput.disabled = true;
            nombreTitularInput.value = '';
        }
        if (idTitularInput) {
            idTitularInput.disabled = true;
            idTitularInput.value = '';
        }
    }
}
// Función para cambiar etiqueta y mostrar campo NIT cuando se selecciona PERSONA_JURIDICA
function cambiarTipoCliente() {
    var tipoCliente = document.getElementById('nombre_tipo_cliente');
    var labelNombreComercial = document.getElementById('label_nombre_comercial');
    var containerNit = document.getElementById('container_nit_razon_social');
    var inputNit = document.getElementById('nit_razon_social');
    var containerRazonSocial = document.getElementById('container_nombre_razon_social');
    var inputRazonSocial = document.getElementById('nombre_razon_social');
    
    if (tipoCliente.value == 'PERSONA_JURIDICA' || tipoCliente.value == '2') { // PERSONA_JURIDICA
        //labelNombreComercial.textContent = 'Razón Social *';
        containerNit.style.display = 'block';
        inputNit.required = true;
        containerRazonSocial.style.display = 'block';
        inputRazonSocial.required = true;
    } else { // PERSONA_NATURAL u otro
        //labelNombreComercial.textContent = 'Nombre Comercial *';
        containerNit.style.display = 'none';
        inputNit.required = false;
        inputNit.value = '';
        containerRazonSocial.style.display = 'none';
        inputRazonSocial.required = false;
        inputRazonSocial.value = '';
    }
}

function cambiarTipoClienteEditar(limpiarCampos) {
    var tipoCliente = document.getElementById('edit_nombre_tipo_cliente');
    if (!tipoCliente) return;

    var containerNit = document.getElementById('edit_container_nit_razon_social');
    var inputNit = document.getElementById('edit_nit_razon_social');
    var containerRazonSocial = document.getElementById('edit_container_nombre_razon_social');
    var inputRazonSocial = document.getElementById('edit_nombre_razon_social');
    
    if (tipoCliente.value == 'PERSONA_JURIDICA' || tipoCliente.value == '2') {
        if (containerNit) containerNit.style.display = 'block';
        if (inputNit) inputNit.required = true;
        if (containerRazonSocial) containerRazonSocial.style.display = 'block';
        if (inputRazonSocial) inputRazonSocial.required = true;
    } else {
        if (containerNit) containerNit.style.display = 'none';
        if (inputNit) {
            inputNit.required = false;
            if (limpiarCampos) inputNit.value = '';
        }
        if (containerRazonSocial) containerRazonSocial.style.display = 'none';
        if (inputRazonSocial) {
            inputRazonSocial.required = false;
            if (limpiarCampos) inputRazonSocial.value = '';
        }
    }
}
// Función para mostrar campo Nombre Razón Social cuando se selecciona PERSONA_JURIDICA en modal de Tienda
function abrirModalEditar(data) {
    // Guardar el cod_administrador en la variable global para uso posterior
    currentCodAdministradorTienda = data.cod_administrador;
    document.getElementById('edit_cod_administrador').value = data.cod_administrador;
    document.getElementById('edit_nombre_tipo_cliente').value = data.nombre_tipo_cliente || '';
    document.getElementById('edit_cod_tipo_sector').value = data.cod_tipo_sector || '';
    document.getElementById('edit_nombres_apellidos_tercero').value = data.nombres_apellidos_tercero || '';
    document.getElementById('edit_nit_razon_social').value = data.nit_razon_social || '';
    document.getElementById('edit_nombre_razon_social').value = data.nombre_razon_social || '';

    // Actualizar visibilidad según tipo de cliente
    cambiarTipoClienteEditar(false);

    document.getElementById('edit_identificacion').value = data.cedula;
    document.getElementById('edit_nombre_tipo_identificacion').value = data.nombre_tipo_identificacion || data.cod_tipo_cliente || '';
    document.getElementById('edit_nombre').value = data.nombres;
    document.getElementById('edit_apellido').value = data.apellidos;
    document.getElementById('edit_telefono').value = data.telefono || '';
    document.getElementById('edit_correo').value = data.correo || '';
    document.getElementById('edit_direccion_tercero').value = data.direccion_tercero || '';
    document.getElementById('edit_barrio_tercero').value = data.barrio_tercero || '';
    // Cargar departamentos y preseleccionar departamento/municipio
    cargarDepartamentosEdicion(data.cod_departamento || '', data.cod_municipio || '');
    document.getElementById('edit_cod_asesor').value = data.cod_asesor || '';
    document.getElementById('edit_cod_asesor_hidden').value = data.cod_asesor || '';
    document.getElementById('edit_estado').value = data.cod_estado_activacion_usuario;
    document.getElementById('edit_estado_hidden').value = data.cod_estado_activacion_usuario;
    // Cargar nombre de usuario (el campo cuenta contiene el nombre de usuario)
    document.getElementById('edit_usuario').value = data.cuenta || data.cedula || '';
    // Cargar documentación legal si existe
    var editRutActual = document.getElementById('edit_rut_actual');
    var editRutInput = document.getElementById('edit_rut_input');
    var editCamaraActual = document.getElementById('edit_camara_actual');
    var editCamaraInput = document.getElementById('edit_camara_input');
    // Manejar RUT
    if (data.url_documentacion_rut_aliado && data.url_documentacion_rut_aliado.trim() !== '') {
        editRutActual.style.display = 'block';
        editRutActual.querySelector('a').href = data.url_documentacion_rut_aliado;
        editRutInput.style.display = 'block'; // Mostrar siempre para permitir cambiar
    } else {
        editRutActual.style.display = 'none';
        editRutInput.style.display = 'block'; // Mostrar si no existe
    }
    // Manejar Cámara de Comercio
    if (data.url_documentacion_camaracomercio_aliado && data.url_documentacion_camaracomercio_aliado.trim() !== '') {
        editCamaraActual.style.display = 'block';
        editCamaraActual.querySelector('a').href = data.url_documentacion_camaracomercio_aliado;
        editCamaraInput.style.display = 'block'; // Mostrar siempre para permitir cambiar
    } else {
        editCamaraActual.style.display = 'none';
        editCamaraInput.style.display = 'block'; // Mostrar si no existe
    }
    // Manejar Cédula
    var editCedulaActual = document.getElementById('edit_cedula_actual');
    var editCedulaInput = document.getElementById('edit_cedula_input');
    if (editCedulaActual && editCedulaInput) {
        if (data.url_documentacion_cedula_aliado && data.url_documentacion_cedula_aliado.trim() !== '') {
            editCedulaActual.style.display = 'block';
            editCedulaActual.querySelector('a').href = data.url_documentacion_cedula_aliado;
            editCedulaInput.style.display = 'block'; // Mostrar siempre para permitir cambiar
        } else {
            editCedulaActual.style.display = 'none';
            editCedulaInput.style.display = 'block'; // Mostrar si no existe
        }
    }
    // Limpiar el contenedor de entidades y mostrar loading
    $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Cargando entidades...</p></div>');
    
    // Cargar entidades crediticias asignadas al aliado
    $.ajax({
        url: '../admin/obtener_entidades_aliado_ajax.php', type: 'POST', data: { cod_administrador: data.cod_administrador }, dataType: 'json',
        success: function(response) {
            //console.log('Respuesta obtener_entidades_aliado_ajax:', response);
            if (response.success && response.entidades && response.entidades.length > 0) {
                //console.log('Cargando ' + response.entidades.length + ' entidades');
                var html = '';
                response.entidades.forEach(function(entidad) {
                    //console.log('Cargando entidad:', entidad);
                    var interes = entidad.interes_ptj || '';
                    var portal_checked = entidad.cod_estado_entrar_portal == '1' ? 'checked' : '';
                    var url = entidad.url_pagina_web_consulta || '';
                    var estado = entidad.cod_estado || '1';
                    
                    // Colores según estado
                    var bgColor = estado == '1' ? 'rgba(16, 185, 129, 0.08)' : 'rgba(239, 68, 68, 0.08)';
                    var borderColor = estado == '1' ? 'rgba(16, 185, 129, 0.15)' : 'rgba(239, 68, 68, 0.15)';
                    
                    html += '<div id="entidad_item_' + entidad.cod_parametrizacion_entidad_crediticia_aliado + '" style="display: grid; grid-template-columns: 1fr; gap: 0.5rem; margin-bottom: 0.5rem; padding: 0.75rem; background: ' + bgColor + '; border: 1px solid ' + borderColor + '; border-radius: 10px;">';
                    
                    // Primera fila: Logo y Nombre de la entidad
                    html += '<div style="display: flex; align-items: center; justify-content: space-between; gap: 0.5rem;">';
                    html += '<div style="display: flex; align-items: center; gap: 0.5rem;">';
                    
                    // Logo de la entidad
                    var urlImagen = entidad.url_entidad_crediticia_imag_min || '../imagenes/logo_placeholder.png';
                    html += '<div style="background: rgba(255,255,255,0.1); padding: 0.3rem; border-radius: 6px; display: flex; align-items: center; justify-content: center; min-width: 40px; height: 32px;">';
                    html += '<img src="' + urlImagen + '" alt="' + escapeHtmlMovil(entidad.nombre_entidad_crediticia) + '" style="max-height: 26px; max-width: 36px; object-fit: contain;">';
                    html += '</div>';
                    
                    // Nombre de la entidad
                    html += '<label style="color: rgba(255,255,255,0.95); font-size: 0.9rem; font-weight: 600; margin: 0;">' + escapeHtmlMovil(entidad.nombre_entidad_crediticia) + '</label>';
                    html += '</div>';
                    html += '</div>';
                    
                    // Segunda fila: Campos editables
                    html += '<div style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 0.5rem; align-items: center;">';
                    
                    // % Administrativo
                    html += '<div style="background: rgba(0,0,0,0.2); padding: 0.4rem; border-radius: 6px;">';
                    html += '<label style="color: rgba(255,255,255,0.6); font-size: 0.65rem; display: block; margin-bottom: 0.2rem;">% Adtvo</label>';
                    html += '<input type="number" step="0.01" min="0" max="100" class="form-input" id="edit_interes_' + entidad.cod_parametrizacion_entidad_crediticia_aliado + '" value="' + interes + '" placeholder="0.00" style="width: 100%; padding: 0.3rem; font-size: 0.8rem; text-align: center;">';
                    html += '</div>';
                    
                    // Portal
                    html += '<div style="background: rgba(0,0,0,0.2); padding: 0.4rem; border-radius: 6px; text-align: center;">';
                    html += '<label style="color: rgba(255,255,255,0.6); font-size: 0.65rem; display: block; margin-bottom: 0.2rem;">Portal</label>';
                    html += '<input type="checkbox" id="edit_portal_' + entidad.cod_parametrizacion_entidad_crediticia_aliado + '" ' + portal_checked + ' style="accent-color: #10b981; width: 18px; height: 18px; cursor: pointer;">';
                    html += '</div>';
                    // Estado
                    html += '<div style="background: rgba(0,0,0,0.2); padding: 0.4rem; border-radius: 6px;">';
                    html += '<label style="color: rgba(255,255,255,0.6); font-size: 0.65rem; display: block; margin-bottom: 0.2rem;">Estado</label>';
                    html += '<select id="edit_estado_entidad_' + entidad.cod_parametrizacion_entidad_crediticia_aliado + '" class="form-select" style="width: 100%; padding: 0.3rem; font-size: 0.75rem;">';
                    html += '<option value="1"' + (estado == '1' ? ' selected' : '') + '>Activo</option>';
                    html += '<option value="0"' + (estado == '0' ? ' selected' : '') + '>Inactivo</option>';
                    html += '</select>';
                    html += '</div>';
                    
                    // Botón Guardar
                    html += '<button type="button" onclick="guardarEntidadEditada(' + entidad.cod_parametrizacion_entidad_crediticia_aliado + ')" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 0.5rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; height: fit-content; align-self: end;" title="Guardar cambios"><i class="fa-solid fa-save"></i></button>';
                    html += '</div>';
                    
                    html += '</div>';
                });
                $('#contenedor_entidades_editar').html(html);
            } else {
                console.log('No hay entidades o error:', response);
                $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-info-circle" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: rgba(16, 185, 129, 0.4);"></i><p style="margin: 0; font-size: 0.85rem;">No hay entidades asignadas a este aliado.</p></div>');
            }
        },
        error: function(xhr, status, error) {
            //console.log('Error en AJAX:', status, error);
            //console.log('Respuesta del servidor:', xhr.responseText);
            $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(239, 68, 68, 0.8);"><i class="fa-solid fa-exclamation-triangle" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Error al cargar entidades. Intente nuevamente.</p></div>');
        }
    });
    // Cargar bancos del aliado
    cargarBancosAliado(data.cod_administrador);
    // Cargar tiendas del aliado
    cargarTiendasAliado(data.cod_administrador);
    document.getElementById('modalEditar').classList.add('show');
}

// Función para cargar bancos del aliado en modal editar
function cargarBancosAliado(codAdministrador) {
    $('#contenedor_bancos_editar').html('<div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Cargando bancos...</p></div>');
    
    $.ajax({
        url: '../admin/obtener_bancos_aliado_ajax.php', type: 'POST', data: { cod_administrador: codAdministrador }, dataType: 'json',
        success: function(response) {
            if (response.success && response.bancos && response.bancos.length > 0) {
                var html = '';
                response.bancos.forEach(function(banco) {
                    // Colores según estado
                    var isActive = banco.cod_estado == '1';
                    var statusColor = isActive ? '#10b981' : '#ef4444';
                    var statusBg = isActive ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)';
                    var cardBorder = isActive ? 'rgba(16, 185, 129, 0.2)' : 'rgba(239, 68, 68, 0.2)';
                    
                    html += '<div id="banco_item_' + banco.cod_banco_cuenta + '" style="background: rgba(255, 255, 255, 0.03); border: 1px solid ' + cardBorder + '; border-radius: 12px; margin-bottom: 1rem; overflow: hidden; position: relative;">';
                    
                    // Header de la tarjeta
                    html += '<div style="padding: 0.75rem 1rem; background: rgba(0, 0, 0, 0.2); border-bottom: 1px solid rgba(255, 255, 255, 0.05); display: flex; justify-content: space-between; align-items: center;">';
                    html += '<div style="display: flex; align-items: center; gap: 0.5rem;">';
                    html += '<i class="fa-solid fa-building-columns" style="color: ' + statusColor + ';"></i>';
                    html += '<span style="font-weight: 600; color: white; font-size: 0.9rem;">' + escapeHtmlMovil(banco.nombre_banco_cuenta) + '</span>';
                    html += '</div>';
                    html += '<div style="background: ' + statusBg + '; color: ' + statusColor + '; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.7rem; font-weight: 600;">';
                    html += isActive ? 'ACTIVO' : 'INACTIVO';
                    html += '</div>';
                    html += '</div>';

                    // Cuerpo de la tarjeta
                    html += '<div style="padding: 1rem;">';
                    
                    // Fila 1: Número y Tipo
                    html += '<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">';
                    html += '<div>';
                    html += '<label style="color: rgba(255,255,255,0.5); font-size: 0.7rem; margin-bottom: 0.3rem; display: block;">Número de Cuenta</label>';
                    html += '<input type="text" id="edit_numero_' + banco.cod_banco_cuenta + '" value="' + escapeHtmlMovil(banco.numero_banco_cuenta) + '" style="background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white; padding: 0.5rem; border-radius: 6px; font-size: 0.85rem; width: 100%;">';
                    html += '</div>';
                    html += '<div>';
                    html += '<label style="color: rgba(255,255,255,0.5); font-size: 0.7rem; margin-bottom: 0.3rem; display: block;">Tipo de Cuenta</label>';
                    html += '<select id="edit_tipo_' + banco.cod_banco_cuenta + '" style="background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white; padding: 0.5rem; border-radius: 6px; font-size: 0.85rem; width: 100%;">';
                    html += '<option value="1" ' + (banco.cod_tipo_cuenta_banco == '1' ? ' selected' : '') + '>Ahorros</option>';
                    html += '<option value="2" ' + (banco.cod_tipo_cuenta_banco == '2' ? ' selected' : '') + '>Corriente</option>';
                    html += '</select>';
                    html += '</div>';
                    html += '</div>';

                    // Fila 2: Titular
                    html += '<div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 1rem; margin-bottom: 1rem;">';
                    html += '<div>';
                    html += '<label style="color: rgba(255,255,255,0.5); font-size: 0.7rem; margin-bottom: 0.3rem; display: block;">Nombre del Titular</label>';
                    html += '<div style="position: relative;">';
                    html += '<i class="fa-solid fa-user" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.3); font-size: 0.8rem;"></i>';
                    html += '<input type="text" id="edit_nombre_titular_' + banco.cod_banco_cuenta + '" value="' + escapeHtmlMovil(banco.nombre_titular_cuenta || '') + '" placeholder="Nombre completo" style="background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white; padding: 0.5rem 0.5rem 0.5rem 2rem; border-radius: 6px; font-size: 0.85rem; width: 100%;">';
                    html += '</div>';
                    html += '</div>';
                    html += '<div>';
                    html += '<label style="color: rgba(255,255,255,0.5); font-size: 0.7rem; margin-bottom: 0.3rem; display: block;">CC / NIT Titular</label>';
                    html += '<div style="position: relative;">';
                    html += '<i class="fa-solid fa-id-card" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.3); font-size: 0.8rem;"></i>';
                    html += '<input type="text" id="edit_id_titular_' + banco.cod_banco_cuenta + '" value="' + escapeHtmlMovil(banco.identificacion_titular_cuenta || '') + '" placeholder="Documento" style="background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white; padding: 0.5rem 0.5rem 0.5rem 2rem; border-radius: 6px; font-size: 0.85rem; width: 100%;">';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    // Fila 3: Certificado y Estado 
                    html += '<div style="display: grid; grid-template-columns: 1fr 0.8fr; gap: 1rem; align-items: end;">';
                    html += '<div>';
                    html += '<label style="color: rgba(255,255,255,0.5); font-size: 0.7rem; margin-bottom: 0.3rem; display: block;">Certificado Bancario</label>';
                    html += '<div style="display: flex; gap: 0.5rem;">';
                    html += '<input type="file" id="edit_certificado_' + banco.cod_banco_cuenta + '" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx" style="flex: 1; background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white; padding: 0.35rem; border-radius: 6px; font-size: 0.75rem;">';
                    if (banco.url_certificado_banco_cuenta && banco.url_certificado_banco_cuenta !== '') {
                        html += '<a href="' + banco.url_certificado_banco_cuenta + '" target="_blank" class="btn-check-cert" style="background: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); padding: 0 0.8rem; border-radius: 6px; display: flex; align-items: center; justify-content: center; text-decoration: none;" title="Ver certificado actual"><i class="fa-solid fa-eye"></i></a>';
                    }
                    html += '</div>';
                    html += '</div>';
                    
                    html += '<div>';
                    html += '<label style="color: rgba(255,255,255,0.5); font-size: 0.7rem; margin-bottom: 0.3rem; display: block;">Estado de Cuenta</label>';
                    html += '<select id="edit_estado_' + banco.cod_banco_cuenta + '" style="background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white; padding: 0.5rem; border-radius: 6px; font-size: 0.85rem; width: 100%;">';
                    html += '<option value="1" ' + (banco.cod_estado == '1' ? ' selected' : '') + '>Activa</option>';
                    html += '<option value="0" ' + (banco.cod_estado == '0' ? ' selected' : '') + '>Inactiva</option>';
                    html += '</select>';
                    html += '</div>';
                    html += '</div>';

                    html += '</div>'; // Fin cuerpo
                    
                    // Footer de acciones
                    html += '<div style="padding: 0.75rem 1rem; background: rgba(0, 0, 0, 0.2); border-top: 1px solid rgba(255, 255, 255, 0.05); display: flex; justify-content: flex-end; gap: 0.5rem;">';
                    //html += '<button type="button" onclick="eliminarBancoAliado(' + banco.cod_banco_cuenta + ', \'' + escapeHtmlMovil(banco.nombre_banco_cuenta) + '\')" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); padding: 0.5rem 1rem; border-radius: 6px; font-size: 0.8rem; cursor: pointer; transition: all 0.2s;"><i class="fa-solid fa-trash-can"></i> Eliminar</button>';
                    html += '<button type="button" onclick="guardarBancoEditado(' + banco.cod_banco_cuenta + ')" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: pointer; box-shadow: 0 2px 10px rgba(59, 130, 246, 0.3);"><i class="fa-solid fa-save"></i> Guardar Cambios</button>';
                    html += '</div>';

                    html += '</div>'; // Fin tarjeta
                });
                $('#contenedor_bancos_editar').html(html);
            } else {
                $('#contenedor_bancos_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-info-circle" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: rgba(16, 185, 129, 0.4);"></i><p style="margin: 0; font-size: 0.85rem;">No hay cuentas bancarias asignadas.</p></div>');
            }
        },
        error: function() {
            $('#contenedor_bancos_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(239, 68, 68, 0.8);"><i class="fa-solid fa-exclamation-triangle" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Error al cargar bancos.</p></div>');
        }
    });
}

// Función para guardar cambios en cuenta bancaria
function guardarBancoEditado(codBancoCuenta) {
    var numeroCuenta = $('#edit_numero_' + codBancoCuenta).val().trim();
    var tipoCuenta = $('#edit_tipo_' + codBancoCuenta).val();
    var estadoCuenta = $('#edit_estado_' + codBancoCuenta).val();
    var certificadoFile = document.getElementById('edit_certificado_' + codBancoCuenta).files[0];
    
    if (numeroCuenta === '') {
        Swal.fire({ icon: 'warning', title: 'Campo requerido', text: 'El número de cuenta no puede estar vacío', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    Swal.fire({ title: 'Guardando...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    var formData = new FormData();
    formData.append('cod_banco_cuenta', codBancoCuenta);
    formData.append('numero_banco_cuenta', numeroCuenta);
    formData.append('cod_tipo_cuenta_banco', tipoCuenta);
    formData.append('cod_estado', estadoCuenta);
    // Nuevos campos
    var nombreTitular = $('#edit_nombre_titular_' + codBancoCuenta).val().trim();
    var idTitular = $('#edit_id_titular_' + codBancoCuenta).val().trim();
    formData.append('nombre_titular_cuenta', nombreTitular);
    formData.append('identificacion_titular_cuenta', idTitular);
    if (certificadoFile) {
        formData.append('certificado_banco', certificadoFile);
    }
    
    $.ajax({ url: '../admin/actualizar_banco_aliado_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json', success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({ icon: 'success', title: '¡Actualizado!', text: 'Cuenta bancaria actualizada correctamente', background: '#1a1f2e', color: 'white', timer: 2000, timerProgressBar: true, customClass: { container: 'swal-high-zindex' } });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje || 'No se pudo actualizar la cuenta', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión. Intenta nuevamente.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
}

// Función para eliminar banco del aliado
function eliminarBancoAliado(codBancoCuenta, nombreBanco) {
    Swal.fire({
        title: '¿Eliminar cuenta bancaria?',
        html: '<div style="text-align: left; padding: 1rem;"><p style="margin-bottom: 0.5rem;">Se eliminará la cuenta de:</p><strong style="color: #10b981;">' + nombreBanco + '</strong><p style="margin-top: 0.5rem; color: #ef4444; font-size: 0.85rem;">Esta acción no se puede deshacer.</p></div>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fa-solid fa-trash"></i> Sí, eliminar',
        cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        background: '#1a1f2e',
        color: 'white',
        customClass: { container: 'swal-high-zindex' }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/eliminar_banco_aliado_ajax.php',
                type: 'POST',
                data: { cod_banco_cuenta: codBancoCuenta },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ icon: 'success', title: '¡Eliminado!', text: 'Cuenta bancaria eliminada correctamente', background: '#1a1f2e', color: 'white', timer: 2000, customClass: { container: 'swal-high-zindex' } });
                        var codAdmin = $('#edit_cod_administrador').val();
                        cargarBancosAliado(codAdmin);
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje || 'No se pudo eliminar la cuenta', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                    }
                }
            });
        }
    });
}

// Función para cargar tiendas del aliado en modal editar
function cargarTiendasAliado(codAdministrador) {
    $('#contenedor_tiendas_editar').html('<div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Cargando tiendas...</p></div>');
    
    $.ajax({
        url: '../admin/obtener_tiendas_por_aliado_ajax.php',
        type: 'POST',
        data: { cod_aliado_estrategico: codAdministrador },
        dataType: 'json',
        success: function(response) {
            if (response.success && response.tiendas && response.tiendas.length > 0) {
                var html = '';
                response.tiendas.forEach(function(tienda) {
                    // Colores según estado
                    var estado = tienda.cod_estado || '1';
                    var bgColor = estado == '1' ? 'rgba(16, 185, 129, 0.08)' : 'rgba(239, 68, 68, 0.08)';
                    var borderColor = estado == '1' ? 'rgba(16, 185, 129, 0.15)' : 'rgba(239, 68, 68, 0.15)';
                    
                    html += '<div id="tienda_item_' + tienda.cod_tienda + '" style="padding: 0.75rem; background: ' + bgColor + '; border: 1px solid ' + borderColor + '; border-radius: 10px; margin-bottom: 0.5rem;">';
                    
                    // Grid de campos editables
                    html += '<div style="display: grid; grid-template-columns: 1fr auto; gap: 0.5rem; align-items: start;">';
                    html += '<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.5rem;">';
                    
                    // Nombre de la tienda
                    html += '<div style="grid-column: 1 / -1;"><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;"><i class="fa-solid fa-store"></i> Nombre de la Tienda</label>';
                    html += '<input type="text" id="edit_nombre_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.nombre_tienda) + '" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // NIT/CC
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">NIT/CC</label>';
                    html += '<input type="text" id="edit_nit_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.identificacion_tercero || '') + '" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // Teléfono
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Teléfono</label>';
                    html += '<input type="text" id="edit_telefono_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.telefono1_tercero || '') + '" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // Correo
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Correo</label>';
                    html += '<input type="email" id="edit_correo_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.correo_tercero || '') + '" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // Dirección
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Dirección</label>';
                    html += '<input type="text" id="edit_direccion_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.direccion_tercero || '') + '" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // Departamento
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Departamento</label>';
                    html += '<select id="edit_departamento_tienda_' + tienda.cod_tienda + '" onchange="cargarMunicipiosEditar(' + tienda.cod_tienda + ', this.value)" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"><option value="">Cargando...</option></select></div>';
                    
                    // Municipio
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Municipio</label>';
                    html += '<select id="edit_municipio_tienda_' + tienda.cod_tienda + '" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"><option value="">Cargando...</option></select></div>';
                    
                    html += '</div>';
                    
                    // Columna derecha: Estado y botón guardar
                    html += '<div style="display: flex; flex-direction: column; gap: 0.5rem;">';
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Estado</label>';
                    html += '<select id="edit_estado_tienda_' + tienda.cod_tienda + '" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;">';
                    html += '<option value="1" style="background: #1a1f2e; color: white;"' + (estado == '1' ? ' selected' : '') + '>Activo</option>';
                    html += '<option value="0" style="background: #1a1f2e; color: white;"' + (estado == '0' ? ' selected' : '') + '>Inactivo</option>';
                    html += '</select></div>';
                    html += '<button type="button" onclick="guardarTiendaEditada(' + tienda.cod_tienda + ')" style="background: #3b82f6; color: white; border: none; padding: 0.5rem 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.75rem; white-space: nowrap;" title="Guardar cambios"><i class="fa-solid fa-save"></i> Guardar</button>';
                    html += '</div>';
                    
                    html += '</div>';
                    
                    // Botón ver detalle
                    html += '<div style="margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px solid rgba(255,255,255,0.1);">';
                    html += '<a href="../admin/ver_detalle_tienda_movil.php?cod_tienda=' + tienda.cod_tienda + '" target="_blank" style="display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; cursor: pointer; text-decoration: none;"><i class="fa-solid fa-eye"></i> Ver Detalle Completo</a>';
                    html += '</div>';
                    
                    html += '</div>';
                });
                $('#contenedor_tiendas_editar').html(html);
                
                // Cargar departamentos y municipios para cada tienda
                response.tiendas.forEach(function(tienda) {
                    console.log('Cargando ubicación para tienda:', tienda.nombre_tienda, 'Dept:', tienda.cod_departamento, 'Muni:', tienda.cod_municipio);
                    cargarDepartamentosEditar(tienda.cod_tienda, tienda.cod_departamento, tienda.cod_municipio);
                });
            } else {
                $('#contenedor_tiendas_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-store" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: rgba(16, 185, 129, 0.4);"></i><p style="margin: 0; font-size: 0.85rem;">No hay tiendas asociadas a este aliado.</p></div>');
            }
        },
        error: function() {
            $('#contenedor_tiendas_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(239, 68, 68, 0.8);"><i class="fa-solid fa-exclamation-triangle" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Error al cargar tiendas.</p></div>');
        }
    });
}

// Función para guardar cambios de tienda editada in situ
function guardarTiendaEditada(codTienda) {
    var nombreTienda = $('#edit_nombre_tienda_' + codTienda).val().trim();
    var nitTienda = $('#edit_nit_tienda_' + codTienda).val().trim();
    var telefonoTienda = $('#edit_telefono_tienda_' + codTienda).val().trim();
    var correoTienda = $('#edit_correo_tienda_' + codTienda).val().trim();
    var direccionTienda = $('#edit_direccion_tienda_' + codTienda).val().trim();
    var departamentoTienda = $('#edit_departamento_tienda_' + codTienda).val();
    var municipioTienda = $('#edit_municipio_tienda_' + codTienda).val();
    var estadoTienda = $('#edit_estado_tienda_' + codTienda).val();
    
    // Validaciones básicas
    if (nombreTienda === '') {
        Swal.fire({ 
            icon: 'warning', 
            title: 'Campo requerido', 
            text: 'El nombre de la tienda no puede estar vacío', 
            background: '#1a1f2e', 
            color: 'white',
            customClass: { container: 'swal-high-zindex' }
        });
        return;
    }
    
    if (nitTienda === '') {
        Swal.fire({ 
            icon: 'warning', 
            title: 'Campo requerido', 
            text: 'El NIT/Documento no puede estar vacío', 
            background: '#1a1f2e', 
            color: 'white',
            customClass: { container: 'swal-high-zindex' }
        });
        return;
    }
    
    if (telefonoTienda === '') {
        Swal.fire({ 
            icon: 'warning', 
            title: 'Campo requerido', 
            text: 'El teléfono no puede estar vacío', 
            background: '#1a1f2e', 
            color: 'white',
            customClass: { container: 'swal-high-zindex' }
        });
        return;
    }
    
    if (correoTienda === '') {
        Swal.fire({ 
            icon: 'warning', 
            title: 'Campo requerido', 
            text: 'El correo no puede estar vacío', 
            background: '#1a1f2e', 
            color: 'white',
            customClass: { container: 'swal-high-zindex' }
        });
        return;
    }
    
    Swal.fire({
        title: 'Guardando...',
        didOpen: () => { Swal.showLoading() },
        allowOutsideClick: false,
        background: '#1a1f2e',
        color: 'white',
        customClass: { container: 'swal-high-zindex' }
    });
    
    $.ajax({
        url: '../admin/actualizar_tienda_insitu_ajax.php',
        type: 'POST',
        data: {
            cod_tienda: codTienda,
            nombre1_tercero: nombreTienda,
            identificacion_tercero: nitTienda,
            telefono1_tercero: telefonoTienda,
            correo_tercero: correoTienda,
            direccion_tercero: direccionTienda,
            cod_departamento: departamentoTienda,
            cod_municipio: municipioTienda,
            cod_estado: estadoTienda
        },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({ 
                    icon: 'success', 
                    title: '¡Actualizada!', 
                    text: 'Tienda actualizada correctamente', 
                    background: '#1a1f2e', 
                    color: 'white', 
                    timer: 2000,
                    timerProgressBar: true,
                    customClass: { container: 'swal-high-zindex' }
                }).then(() => {
                    // Recargar la lista de tiendas
                    cargarTiendasAliado(currentCodAdministradorTienda);
                });
            } else {
                Swal.fire({ 
                    icon: 'error', 
                    title: 'Error', 
                    text: response.mensaje || 'No se pudo actualizar la tienda', 
                    background: '#1a1f2e', 
                    color: 'white',
                    customClass: { container: 'swal-high-zindex' }
                });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'Error de conexión. Intenta nuevamente.', 
                background: '#1a1f2e', 
                color: 'white',
                customClass: { container: 'swal-high-zindex' }
            });
        }
    });
}

// Función para cargar departamentos en modo edición
function cargarDepartamentosEditar(codTienda, selectedDept, selectedMuni) {
    console.log('Cargando departamentos para tienda:', codTienda);
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Respuesta departamentos editar:', response);
            if (response.success) {
                var select = $('#edit_departamento_tienda_' + codTienda);
                select.empty();
                select.append('<option value="">Seleccionar Departamento *</option>');
                
                $.each(response.departamentos, function(index, dept) {
                    var selected = (dept.cod_departamento == selectedDept) ? 'selected' : '';
                    select.append('<option value="' + dept.cod_departamento + '" ' + selected + '>' + 
                                dept.nombre_departamento + '</option>');
                });
                
                // Si hay un departamento seleccionado, cargar sus municipios
                if (selectedDept) {
                    cargarMunicipiosEditar(codTienda, selectedDept, selectedMuni);
                }
            } else {
                console.error('Error en respuesta editar:', response.mensaje);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX al cargar departamentos para tienda ' + codTienda + ':', status, error);
            console.error('Respuesta:', xhr.responseText);
        }
    });
}

// Función para cargar municipios en modo edición
function cargarMunicipiosEditar(codTienda, codDepartamento, selectedMuni) {
    var selectMuni = $('#edit_municipio_tienda_' + codTienda);
    selectMuni.empty();
    selectMuni.append('<option value="">Seleccionar Municipio *</option>');
    
    if (!codDepartamento) {
        return;
    }
    
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php',
        type: 'GET',
        data: { cod_departamento: codDepartamento },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $.each(response.municipios, function(index, muni) {
                    var selected = (muni.cod_municipio == selectedMuni) ? 'selected' : '';
                    selectMuni.append('<option value="' + muni.cod_municipio + '" ' + selected + '>' + 
                                    muni.nombre_municipio + '</option>');
                });
            }
        },
        error: function() {
            console.error('Error al cargar municipios para departamento ' + codDepartamento);
        }
    });
}

// Función para cargar municipios en el modal de agregar tienda
function cargarMunicipiosTienda(codDepartamento, targetSelect) {
    var select = $(targetSelect);
    select.empty();
    select.append('<option value="">Seleccionar Municipio *</option>');
    
    if (!codDepartamento) {
        return;
    }
    
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php',
        type: 'GET',
        data: { cod_departamento: codDepartamento },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $.each(response.municipios, function(index, muni) {
                    select.append('<option value="' + muni.cod_municipio + '">' + 
                                muni.nombre_municipio + '</option>');
                });
            }
        },
        error: function() {
            console.error('Error al cargar municipios');
        }
    });
}

// Variable global para almacenar el cod_administrador actual
var currentCodAdministradorTienda = null;

// Función para abrir modal de agregar tienda
function abrirModalAgregarTienda() {
    currentCodAdministradorTienda = $('#edit_cod_administrador').val();
    if (!currentCodAdministradorTienda) {
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'No se pudo identificar el aliado',
            background: '#1a1f2e',
            color: 'white',
            customClass: { container: 'swal-high-zindex' }
        });
        return;
    }
    
    // Resetear el formulario
    document.getElementById('formAgregarTienda').reset();
    document.getElementById('agregar_tienda_cod_aliado').value = currentCodAdministradorTienda;
    
    // Resetear previews de archivos
    resetearPreviewsTienda();
    
    // Cargar departamentos
    cargarDepartamentosModalAgregar();
    
    // Abrir el modal
    document.getElementById('modalAgregarTienda').classList.add('show');
}

// Función para cargar departamentos en el modal de agregar tienda
function cargarDepartamentosModalAgregar() {
    console.log('Cargando departamentos...');
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Respuesta departamentos:', response);
            if (response.success) {
                var select = $('#tienda_departamento');
                select.empty();
                select.append('<option value="">Seleccionar Departamento *</option>');
                
                $.each(response.departamentos, function(index, dept) {
                    select.append('<option value="' + dept.cod_departamento + '">' + 
                                dept.nombre_departamento + '</option>');
                });
                console.log('Departamentos cargados:', response.departamentos.length);
            } else {
                console.error('Error en respuesta:', response.mensaje);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX al cargar departamentos:', status, error);
            console.error('Respuesta:', xhr.responseText);
        }
    });
}

// Función para cerrar modal de agregar tienda
function cerrarModalAgregarTienda() {
    document.getElementById('modalAgregarTienda').classList.remove('show');
    document.getElementById('formAgregarTienda').reset();
    resetearPreviewsTienda();
}

// Cerrar modal al hacer clic fuera
document.getElementById('modalAgregarTienda').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModalAgregarTienda();
    }
});

// Función para cargar bancos del aliado para el modal de tienda - DESHABILITADA (ya no hay campo de banco)
/*
function cargarBancosTienda(codAliado) {
    var bancoSelect = document.getElementById('tienda_banco');
    var loading = document.getElementById('loading_bancos_tienda');
    
    bancoSelect.disabled = true;
    loading.style.display = 'block';
    
    $.ajax({
        url: 'obtener_bancos_cuenta_por_aliado_ajax.php',
        type: 'POST',
        data: { cod_aliado_estrategico: codAliado },
        dataType: 'json',
        success: function(response) {
            bancoSelect.innerHTML = '<option value="">-- Seleccione un banco --</option>';
            
            if (response.success && response.bancos && response.bancos.length > 0) {
                response.bancos.forEach(function(banco) {
                    var textoOpcion = banco.nombre_banco_cuenta + ' - ' + banco.numero_banco_cuenta;
                    if (banco.nombre_titular_cuenta) {
                        textoOpcion += ' (' + banco.nombre_titular_cuenta + ')';
                    }
                    bancoSelect.innerHTML += '<option value="' + banco.cod_banco_cuenta + '">' + textoOpcion + '</option>';
                });
            } else {
                bancoSelect.innerHTML = '<option value="">-- No hay bancos registrados --</option>';
            }
            bancoSelect.disabled = false;
            loading.style.display = 'none';
        },
        error: function() {
            loading.style.display = 'none';
            bancoSelect.innerHTML = '<option value="">-- Error al cargar bancos --</option>';
            bancoSelect.disabled = false;
        }
    });
}
*/

// Función para resetear previews de tienda
function resetearPreviewsTienda() {
    // Resetear previews de imágenes
    document.getElementById('preview_logo_tienda').innerHTML = '<i class="fa-solid fa-image" style="font-size: 1.5rem; color: rgba(16, 185, 129, 0.6);"></i><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.6); font-size: 0.75rem;">Clic para seleccionar</p>';
    document.getElementById('preview_fachada_tienda').innerHTML = '<i class="fa-solid fa-store" style="font-size: 1.2rem; color: rgba(16, 185, 129, 0.6);"></i><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.65rem;">Fachada</p>';
    document.getElementById('preview_interna_tienda').innerHTML = '<i class="fa-solid fa-person-shelter" style="font-size: 1.2rem; color: rgba(16, 185, 129, 0.6);"></i><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.65rem;">Interna</p>';
    document.getElementById('preview_selfie_tienda').innerHTML = '<i class="fa-solid fa-camera-retro" style="font-size: 1.5rem; color: rgba(16, 185, 129, 0.6);"></i><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.6); font-size: 0.75rem;">Clic para seleccionar</p>';
}

// Función para mostrar nombre de archivo
function mostrarNombreArchivoTienda(input, previewId) {
    var preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        var fileName = input.files[0].name;
        if (fileName.length > 20) {
            fileName = fileName.substring(0, 17) + '...';
        }
        preview.innerHTML = '<i class="fa-solid fa-check-circle" style="font-size: 1.5rem; color: #10b981;"></i><p style="margin: 0.25rem 0 0 0; color: #10b981; font-size: 0.75rem;">' + fileName + '</p>';
    }
}

// Función para mostrar preview de imagen
function mostrarImagenPreviewTienda(input, previewId) {
    var preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" style="max-height: 60px; max-width: 100%; border-radius: 8px; object-fit: contain;">';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Enviar formulario de tienda
$('#formAgregarTienda').on('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Registrando tienda...',
        didOpen: () => { Swal.showLoading(); },
        allowOutsideClick: false,
        background: '#1a1f2e',
        color: 'white',
        customClass: { container: 'swal-high-zindex' }
    });
    
    var formData = new FormData(this);
    
    $.ajax({
        url: '../admin/reg_edit_tienda_modal_asesor_movil_ajax_reg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                cerrarModalAgregarTienda();
                // Guardar datos en el modal de confirmación de tienda
                document.getElementById('confirm_tienda_cod').value = response.cod_tienda || '';
                document.getElementById('confirm_tienda_nombre').value = response.nombre_tienda || '';
                document.getElementById('confirm_tienda_cod_aliado').value = document.getElementById('agregar_tienda_cod_aliado').value;
                document.getElementById('confirm_tienda_nombre_display').textContent = response.nombre_tienda || 'Tienda registrada';
                // Abrir modal de confirmación de tienda
                document.getElementById('modalConfirmacionTienda').classList.add('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.mensaje || response.message || 'No se pudo registrar la tienda',
                    background: '#1a1f2e',
                    color: 'white',
                    customClass: { container: 'swal-high-zindex' }
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error('Error:', status, error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error de conexión. Intenta nuevamente.',
                background: '#1a1f2e',
                color: 'white',
                customClass: { container: 'swal-high-zindex' }
            });
        }
    });
});


function cerrarModalEditar() { 
    document.getElementById('modalEditar').classList.remove('show');
    // Ocultar documentos al cerrar y resetear inputs
    var editRutActual = document.getElementById('edit_rut_actual');
    var editRutInput = document.getElementById('edit_rut_input');
    var editCamaraActual = document.getElementById('edit_camara_actual');
    var editCamaraInput = document.getElementById('edit_camara_input');
    var editCedulaActual = document.getElementById('edit_cedula_actual');
    var editCedulaInput = document.getElementById('edit_cedula_input');
    
    if (editRutActual) editRutActual.style.display = 'none';
    if (editRutInput) editRutInput.style.display = 'none';
    if (editCamaraActual) editCamaraActual.style.display = 'none';
    if (editCamaraInput) editCamaraInput.style.display = 'none';
    if (editCedulaActual) editCedulaActual.style.display = 'none';
    if (editCedulaInput) editCedulaInput.style.display = 'none';
}

// Función para guardar cambios en entidad crediticia
function guardarEntidadEditada(codParametrizacion) {
    var interes = $('#edit_interes_' + codParametrizacion).val();
    var portal = $('#edit_portal_' + codParametrizacion).is(':checked') ? '1' : '0';
    var estado = $('#edit_estado_entidad_' + codParametrizacion).val();
    var url = $('#edit_url_' + codParametrizacion).val();
    
    Swal.fire({
        title: 'Guardando...',
        didOpen: () => { Swal.showLoading() },
        allowOutsideClick: false,
        background: '#1a1f2e',
        color: 'white',
        customClass: { container: 'swal-high-zindex' }
    });
    
    $.ajax({
        url: '../admin/actualizar_entidad_aliado_ajax.php',
        type: 'POST',
        data: {
            cod_parametrizacion: codParametrizacion,
            interes_ptj: interes,
            cod_estado_entrar_portal: portal,
            cod_estado: estado,
            url_pagina_web_consulta: url
        },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({ 
                    icon: 'success', 
                    title: '¡Actualizado!', 
                    text: 'Entidad actualizada correctamente', 
                    background: '#1a1f2e', 
                    color: 'white', 
                    timer: 2000,
                    timerProgressBar: true,
                    customClass: { container: 'swal-high-zindex' }
                });
            } else {
                Swal.fire({ 
                    icon: 'error', 
                    title: 'Error', 
                    text: response.mensaje || 'No se pudo actualizar la entidad', 
                    background: '#1a1f2e', 
                    color: 'white',
                    customClass: { container: 'swal-high-zindex' }
                });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'Error de conexión. Intenta nuevamente.', 
                background: '#1a1f2e', 
                color: 'white',
                customClass: { container: 'swal-high-zindex' }
            });
        }
    });
}

// Función para eliminar parametrización de entidad crediticia
function eliminarEntidadAliado(cod_entidad_crediticia) {
    var btnEliminar = $('#btn_eliminar_' + cod_entidad_crediticia);
    var cod_parametrizacion = btnEliminar.attr('data-cod-parametrizacion');
    var nombre_entidad = btnEliminar.attr('data-nombre-entidad');
    
    if (!cod_parametrizacion) {
        Swal.fire({
            icon: 'warning',
            title: 'Aviso',
            text: 'No se puede eliminar. La parametrización no ha sido guardada aún.',
            background: '#1a1f2e',
            color: 'white'
        });
        return;
    }
    
    Swal.fire({
        title: '¿Eliminar parametrización?',
        html: '<div style="text-align: left; padding: 1rem;"><p style="margin-bottom: 0.5rem;">Se eliminará la parametrización de:</p><strong style="color: #10b981;">' + nombre_entidad + '</strong><p style="margin-top: 0.5rem; color: #ef4444; font-size: 0.85rem;">Esta acción no se puede deshacer.</p></div>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fa-solid fa-trash"></i> Sí, eliminar',
        cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        background: '#1a1f2e',
        color: 'white',
        backdrop: 'rgba(0,0,0,0.8)',
        customClass: {
            container: 'swal-high-zindex'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar loading
            Swal.fire({
                title: 'Eliminando...',
                didOpen: () => { Swal.showLoading() },
                allowOutsideClick: false,
                background: '#1a1f2e',
                color: 'white'
            });
            
            // Realizar la petición AJAX
            $.ajax({
                url: '../admin/eliminar_entidad_aliado_ajax.php',
                type: 'POST',
                data: {
                    cod_parametrizacion_entidad_crediticia_aliado: cod_parametrizacion
                },
                dataType: 'json',
                success: function(response) {
                    Swal.close();
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: 'La parametrización ha sido eliminada correctamente',
                            confirmButtonColor: '#10b981',
                            background: '#1a1f2e',
                            color: 'white',
                            timer: 2000,
                            timerProgressBar: true
                        }).then(() => {
                            // Recargar las entidades en el modal de edición
                            var codAdmin = $('#edit_cod_administrador').val();
                            recargarEntidadesEditar(codAdmin);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.mensaje || 'No se pudo eliminar la parametrización',
                            background: '#1a1f2e',
                            color: 'white'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error de conexión. Intenta nuevamente.',
                        background: '#1a1f2e',
                        color: 'white'
                    });
                }
            });
        }
    });
}

// Funciones para manejar campos de contraseña - DESHABILITADAS (ahora se usa solo recuperación por correo)
/*
function togglePasswordFields() {
    var checkbox = document.getElementById('cambiar_password');
    var fields = document.getElementById('password_fields');
    var nuevaPassword = document.getElementById('edit_nueva_password');
    var confirmarPassword = document.getElementById('edit_confirmar_password');
    var hiddenField = document.getElementById('hidden_cambiar_password');
    
    if (checkbox.checked) {
        fields.style.display = 'block';
        nuevaPassword.setAttribute('required', 'required');
        confirmarPassword.setAttribute('required', 'required');
        hiddenField.value = 'on';
    } else {
        fields.style.display = 'none';
        nuevaPassword.removeAttribute('required');
        confirmarPassword.removeAttribute('required');
        nuevaPassword.value = '';
        confirmarPassword.value = '';
        hiddenField.value = '';
    }
}

function togglePassword(inputId) {
    var input = document.getElementById(inputId);
    var icon = document.getElementById('toggle_' + inputId.replace('edit_', ''));
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fa-solid fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fa-solid fa-eye';
    }
}
*/

// Función para habilitar el campo de cambio de usuario - DESHABILITADA
/*
function habilitarCambioUsuario() {
    var campoNuevo = document.getElementById('campo_nuevo_usuario');
    var inputNuevo = document.getElementById('edit_nuevo_usuario');
    
    if (campoNuevo.style.display === 'none') {
        campoNuevo.style.display = 'block';
        inputNuevo.focus();
    } else {
        campoNuevo.style.display = 'none';
        inputNuevo.value = '';
    }
}
*/

// Función para copiar enlace al portapapeles
function copiarEnlace(enlace) {
    navigator.clipboard.writeText(enlace).then(function() {
        Swal.fire({
            icon: 'success',
            title: '¡Copiado!',
            text: 'El enlace ha sido copiado al portapapeles',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            background: '#1a1f2e',
            color: 'white'
        });
    }).catch(function() {
        // Fallback para navegadores antiguos
        var textArea = document.createElement("textarea");
        textArea.value = enlace;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        Swal.fire({
            icon: 'success',
            title: '¡Copiado!',
            text: 'El enlace ha sido copiado al portapapeles',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            background: '#1a1f2e',
            color: 'white'
        });
    });
}

// Función para enviar recuperación de contraseña por correo
function enviarRecuperacionPassword() {
    var codAdministrador = document.getElementById('edit_cod_administrador').value;
    var correo = document.getElementById('edit_correo').value;
    var nombreAliado = document.getElementById('edit_nombres_apellidos_tercero').value;
    
    if (!codAdministrador || !correo) {
        Swal.fire({
            icon: 'warning',
            title: 'Datos incompletos',
            text: 'No se puede enviar la recuperación sin correo electrónico',
            background: '#1a1f2e',
            color: 'white',
            customClass: { container: 'swal-high-zindex' }
        });
        return;
    }
    
    Swal.fire({
        title: '¿Enviar nueva contraseña?',
        html: '<div style="text-align: left; padding: 1rem;"><p style="margin-bottom: 0.5rem;">Se generará una nueva contraseña temporal para:</p><strong style="color: #10b981;">' + nombreAliado + '</strong><p style="margin-top: 0.5rem;">Se enviará al correo: <strong style="color: #f59e0b;">' + correo + '</strong></p><p style="margin-top: 0.5rem; color: #ef4444; font-size: 0.85rem;">La contraseña actual quedará inhabilitada.</p></div>',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#f59e0b',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fa-solid fa-envelope"></i> Sí, enviar',
        cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        background: '#1a1f2e',
        color: 'white',
        backdrop: 'rgba(0,0,0,0.8)',
        customClass: { container: 'swal-high-zindex' }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Generando y enviando...',
                html: '<i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #f59e0b;"></i><p style="margin-top: 1rem;">Por favor espere...</p>',
                showConfirmButton: false,
                allowOutsideClick: false,
                background: '#1a1f2e',
                color: 'white',
                customClass: { container: 'swal-high-zindex' }
            });
            
            $.ajax({
                url: '../admin/enviar_correo_recuperar_password_aliado_email_ajax.php',
                type: 'POST',
                data: {
                    cod_administrador: codAdministrador,
                    correo: correo,
                    nombre_aliado: nombreAliado
                },
                dataType: 'json',
                success: function(response) {
                    Swal.close();
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Enviado!',
                            html: '<p>' + response.mensaje + '</p><p style="margin-top: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.7);">Nueva contraseña temporal: <strong style="color: #10b981;">' + response.password_temporal + '</strong></p>',
                            confirmButtonColor: '#10b981',
                            background: '#1a1f2e',
                            color: 'white',
                            customClass: { container: 'swal-high-zindex' }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.mensaje || 'No se pudo enviar la contraseña',
                            background: '#1a1f2e',
                            color: 'white',
                            customClass: { container: 'swal-high-zindex' }
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
                        customClass: { container: 'swal-high-zindex' }
                    });
                }
            });
        }
    });
}

function abrirModalDetalle(data, tiendas) {
    document.getElementById('detNombre').textContent = !data.nombres_apellidos_tercero ? (data.nombres + ' ' + data.apellidos) : data.nombres_apellidos_tercero;
    document.getElementById('detCedula').textContent = data.cedula;
    document.getElementById('detTelefono').textContent = data.telefono || 'No registrado';
    document.getElementById('detCorreo').textContent = data.correo || 'No registrado';
    document.getElementById('detDireccion').textContent = data.direccion || 'No registrada';
    document.getElementById('detCuenta').textContent = data.cuenta || 'No asignada';
    document.getElementById('detComision').textContent = (data.comision_ptj || '0') + '%';
    document.getElementById('detTiendas').textContent = tiendas;
    
    var badge = document.getElementById('detEstado');
    if(data.cod_estado_activacion_usuario == '1') {
        badge.textContent = 'ACTIVO';
        badge.style.background = 'rgba(16, 185, 129, 0.2)';
        badge.style.color = '#10b981';
    } else if(data.cod_estado_activacion_usuario == '2') {
        badge.textContent = 'EN ESPERA';
        badge.style.background = 'rgba(245, 158, 11, 0.2)';
        badge.style.color = '#f59e0b';
    } else {
        badge.textContent = 'INACTIVO';
        badge.style.background = 'rgba(239, 68, 68, 0.2)';
        badge.style.color = '#ef4444';
    }
    
    document.getElementById('modalDetalle').classList.add('show');
}
function cerrarModalDetalle() { document.getElementById('modalDetalle').classList.remove('show'); }

// ===== FUNCIONES PARA MODAL DE CONFIRMACIÓN Y DOCUMENTACIÓN =====
function cerrarModalConfirmacionRegistro() {
    document.getElementById('modalConfirmacionRegistro').classList.remove('show');
    location.reload(); // Recargar la página al finalizar
}

function abrirDocumentacionDesdeConfirmacion() {
    var codAliadoCryp = document.getElementById('confirm_cod_aliado_cryp').value;
    var nombreAliado = document.getElementById('confirm_nombre_aliado').value;
    var telefono = document.getElementById('confirm_telefono_aliado').value;
    
    // Abrir modal de documentación
    document.getElementById('doc_cod_aliado_cryp').value = codAliadoCryp;
    document.getElementById('doc_nombre_aliado').textContent = nombreAliado;
    document.getElementById('doc_telefono_aliado').value = telefono;
    
    // Cerrar modal de confirmación y abrir el de documentación
    document.getElementById('modalConfirmacionRegistro').classList.remove('show');
    document.getElementById('modalDocumentacionAliado').classList.add('show');
}

function abrirRegistroTiendaDesdeConfirmacion() {
    var codAliado = document.getElementById('confirm_cod_aliado').value;
    var nombreAliado = document.getElementById('confirm_nombre_aliado').value;
    
    // Guardar el cod_aliado para usarlo después
    currentCodAdministradorTienda = codAliado;
    
    // Cerrar modal de confirmación
    document.getElementById('modalConfirmacionRegistro').classList.remove('show');
    
    // Cargar datos del aliado en el formulario de tienda
    document.getElementById('agregar_tienda_cod_aliado').value = codAliado;
    
    // Cargar departamentos
    cargarDepartamentosModalAgregar();
    
    // Abrir modal de agregar tienda
    document.getElementById('modalAgregarTienda').classList.add('show');
}

function registrarOtroAliado() {
    // Cerrar modal de confirmación
    document.getElementById('modalConfirmacionRegistro').classList.remove('show');
    // Limpiar formulario de registro
    document.getElementById('formRegistro').reset();
    identificacionValida = false;
    var btnGuardar = document.getElementById('btnGuardar');
    if (btnGuardar) { btnGuardar.disabled = false; btnGuardar.style.opacity = '1'; btnGuardar.style.cursor = 'pointer'; }
    var mensajeId = document.getElementById('mensaje_identificacion');
    if (mensajeId) { mensajeId.style.display = 'none'; }
    // Abrir modal de registro
    document.getElementById('modalRegistro').classList.add('show');
}

function cerrarModalConfirmacionTienda() {
    document.getElementById('modalConfirmacionTienda').classList.remove('show');
    location.reload();
}

function registrarOtraTienda() {
    var codAliado = document.getElementById('confirm_tienda_cod_aliado').value;
    // Cerrar modal de confirmación de tienda
    document.getElementById('modalConfirmacionTienda').classList.remove('show');
    // Limpiar formulario de tienda
    document.getElementById('formAgregarTienda').reset();
    // Re-asignar el aliado
    document.getElementById('agregar_tienda_cod_aliado').value = codAliado;
    // Recargar departamentos
    cargarDepartamentosModalAgregar();
    // Abrir modal de agregar tienda
    document.getElementById('modalAgregarTienda').classList.add('show');
}

function irATiendaRegistrada() {
    var codTienda = document.getElementById('confirm_tienda_cod').value;
    if (codTienda) {
        window.location.href = 'lista_tienda_asesor_movil.php?cod_tienda=' + codTienda;
    } else {
        window.location.href = 'lista_tienda_asesor_movil.php';
    }
}

function irARegistroVendedoresDesdeConfirmacion() {
    var codTienda = document.getElementById('confirm_cod_tienda_actual').value;
    if (codTienda) {
        window.location.href = 'lista_tienda_asesor_movil.php?cod_tienda=' + codTienda + '&accion=registro_vendedores';
    } else {
        window.location.href = 'lista_tienda_asesor_movil.php';
    }
}

function cerrarModalDocumentacionAliado() {
    document.getElementById('modalDocumentacionAliado').classList.remove('show');
    // Cerrar también el modal de confirmación y recargar
    document.getElementById('modalConfirmacionRegistro').classList.remove('show');
    location.reload();
}

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
    
    if (!codAliadoCryp) { 
        Swal.fire({ 
            icon: 'error', 
            title: 'Error', 
            text: 'No se encontró el código del aliado', 
            background: '#1a1f2e', 
            color: 'white',
            customClass: { container: 'swal-high-zindex' }
        });
        return; 
    }
    
    var enlace = getEnlaceDocumentacion();
    var mensaje = '¡Hola ' + nombreAliado + '! Por favor sube tu documentación legal (RUT y Cámara de Comercio) en el siguiente enlace: ' + enlace;
    var urlWhatsApp = 'https://wa.me/' + (telefono ? '57' + telefono : '') + '?text=' + encodeURIComponent(mensaje);
    
    window.open(urlWhatsApp, '_blank');
}

function compartirDocEmail() {
    var nombreAliado = document.getElementById('doc_nombre_aliado').textContent;
    var enlace = getEnlaceDocumentacion();
    
    var asunto = encodeURIComponent('Cargue de Documentación Legal - ' + nombreAliado);
    var cuerpo = encodeURIComponent('Hola ' + nombreAliado + ',\n\nPor favor sube tu documentación legal (RUT y Cámara de Comercio) en el siguiente enlace:\n\n' + enlace + '\n\nGracias.');
    
    window.open('mailto:?subject=' + asunto + '&body=' + cuerpo, '_blank');
}

function copiarEnlaceDoc() {
    var enlace = getEnlaceDocumentacion();
    
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(enlace).then(function() {
            Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'El enlace ha sido copiado al portapapeles', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }).catch(function() {
            copiarEnlaceDocFallback(enlace);
        });
    } else {
        copiarEnlaceDocFallback(enlace);
    }
}

function copiarEnlaceDocFallback(enlace) {
    var textArea = document.createElement('textarea');
    textArea.value = enlace;
    textArea.style.position = 'fixed';
    textArea.style.opacity = '0';
    document.body.appendChild(textArea);
    textArea.select();
    
    try {
        document.execCommand('copy');
        Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'El enlace ha sido copiado al portapapeles', timer: 2000,  showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    } catch (err) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo copiar el enlace. Por favor cópialo manualmente: ' + enlace, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    }
    document.body.removeChild(textArea);
}
// ============================================
// FUNCIONES PARA FIRMA DIGITAL
// ============================================

function generarDocumentoFirma() {
    var codAliadoCryp = document.getElementById('doc_cod_aliado_cryp').value;
    var nombreAliado = document.getElementById('doc_nombre_aliado').textContent;
    var telefono = document.getElementById('doc_telefono_aliado').value;
    
    if (!codAliadoCryp) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se encontró el código del aliado', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    // Mostrar loading
    Swal.fire({ title: 'Generando documento...', html: 'Por favor espere mientras se genera el documento para firma digital.', background: '#1a1f2e', color: 'white', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }, customClass: { container: 'swal-high-zindex' } });
    // Llamar al PHP para generar el registro
    $.ajax({
        url: '../ajax/generar_firma_digital.php', type: 'POST', data: { cod_aliado_estrategico: codAliadoCryp }, dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (response.error) {
                Swal.fire({ icon: 'error', title: 'Error', text: response.error, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                return;
            }
            
            if (response.success) {
                // Guardar datos en el modal de firma
                document.getElementById('firma_cod_aliado_cryp').value = codAliadoCryp;
                document.getElementById('firma_nombre_aliado').textContent = nombreAliado;
                document.getElementById('firma_telefono_aliado').value = telefono;
                document.getElementById('firma_token').value = response.token;
                document.getElementById('firma_url').value = response.url;
                
                // Cerrar modal de documentación y abrir modal de firma
                document.getElementById('modalDocumentacionAliado').classList.remove('show');
                document.getElementById('modalFirmaDigital').classList.add('show');
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error al generar el documento: ' + error, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
}

function cerrarModalFirmaDigital() {
    document.getElementById('modalFirmaDigital').classList.remove('show');
    // Volver a abrir el modal de documentación o recargar
    location.reload();
}

function compartirFirmaWhatsApp() {
    var nombreAliado = document.getElementById('firma_nombre_aliado').textContent;
    var telefono = document.getElementById('firma_telefono_aliado').value.replace(/\D/g, '');
    var enlace = document.getElementById('firma_url').value;
    
    if (!enlace) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se encontró el enlace del documento', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    var mensaje = '¡Hola ' + nombreAliado + '! Por favor firma el siguiente documento digital: ' + enlace;
    var urlWhatsApp = 'https://wa.me/' + (telefono ? '57' + telefono : '') + '?text=' + encodeURIComponent(mensaje);
    
    window.open(urlWhatsApp, '_blank');
}

function compartirFirmaEmail() {
    var nombreAliado = document.getElementById('firma_nombre_aliado').textContent;
    var enlace = document.getElementById('firma_url').value;
    
    if (!enlace) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se encontró el enlace del documento', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    var asunto = encodeURIComponent('Documento para Firma Digital - ' + nombreAliado);
    var cuerpo = encodeURIComponent('Hola ' + nombreAliado + ',\n\nPor favor firma el siguiente documento digital:\n\n' + enlace + '\n\nGracias.');
    
    window.open('mailto:?subject=' + asunto + '&body=' + cuerpo, '_blank');
}

function copiarEnlaceFirma() {
    var enlace = document.getElementById('firma_url').value;
    
    if (!enlace) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se encontró el enlace del documento', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(enlace).then(function() {
            Swal.fire({
                icon: 'success', title: '¡Copiado!', text: 'El enlace ha sido copiado al portapapeles', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }).catch(function() {
            copiarEnlaceFirmaFallback(enlace);
        });
    } else {
        copiarEnlaceFirmaFallback(enlace);
    }
}

function copiarEnlaceFirmaFallback(enlace) {
    var textArea = document.createElement('textarea');
    textArea.value = enlace;
    textArea.style.position = 'fixed';
    textArea.style.opacity = '0';
    document.body.appendChild(textArea);
    textArea.select();
    
    try {
        document.execCommand('copy');
        Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'El enlace ha sido copiado al portapapeles', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    } catch (err) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo copiar el enlace. Por favor cópialo manualmente: ' + enlace, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    }
    document.body.removeChild(textArea);
}
// Cerrar modales al hacer clic fuera
document.getElementById('modalConfirmacionRegistro').addEventListener('click', function(e) { if (e.target === this) { cerrarModalConfirmacionRegistro(); } });
document.getElementById('modalDocumentacionAliado').addEventListener('click', function(e) { if (e.target === this) { cerrarModalDocumentacionAliado(); } });
document.getElementById('modalFirmaDigital').addEventListener('click', function(e) { if (e.target === this) { cerrarModalFirmaDigital(); } });
// ===== FIN FUNCIONES PARA MODAL DE CONFIRMACIÓN Y DOCUMENTACIÓN =====
// Funciones para agregar nueva entidad
var codAdministradorActual = null;

function abrirModalAgregarEntidad() {
    codAdministradorActual = document.getElementById('edit_cod_administrador').value;
    document.getElementById('agregar_cod_administrador').value = codAdministradorActual;
    
    // Cargar entidades disponibles
    $('#agregar_cod_entidad').html('<option value="">Cargando...</option>');
    
    $.ajax({
        url: '../admin/obtener_entidades_disponibles_ajax.php', type: 'POST', data: { cod_administrador: codAdministradorActual }, dataType: 'json',
        success: function(response) {
            if (response.success && response.entidades && response.entidades.length > 0) {
                var options = '<option value="">Seleccione una entidad</option>';
                response.entidades.forEach(function(entidad) {
                    var interesDefault = entidad.aliado_estrategico_interes_ptj || '0.00';
                    options += '<option value="' + entidad.cod_entidad_crediticia + '" data-url="' + escapeHtmlMovil(entidad.url_pagina_web_consulta || '') + '" data-interes-default="' + interesDefault + '">' + escapeHtmlMovil(entidad.nombre_entidad_crediticia) + '</option>';
                });
                $('#agregar_cod_entidad').html(options);
            } else {
                $('#agregar_cod_entidad').html('<option value="">No hay entidades disponibles</option>');
                Swal.fire({ icon: 'info', title: 'Sin entidades disponibles', text: 'Todas las entidades ya han sido asignadas a este aliado', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function() {
            $('#agregar_cod_entidad').html('<option value="">Error al cargar</option>');
            Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudieron cargar las entidades disponibles', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
    // Limpiar formulario
    $('#formAgregarEntidad')[0].reset();
    document.getElementById('agregar_cod_administrador').value = codAdministradorActual;
    document.getElementById('modalAgregarEntidad').classList.add('show');
}
function cerrarModalAgregarEntidad() {
    document.getElementById('modalAgregarEntidad').classList.remove('show');
    $('#formAgregarEntidad')[0].reset();
}

// Abrir modal agregar banco
function abrirModalAgregarBanco(codAliadoEstrategico) {
    // Usar el código del aliado que se pasa como parámetro
    if (!codAliadoEstrategico) { 
        Swal.fire({ 
            icon: 'error', title: 'Error',  text: 'No se pudo identificar el aliado estratégico',  background: '#1a1f2e', color: 'white' 
        }); return; 
    }
    // Cargar bancos disponibles si no se han cargado
    $.ajax({
        url: '../admin/obtener_bancos_disponibles_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            if (response.success) {
                var options = '<option value="">Seleccione un banco</option>';
                response.bancos.forEach(function(banco) { options += '<option value="' + banco.cod_banco + '">' + banco.nombre_banco + '</option>'; });
                $('#agregar_banco').html(options);
            }
        }
    });
    
    // Asignar el código del aliado estratégico a los campos del formulario
    document.getElementById('agregar_banco_cod_administrador').value = codAliadoEstrategico;
    document.getElementById('agregar_banco_cod_aliado_estrategico').value = codAliadoEstrategico;
    //console.log('Modal Agregar Banco - Código Aliado:', codAliadoEstrategico);
    document.getElementById('modalAgregarBanco').classList.add('show');
}

function cerrarModalAgregarBanco() {
    document.getElementById('modalAgregarBanco').classList.remove('show');
    $('#formAgregarBanco')[0].reset();
}

// Función para mostrar nombre de archivo seleccionado
function mostrarNombreArchivoCertificado(input, previewId) {
    var preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        var fileName = input.files[0].name;
        var fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
        preview.innerHTML = '<i class="fa-solid fa-file-check" style="font-size: 2rem; color: #10b981; margin-bottom: 0.5rem;"></i>' +
            '<p style="margin: 0; color: #10b981; font-size: 0.85rem; font-weight: 600;">' + fileName + '</p>' +
            '<p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.7rem;">' + fileSize + ' MB</p>';
    } else {
        preview.innerHTML = '<i class="fa-solid fa-cloud-upload-alt" style="font-size: 2rem; color: rgba(16, 185, 129, 0.6); margin-bottom: 0.5rem;"></i>' +
            '<p style="margin: 0; color: rgba(255,255,255,0.7); font-size: 0.85rem;">Clic para seleccionar archivo</p>' +
            '<p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.7rem;">Imagen o documento (JPG, PNG, PDF, DOC)</p>';
    }
}

// Guardar nueva cuenta bancaria
$('#formAgregarBanco').on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    Swal.fire({ title: 'Guardando...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/agregar_banco_aliado_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                cerrarModalAgregarBanco();
                Swal.fire({ icon: 'success', title: 'Éxito', text: response.mensaje, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                // Recargar lista de bancos del aliado
                cargarBancosAliado(codAdministradorActual);
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error al procesar la solicitud', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});

// Auto-rellenar URL al seleccionar entidad
$(document).on('change', '#agregar_cod_entidad', function() {
    var selectedOption = $(this).find('option:selected');
    var url = selectedOption.attr('data-url');
    var interesDefault = selectedOption.attr('data-interes-default');
    
    if (url && url !== '') { $('#agregar_url').val(url); }
    // Auto-rellenar el campo de interés con el valor por defecto
    if (interesDefault && interesDefault !== '') { $('#agregar_interes').val(interesDefault); }
});

// Guardar nueva entidad
$('#formAgregarEntidad').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    Swal.fire({ title: 'Guardando...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/agregar_entidad_aliado_ajax.php', type: 'POST', data: data, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                cerrarModalAgregarEntidad();
                Swal.fire({
                    icon: 'success', title: '¡Éxito!', text: 'Entidad agregada correctamente', confirmButtonColor: '#10b981', background: '#1a1f2e',
                    color: 'white', timer: 2000, timerProgressBar: true, customClass: { container: 'swal-high-zindex' }
                }).then(() => {
                    // Recargar las entidades en el modal de edición
                    var codAdmin = $('#edit_cod_administrador').val();
                    recargarEntidadesEditar(codAdmin);
                });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje || 'No se pudo agregar la entidad', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión. Intenta nuevamente.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});

// Función para recargar entidades en el modal de edición
function recargarEntidadesEditar(codAdministrador) {
    $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Cargando entidades...</p></div>');
    
    $.ajax({
        url: '../admin/obtener_entidades_aliado_ajax.php', type: 'POST', data: { cod_administrador: codAdministrador }, dataType: 'json',
        success: function(response) {
            if (response.success && response.entidades && response.entidades.length > 0) {
                var html = '';
                response.entidades.forEach(function(entidad) {
                    var checked = 'checked';
                    var interes = entidad.interes_ptj || '';
                    var portal_checked = entidad.cod_estado_entrar_portal == '1' ? 'checked' : '';
                    var url = entidad.url_pagina_web_consulta || '';
                    
                    html += '<div style="display: grid; grid-template-columns: auto 1fr auto auto auto; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem; padding: 0.6rem 0.75rem; background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.15); border-radius: 10px;">';
                    html += '<input type="checkbox" name="entidades[]" value="' + entidad.cod_entidad_crediticia + '" id="edit_ent_' + entidad.cod_entidad_crediticia + '" ' + checked + ' style="accent-color: #10b981; width: 18px; height: 18px; cursor: pointer; margin: 0;">';
                    html += '<label for="edit_ent_' + entidad.cod_entidad_crediticia + '" style="color: rgba(255,255,255,0.95); font-size: 0.9rem; font-weight: 600; cursor: pointer; margin: 0;">' + escapeHtmlMovil(entidad.nombre_entidad_crediticia) + '</label>';
                    html += '<div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">';
                    html += '<label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">% Adtvo:</label>';
                    html += '<input type="number" step="0.01" min="0" max="100" class="form-input" name="interes_' + entidad.cod_entidad_crediticia + '" id="edit_interes_' + entidad.cod_entidad_crediticia + '" value="' + interes + '" placeholder="0.00" style="width: 70px; padding: 0.3rem 0.4rem; font-size: 0.8rem; text-align: center;">';
                    html += '</div>';
                    html += '<div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">';
                    html += '<label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">Portal:</label>';
                    html += '<input type="checkbox" name="cod_estado_entrar_portal_' + entidad.cod_entidad_crediticia + '" id="edit_cod_estado_entrar_portal_' + entidad.cod_entidad_crediticia + '" value="1" ' + portal_checked + ' style="accent-color: #10b981; width: 16px; height: 16px; cursor: pointer; margin: 0;" title="Acceso al portal">';
                    html += '</div>';
                    html += '<button type="button" id="btn_eliminar_' + entidad.cod_entidad_crediticia + '" data-cod-parametrizacion="' + entidad.cod_parametrizacion_entidad_crediticia_aliado + '" data-nombre-entidad="' + escapeHtmlMovil(entidad.nombre_entidad_crediticia) + '" onclick="eliminarEntidadAliado(' + entidad.cod_entidad_crediticia + ')" style="background: #ef4444; color: white; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; display: flex; align-items: center; gap: 0.25rem;" title="Eliminar parametrización">';
                    html += '<i class="fa-solid fa-trash"></i>';
                    html += '</button>';
                    html += '</div>';
                });
                $('#contenedor_entidades_editar').html(html);
            } else {
                $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-info-circle" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: rgba(16, 185, 129, 0.4);"></i><p style="margin: 0; font-size: 0.85rem;">No hay entidades asignadas a este aliado.</p></div>');
            }
        },
        error: function(xhr, status, error) {
            $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(239, 68, 68, 0.8);"><i class="fa-solid fa-exclamation-triangle" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Error al cargar entidades.</p></div>');
        }
    });
}

function filtrar() { 
    var busqueda = document.getElementById('searchInput').value;
    var filtro_doc = document.getElementById('filtroDoc').value;
    clearTimeout(window.searchTimeout); 
    window.searchTimeout = setTimeout(function() { 
        window.location.href = 'lista_aliado_asesor_movil.php?busqueda=' + encodeURIComponent(busqueda) + '&filtro_doc=' + encodeURIComponent(filtro_doc); 
    }, 500); 
}

// Guardar Aliado (Nuevo)
$('#formRegistro').on('submit', function(e) {
    e.preventDefault();
    var formObj = this;

    // Verificar si la identificación es válida
    var identificacion = $('#identificacion_tercero').val().trim();
    if(identificacion === '') {
        Swal.fire({ icon: 'warning', title: 'Campo requerido', text: 'Debe ingresar una identificación', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return false;
    }
    
    // Verificar identificación primero
    Swal.fire({ title: 'Verificando y Guardando...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/verificar_identificacion_aliado.php', type: 'POST', data: { identificacion: identificacion }, dataType: 'json',
        success: function(response) {
            if(response.existe) {
                Swal.close();
                Swal.fire({ icon: 'error', title: 'Identificación duplicada', text: 'Esta identificación ya está registrada en el sistema', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                $('#identificacion_tercero').css('border-color', '#ef4444');
                $('#mensaje_identificacion').text('⚠️ Esta identificación ya está registrada').show();
            } else {
                $('#identificacion_tercero').css('border-color', '#10b981');
                $('#mensaje_identificacion').hide();
                
                // Proceder con el guardado
                var formData = new FormData(formObj);
                $.ajax({
                    url: '../admin/reg_aliado_modal_asesor_ajax_reg.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
                    success: function(resp) {
                        Swal.close();
                        
                        if(resp.afectado === 'SI' || resp.afectado === 'EXISTE') {
                            cerrarModal();
                            // Guardar datos en el modal de confirmación
                            document.getElementById('confirm_cod_aliado').value = resp.cod_administrador || '';
                            document.getElementById('confirm_cod_aliado_cryp').value = resp.cod_aliado_cryp || '';
                            document.getElementById('confirm_nombre_aliado').value = resp.nombre_completo || '';
                            document.getElementById('confirm_telefono_aliado').value = resp.telefono || '';
                            document.getElementById('confirm_nombre_display').textContent = resp.nombre_completo || '';
                            
                            // Cambiar título si ya existe
                            if(resp.afectado === 'EXISTE') {
                                $('#modalConfirmacionRegistro h2').html('<i class="fa-solid fa-circle-exclamation"></i> Aliado ya registrado');
                                $('#modalConfirmacionRegistro p').first().text('Este aliado ya se encontraba en el sistema.');
                                $('#modalConfirmacionRegistro .modal-header').css('background', 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)');
                            } else {
                                $('#modalConfirmacionRegistro h2').html('<i class="fa-solid fa-circle-check"></i> ¡Aliado Registrado!');
                                $('#modalConfirmacionRegistro p').first().text('El aliado ha sido registrado exitosamente.');
                                $('#modalConfirmacionRegistro .modal-header').css('background', 'linear-gradient(135deg, #10b981 0%, #059669 100%)');
                            }

                            // Manejar sección de tienda (nueva o existente)
                            if(resp.tienda_creada || resp.tienda_ya_existia) {
                                document.getElementById('section_confirm_tienda').style.display = 'block';
                                document.getElementById('confirm_cod_tienda_actual').value = resp.cod_tienda;
                                
                                if(resp.tienda_ya_existia) {
                                    $('#section_confirm_tienda h4').text('Tienda ya registrada');
                                    $('#section_confirm_tienda p').text('Este aliado ya tiene un establecimiento asociado.');
                                    $('#section_confirm_tienda').css('background', 'rgba(59, 130, 246, 0.1)').css('border-color', 'rgba(59, 130, 246, 0.3)');
                                    $('#section_confirm_tienda i.fa-store').css('color', '#3b82f6');
                                    $('#section_confirm_tienda button').css('background', '#3b82f6');
                                } else {
                                    $('#section_confirm_tienda h4').text('Tienda también registrada');
                                    $('#section_confirm_tienda p').text('Se ha creado el establecimiento para el aliado.');
                                    $('#section_confirm_tienda').css('background', 'rgba(16, 185, 129, 0.1)').css('border-color', 'rgba(16, 185, 129, 0.3)');
                                    $('#section_confirm_tienda i.fa-store').css('color', '#10b981');
                                    $('#section_confirm_tienda button').css('background', '#10b981');
                                }
                            } else {
                                document.getElementById('section_confirm_tienda').style.display = 'none';
                            }
                            // Abrir modal de confirmación
                            document.getElementById('modalConfirmacionRegistro').classList.add('show');
                        } else {
                            var errorMsg = resp.mensaje || 'Error al registrar el aliado';
                            if(resp.error) {
                                errorMsg += '\n\nDetalle: ' + resp.error;
                            }
                            Swal.fire({ icon: 'error', title: 'Error', text: errorMsg, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        console.log('Error AJAX:', xhr.responseText); // Debug
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión. Intenta nuevamente.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                    }
                });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo verificar la identificación. Intente nuevamente.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});
// Guardar Aliado (Editar)
$('#formEditar').on('submit', function(e) {
    e.preventDefault();
    // Usar FormData para soportar archivos
    var formData = new FormData(this);
    Swal.fire({ title: 'Actualizando...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/act_aliado_modal_asesor_ajax_reg.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json', success: function(resp) {
            Swal.close();
            if(resp.afectado === 'SI') {
                cerrarModalEditar(); 
                Swal.fire({ icon: 'success', title: '¡Actualizado!', text: resp.mensaje || 'Datos del aliado actualizados correctamente', confirmButtonColor: '#10b981', background: '#1a1f2e', color: 'white', timer: 2000, timerProgressBar: true, customClass: { container: 'swal-high-zindex' } }).then(() => { location.reload(); });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: resp.mensaje || 'No se pudo actualizar el aliado', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.log('Error AJAX:', xhr.responseText);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión. Intenta nuevamente.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});
// Cerrar modales al hacer clic fuera
$('.modal-overlay').on('click', function(e) { if (e.target === this) { $(this).removeClass('show'); } });
// ====================== SISTEMA DE COMPARTIR DOCUMENTACIÓN ======================
var datosZipActual = null;

function compartirDocumentacion(cod_aliado) {
    // Mostrar modal con loading
    $('#modalCompartirDocs').addClass('show');
    $('#loadingCompartir').show();
    $('#contenidoCompartir').hide();
    $('#formularioEmail').hide();
    $('#enlaceGenerado').hide();
    
    // Resetear datos
    datosZipActual = null;
    $('#email_destino').val('');
    $('#mensaje_email').val('');
    
    // Hacer petición AJAX para generar el ZIP
    $.ajax({
        url: 'generar_zip_documentacion.php', type: 'POST', data: { cod_aliado: cod_aliado }, dataType: 'json', success: function(response) {
            $('#loadingCompartir').hide();
            
            if (response.success) {
                datosZipActual = response;
                mostrarContenidoCompartir(response);
                $('#contenidoCompartir').fadeIn();
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo generar el archivo ZIP', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                cerrarModalCompartirDocs();
            }
        },
        error: function(xhr, status, error) {
            $('#loadingCompartir').hide();
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error al generar el archivo ZIP: ' + error, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            cerrarModalCompartirDocs();
        }
    });
}

function mostrarContenidoCompartir(data) {
    // Mostrar información del aliado
    $('#compartir_aliado_nombre').text(data.aliado_nombre);
    $('#compartir_aliado_cedula').text(data.aliado_cedula);
    
    // Mostrar lista de archivos
    var listaHTML = '';
    if (data.archivos && data.archivos.length > 0) {
        data.archivos.forEach(function(archivo) {
            var tamanoKB = (archivo.tamano / 1024).toFixed(2);
            listaHTML += '<div style="padding: 8px; border-bottom: 1px solid rgba(99, 102, 241, 0.2); display: flex; justify-content: space-between; align-items: center;">';
            listaHTML += '<div><i class="fa-solid fa-file-pdf" style="color: #ef4444; margin-right: 8px;"></i>';
            listaHTML += '<span style="color: white; font-size: 0.85rem;">' + archivo.nombre + '</span></div>';
            listaHTML += '<span style="color: rgba(255,255,255,0.5); font-size: 0.75rem;">' + tamanoKB + ' KB</span>';
            listaHTML += '</div>';
        });
    }
    $('#lista_archivos_zip').html(listaHTML);
}

function cerrarModalCompartirDocs() {
    $('#modalCompartirDocs').removeClass('show');
    datosZipActual = null;
    $('#formularioEmail').hide();
    $('#enlaceGenerado').hide();
}

function mostrarFormularioEmail() {
    $('#formularioEmail').slideDown();
}

function ocultarFormularioEmail() {
    $('#formularioEmail').slideUp();
    $('#email_destino').val('');
    $('#mensaje_email').val('');
}

function enviarEmail() {
    if (!datosZipActual) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No hay un archivo ZIP generado', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    var email = $('#email_destino').val().trim();
    if (email === '' || !validarEmail(email)) {
        Swal.fire({ icon: 'warning', title: 'Email inválido', text: 'Por favor ingrese un email válido', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    var mensaje = $('#mensaje_email').val().trim();
    
    Swal.fire({ title: 'Enviando email...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white',  customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: 'enviar_email_documentacion.php', type: 'POST', data: { zip_path: datosZipActual.zip_path, email_destino: email, mensaje: mensaje, aliado_nombre: datosZipActual.aliado_nombre }, dataType: 'json', timeout: 60000,
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({ icon: 'success', title: '¡Email enviado!', text: response.message, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                ocultarFormularioEmail();
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            var mensajeError = 'Error al enviar el email';
            
            if (status === 'timeout') {
                mensajeError = 'El servidor tardó demasiado en responder. El archivo podría ser muy grande o hay problemas con el servidor SMTP.';
            } else if (xhr.responseText) {
                try {
                    var resp = JSON.parse(xhr.responseText);
                    mensajeError = resp.message || mensajeError;
                } catch(e) {
                    mensajeError = 'Error del servidor: ' + xhr.status;
                }
            }
            Swal.fire({ icon: 'error', title: 'Error', text: mensajeError, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
}

function descargarZip() {
    if (!datosZipActual) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No hay un archivo ZIP generado', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    // Crear un enlace temporal y hacer clic en él para descargar
    var link = document.createElement('a');
    link.href = '../' + datosZipActual.zip_path;
    link.download = datosZipActual.zip_name;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    Swal.fire({ icon: 'success', title: 'Descargando...', text: 'El archivo se está descargando', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
}

function generarEnlace() {
    if (!datosZipActual) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No hay un archivo ZIP generado', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    // Generar enlace completo
    var baseUrl = window.location.origin + window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/'));
    var enlaceCompleto = baseUrl + '/../' + datosZipActual.zip_path;
    
    $('#input_enlace').val(enlaceCompleto);
    $('#enlaceGenerado').slideDown();
}

function copiarEnlace() {
    var input = document.getElementById('input_enlace');
    input.select();
    input.setSelectionRange(0, 99999); // Para móviles
    
    try {
        document.execCommand('copy');
        Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'El enlace se ha copiado al portapapeles', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    } catch (err) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo copiar el enlace', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    }
}

function validarEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
</script>

<!-- ====================== SISTEMA DE NOTIFICACIONES ====================== -->
<style>
.notification-bell-movil {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(16, 185, 129, 0.5);
    z-index: 9999;
    transition: all 0.3s ease;
    border: none;
}

.notification-bell-movil:hover { transform: scale(1.1); box-shadow: 0 6px 30px rgba(16, 185, 129, 0.7); }
.notification-bell-movil i { font-size: 22px; color: white; }
.notification-bell-movil.has-notifications { animation: bellPulseMovil 2s infinite; }

.notification-badge-movil {
    position: absolute;
    top: -5px;
    right: -5px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    font-size: 11px;
    font-weight: 700;
    min-width: 22px;
    height: 22px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 5px;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.5);
}

@keyframes bellPulseMovil { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }
@keyframes bellShakeMovil { 0%, 100% { transform: rotate(0); } 25% { transform: rotate(15deg); } 75% { transform: rotate(-15deg); } }
.notification-bell-movil.shake i { animation: bellShakeMovil 0.5s ease; }

.notification-panel-movil {
    position: fixed;
    bottom: 155px;
    right: 15px;
    width: calc(100% - 30px);
    max-width: 380px;
    max-height: 400px;
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    z-index: 9998;
    display: none;
    overflow: hidden;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.notification-panel-movil.show { display: block; animation: slideUpMovil 0.3s ease; }
@keyframes slideUpMovil { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

.notification-header-movil { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 15px 18px; display: flex; align-items: center; justify-content: space-between; }
.notification-header-movil h4 { margin: 0; font-size: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
.notification-header-actions-movil { display: flex; gap: 8px; }
.notification-header-actions-movil button { background: rgba(255, 255, 255, 0.2); border: none; color: white; padding: 6px 10px; border-radius: 8px; font-size: 11px; cursor: pointer; }
.notification-list-movil { max-height: 320px; overflow-y: auto; }
.notification-item-movil { padding: 14px 18px; border-bottom: 1px solid rgba(16, 185, 129, 0.15); cursor: pointer; transition: background 0.2s ease; display: flex; gap: 12px; align-items: flex-start; }
.notification-item-movil:hover { background: rgba(16, 185, 129, 0.1); }
.notification-item-movil:last-child { border-bottom: none; }
.notification-icon-movil { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 14px; }
.notification-icon-movil.type-1 { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; }
.notification-icon-movil.type-2 { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; }
.notification-icon-movil.type-3 { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; }
.notification-content-movil { flex: 1; min-width: 0; }
.notification-title-movil { font-size: 13px; font-weight: 600; color: white; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.notification-desc-movil { font-size: 12px; color: rgba(255,255,255,0.6); line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.notification-time-movil { font-size: 10px; color: rgba(16, 185, 129, 0.8); margin-top: 5px; }
.notification-empty-movil { padding: 40px 20px; text-align: center; color: rgba(255,255,255,0.5); }
.notification-empty-movil i { font-size: 40px; margin-bottom: 12px; display: block; color: rgba(16, 185, 129, 0.4); }
.notification-empty-movil p { margin: 0; font-size: 14px; }
</style>

<button class="notification-bell-movil" id="notificationBellMovil" onclick="toggleNotificationPanelMovil()">
    <i class="fa-solid fa-bell"></i>
    <span class="notification-badge-movil" id="notificationBadgeMovil" style="display: none;">0</span>
</button>

<div class="notification-panel-movil" id="notificationPanelMovil">
    <div class="notification-header-movil">
        <h4><i class="fa-solid fa-bell"></i> Notificaciones</h4>
        <div class="notification-header-actions-movil">
            <button onclick="marcarTodasLeidasMovil()"><i class="fa-solid fa-check-double"></i> Leer todas</button>
            <button onclick="toggleNotificationPanelMovil()"><i class="fa-solid fa-times"></i></button>
        </div>
    </div>
    <div class="notification-list-movil" id="notificationListMovil">
        <div class="notification-empty-movil">
            <i class="fa-solid fa-bell-slash"></i>
            <p>No hay notificaciones pendientes</p>
        </div>
    </div>
</div>

<script>
var notificationCheckIntervalMovil = null;

$(document).ready(function() {
    cargarNotificacionesMovil();
    notificationCheckIntervalMovil = setInterval(cargarNotificacionesMovil, 30000);
});

function cargarNotificacionesMovil() {
    $.ajax({
        url: '../admin/obtener_notificaciones_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) { if (response.success) actualizarUINotificacionesMovil(response.notificaciones, response.count); }
    });
}

function actualizarUINotificacionesMovil(notificaciones, count) {
    var $badge = $('#notificationBadgeMovil'), $bell = $('#notificationBellMovil'), $list = $('#notificationListMovil');
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
            var iconClass = 'type-' + (notif.tipo || 1), iconSymbol = getNotificationIconMovil(notif.tipo);
            html += '<div class="notification-item-movil" onclick="marcarNotificacionLeidaMovil(' + notif.id + ', this)">';
            html += '<div class="notification-icon-movil ' + iconClass + '"><i class="fa-solid ' + iconSymbol + '"></i></div>';
            html += '<div class="notification-content-movil"><div class="notification-title-movil">' + escapeHtmlMovil(notif.titulo) + '</div>';
            html += '<div class="notification-desc-movil">' + escapeHtmlMovil(notif.descripcion) + '</div>';
            html += '<div class="notification-time-movil"><i class="fa-regular fa-clock"></i> ' + notif.fecha_corta + '</div></div></div>';
        });
        $list.html(html);
    } else {
        $list.html('<div class="notification-empty-movil"><i class="fa-solid fa-bell-slash"></i><p>No hay notificaciones pendientes</p></div>');
    }
}

function getNotificationIconMovil(tipo) {
    switch(parseInt(tipo)) { case 1: return 'fa-signature'; case 2: return 'fa-exclamation-circle'; case 3: return 'fa-info-circle'; default: return 'fa-bell'; }
}

function toggleNotificationPanelMovil() { $('#notificationPanelMovil').toggleClass('show'); }
$(document).on('click', function(e) { if (!$(e.target).closest('#notificationPanelMovil, #notificationBellMovil').length) $('#notificationPanelMovil').removeClass('show'); });
function marcarNotificacionLeidaMovil(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { cod_notificacion: codNotificacion }, dataType: 'json',
        success: function(response) { if (response.success) $(element).fadeOut(300, function() { $(this).remove(); cargarNotificacionesMovil(); }); }
    });
}

function marcarTodasLeidasMovil() {
    Swal.fire({
        title: '¿Marcar todas como leídas?', text: 'Se marcarán todas las notificaciones pendientes como leídas', icon: 'question', showCancelButton: true, confirmButtonColor: '#10b981', cancelButtonColor: '#6c757d', confirmButtonText: 'Sí, marcar todas', cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { marcar_todas: 'si' }, dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarNotificacionesMovil();
                        Swal.fire({ icon: 'success', title: '¡Listo!', text: 'Todas las notificaciones han sido marcadas como leídas', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
                    }
                }
            });
        }
    });
}
// ========== MODALES DE VENDEDORES Y PRODUCTOS (desde confirmación aliado) ==========
window._regVendedoresAliado = [];
window._regProductosAliado = [];

// Botón "Registrar Vendedores" desde confirmación aliado
document.getElementById('btn_registrar_vendedores_tienda_rapida').addEventListener('click', function() {
    var codTienda = document.getElementById('confirm_cod_tienda_actual').value;
    if (!codTienda) {
        Swal.fire({ icon: 'warning', title: 'Sin tienda', text: 'No se encontró una tienda asociada.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    // Ocultar confirmación y abrir modal vendedores
    document.getElementById('modalConfirmacionRegistro').classList.remove('show');
    abrirModalRegVendedorAliado(codTienda);
});

// Botón "Registrar Productos" desde confirmación aliado
document.getElementById('btn_registrar_productos_tienda_rapida').addEventListener('click', function() {
    var codTienda = document.getElementById('confirm_cod_tienda_actual').value;
    if (!codTienda) {
        Swal.fire({ icon: 'warning', title: 'Sin tienda', text: 'No se encontró una tienda asociada.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    // Ocultar confirmación y abrir modal productos
    document.getElementById('modalConfirmacionRegistro').classList.remove('show');
    abrirModalRegProductoAliado(codTienda);
});

// Obtener nombre tienda por AJAX
function obtenerNombreTiendaYAbrir(codTienda, callback) {
    // Intentar obtener nombre de la tienda
    $.ajax({
        url: 'obtener_vendedores_por_tienda_ajax.php', type: 'POST', data: { cod_tienda: codTienda }, dataType: 'json',
        success: function(r) { callback(codTienda); },
        error: function() { callback(codTienda); }
    });
}

// ===== MODAL VENDEDORES =====
function abrirModalRegVendedorAliado(codTienda) {
    document.getElementById('regVendedor_cod_tienda').value = codTienda;
    document.getElementById('regVendedorNombreTienda').textContent = 'Tienda #' + codTienda;
    document.getElementById('formRegVendedorAliado').reset();
    document.getElementById('regVendedor_cod_tienda').value = codTienda;
    window._regVendedoresAliado = [];
    cargarVendedoresTiendaAliado(codTienda);
    document.getElementById('modalRegVendedorAliado').classList.add('show');
}

function cerrarModalRegVendedorAliado() {
    document.getElementById('modalRegVendedorAliado').classList.remove('show');
}

function cargarVendedoresTiendaAliado(codTienda) {
    var container = document.getElementById('listaRegVendedoresAliado');
    var list = document.getElementById('regVendedoresListAliado');
    var counter = document.getElementById('contadorRegVendedoresAliado');
    list.innerHTML = '<div style="text-align:center; padding:0.75rem; opacity:0.5; font-size:0.8rem;"><i class="fa fa-spinner fa-spin"></i> Cargando...</div>';
    container.style.display = 'block';
    counter.textContent = '0';
    window._regVendedoresAliado = [];

    $.ajax({
        url: 'obtener_vendedores_por_tienda_ajax.php', type: 'POST', data: { cod_tienda: codTienda }, dataType: 'json',
        success: function(response) {
            list.innerHTML = '';
            if (response.success && response.vendedores && response.vendedores.length > 0) {
                response.vendedores.forEach(function(v) {
                    agregarVendedorAListaAliado(v.nombres_apellidos_tercero || v.nombres, v.identificacion_tercero, '', true);
                });
            } else {
                list.innerHTML = '<div style="text-align:center; padding:0.75rem; opacity:0.4; font-size:0.78rem;">No hay vendedores registrados aún</div>';
            }
        },
        error: function() { list.innerHTML = '<div style="text-align:center; padding:0.75rem; color:#ef4444; font-size:0.78rem;">Error al cargar vendedores</div>'; }
    });
}

function agregarVendedorAListaAliado(nombre, identificacion, usuario, esExistente) {
    window._regVendedoresAliado.push({ nombre: nombre, identificacion: identificacion });
    var container = document.getElementById('listaRegVendedoresAliado');
    var list = document.getElementById('regVendedoresListAliado');
    var counter = document.getElementById('contadorRegVendedoresAliado');
    container.style.display = 'block';
    counter.textContent = window._regVendedoresAliado.length;

    // Limpiar "no hay vendedores" si existe
    var emptyMsg = list.querySelector('div[style*="opacity"]');
    if (emptyMsg && !emptyMsg.classList.contains('reg-item-card')) { emptyMsg.remove(); }

    var iconCls = esExistente ? 'fa-user-check' : 'fa-user-plus';
    var bgCls = esExistente ? 'vendedor-exist' : 'vendedor-new';
    var checkHtml = esExistente ? '' : '<i class="fa-solid fa-circle-check reg-item-check"></i>';

    var html = '<div class="reg-item-card' + (esExistente ? ' existente' : '') + '">' +
        '<div class="reg-item-icon ' + bgCls + '"><i class="fa-solid ' + iconCls + '"></i></div>' +
        '<div class="reg-item-info">' +
            '<h5>' + nombre + '</h5>' +
            '<span>CC: ' + identificacion + (usuario ? ' | Usuario: ' + usuario : '') + '</span>' +
        '</div>' +
        checkHtml +
    '</div>';
    list.insertAdjacentHTML('beforeend', html);
}

// Submit vendedor
document.getElementById('formRegVendedorAliado').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    Swal.fire({ title: 'Registrando vendedor...', allowOutsideClick: false, didOpen: function() { Swal.showLoading(); }, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });

    $.ajax({
        url: 'agregar_vendedor_tienda_asesor_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                var nombreV = document.getElementById('regVendedor_nombre').value + ' ' + document.getElementById('regVendedor_apellido').value;
                var idV = document.getElementById('regVendedor_identificacion').value;
                agregarVendedorAListaAliado(nombreV, idV, response.usuario || '', false);

                var codTienda = document.getElementById('regVendedor_cod_tienda').value;
                document.getElementById('formRegVendedorAliado').reset();
                document.getElementById('regVendedor_cod_tienda').value = codTienda;

                Swal.fire({ icon: 'success', title: '¡Vendedor Registrado!', html: response.message || 'El vendedor fue creado correctamente.', confirmButtonColor: '#f97316', background: '#1a1f2e', color: 'white', timer: 3000, timerProgressBar: true, customClass: { container: 'swal-high-zindex' } });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo registrar el vendedor', confirmButtonColor: '#f97316', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor.', confirmButtonColor: '#f97316', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});

// ===== MODAL PRODUCTOS =====
function abrirModalRegProductoAliado(codTienda) {
    document.getElementById('regProducto_cod_tienda').value = codTienda;
    document.getElementById('regProductoNombreTienda').textContent = 'Tienda #' + codTienda;
    document.getElementById('formRegProductoAliado').reset();
    document.getElementById('regProducto_cod_tienda').value = codTienda;
    window._regProductosAliado = [];
    cargarProductosTiendaAliado(codTienda);
    document.getElementById('modalRegProductoAliado').classList.add('show');
}

function cerrarModalRegProductoAliado() {
    document.getElementById('modalRegProductoAliado').classList.remove('show');
}

function cargarProductosTiendaAliado(codTienda) {
    var container = document.getElementById('listaRegProductosAliado');
    var list = document.getElementById('regProductosListAliado');
    var counter = document.getElementById('contadorRegProductosAliado');
    list.innerHTML = '<div style="text-align:center; padding:0.75rem; opacity:0.5; font-size:0.8rem;"><i class="fa fa-spinner fa-spin"></i> Cargando...</div>';
    container.style.display = 'block';
    counter.textContent = '0';
    window._regProductosAliado = [];

    $.ajax({
        url: 'obtener_productos_por_tienda_ajax.php', type: 'POST', data: { cod_tienda: codTienda }, dataType: 'json',
        success: function(response) {
            list.innerHTML = '';
            if (response.success && response.productos && response.productos.length > 0) {
                response.productos.forEach(function(p) { agregarProductoAListaAliado(p.nombre, p.codigo, p.precio, true); });
            } else {
                list.innerHTML = '<div style="text-align:center; padding:0.75rem; opacity:0.4; font-size:0.78rem;">No hay productos registrados aún</div>';
            }
        },
        error: function() {
            list.innerHTML = '<div style="text-align:center; padding:0.75rem; color:#ef4444; font-size:0.78rem;">Error al cargar productos</div>';
        }
    });
}

function agregarProductoAListaAliado(nombre, codigo, precioVenta, esExistente) {
    window._regProductosAliado.push({ nombre: nombre, codigo: codigo });
    var container = document.getElementById('listaRegProductosAliado');
    var list = document.getElementById('regProductosListAliado');
    var counter = document.getElementById('contadorRegProductosAliado');
    container.style.display = 'block';
    counter.textContent = window._regProductosAliado.length;

    // Limpiar empty message
    var emptyMsg = list.querySelector('div[style*="opacity"]');
    if (emptyMsg && !emptyMsg.classList.contains('reg-item-card')) { emptyMsg.remove(); }

    var precioFormateado = Number(precioVenta).toLocaleString('es-CO');
    var iconCls = esExistente ? 'fa-boxes-stacked' : 'fa-box-open';
    var bgCls = esExistente ? 'producto-exist' : 'producto-new';
    var checkHtml = esExistente ? '' : '<i class="fa-solid fa-circle-check reg-item-check"></i>';

    var html = '<div class="reg-item-card' + (esExistente ? ' existente' : '') + '">' +
        '<div class="reg-item-icon ' + bgCls + '"><i class="fa-solid ' + iconCls + '"></i></div>' +
        '<div class="reg-item-info">' +
            '<h5>' + nombre + '</h5>' +
            '<span>Código: ' + codigo + ' | $' + precioFormateado + '</span>' +
        '</div>' +
        checkHtml +
    '</div>';
    list.insertAdjacentHTML('beforeend', html);
}

// Formatear precios
function formatearPrecioAliado(input) {
    var valor = input.value.replace(/[^\d]/g, '');
    if (valor === '') { input.value = ''; return; }
    var numero = parseInt(valor, 10);
    input.value = '$ ' + numero.toLocaleString('es-CO');
}

// Submit producto
document.getElementById('formRegProductoAliado').addEventListener('submit', function(e) {
    e.preventDefault();
    // Copiar precios a hidden fields
    var precioCompra = document.getElementById('regProducto_precio_compra');
    var precioVenta = document.getElementById('regProducto_precio_venta');
    if (precioCompra) document.getElementById('regProducto_precio_compra_hidden').value = precioCompra.value.replace(/[^\d]/g, '') || '0';
    if (precioVenta) document.getElementById('regProducto_precio_venta_hidden').value = precioVenta.value.replace(/[^\d]/g, '') || '0';

    var precioVentaVal = parseInt(document.getElementById('regProducto_precio_venta_hidden').value) || 0;
    if (precioVentaVal <= 0) {
        Swal.fire({ icon: 'warning', title: 'Precio requerido', text: 'El precio de venta es obligatorio y debe ser mayor a 0.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#3b82f6', customClass: { container: 'swal-high-zindex' } });
        return;
    }

    var formData = new FormData(this);
    Swal.fire({ title: 'Registrando producto...', allowOutsideClick: false, didOpen: function() { Swal.showLoading(); }, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });

    $.ajax({
        url: 'reg_producto_tienda_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                var nombreP = document.getElementById('regProducto_nombre').value;
                var codigoP = document.getElementById('regProducto_codigo').value;
                var precioP = document.getElementById('regProducto_precio_venta').value.replace(/[^\d]/g, '') || '0';
                agregarProductoAListaAliado(nombreP, codigoP, precioP, false);

                var codTienda = document.getElementById('regProducto_cod_tienda').value;
                document.getElementById('formRegProductoAliado').reset();
                document.getElementById('regProducto_cod_tienda').value = codTienda;

                Swal.fire({ icon: 'success', title: '¡Producto Registrado!', text: 'El producto fue creado correctamente.', confirmButtonColor: '#3b82f6', background: '#1a1f2e', color: 'white', timer: 2500, timerProgressBar: true, customClass: { container: 'swal-high-zindex' } });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo registrar el producto', confirmButtonColor: '#3b82f6', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor.', confirmButtonColor: '#3b82f6', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});

// Navegación entre modales
function volverAConfirmacionDesdeVendedor() { cerrarModalRegVendedorAliado(); document.getElementById('modalConfirmacionRegistro').classList.add('show'); }
function volverAConfirmacionDesdeProducto() { cerrarModalRegProductoAliado(); document.getElementById('modalConfirmacionRegistro').classList.add('show'); }
function finalizarRegistroDesdeModal() { cerrarModalRegVendedorAliado(); cerrarModalRegProductoAliado(); document.getElementById('modalConfirmacionRegistro').classList.remove('show'); location.reload(); }
// Cerrar modales al clic fuera
document.getElementById('modalRegVendedorAliado').addEventListener('click', function(e) { if (e.target === this) { cerrarModalRegVendedorAliado(); } });
document.getElementById('modalRegProductoAliado').addEventListener('click', function(e) { if (e.target === this) { cerrarModalRegProductoAliado(); } });

function escapeHtmlMovil(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}
// ========== SISTEMA DE FIRMA DIGITAL INDEPENDIENTE ==========
function crearDocumento(codAliado) {
    document.getElementById('firma_aliado_cod').value = codAliado;
    
    // Resetear y cargar tiendas
    var selectTienda = document.getElementById('firma_tienda_cod');
    selectTienda.innerHTML = '<option value="0">Cargando tiendas...</option>';
    
    $.ajax({
        url: 'obtener_tiendas_aliado_ajax.php', type: 'POST', data: { cod_aliado: codAliado }, dataType: 'json',
        success: function(res) {
            if (res.success) {
                //var html = '<option value="0">-- Seleccione una tienda --</option>';
                var html = '';
                if (res.tiendas.length > 0) {
                    res.tiendas.forEach(function(t) { html += '<option value="'+t.cod_tienda+'">'+escapeHtmlMovil(t.nombre_tienda)+'</option>'; });
                } else {
                    html = '<option value="0">El aliado no tiene tiendas registradas</option>';
                }
                selectTienda.innerHTML = html;
            } else {
                selectTienda.innerHTML = '<option value="0">Error al cargar tiendas</option>';
            }
        },
        error: function() {
            selectTienda.innerHTML = '<option value="0">Error de conexión</option>';
        }
    });

    // Resetear vistas del modal
    document.getElementById('step_confirmar_firma').style.display = 'block';
    document.getElementById('step_compartir_firma').style.display = 'none';
    // Abrir modal
    document.getElementById('modalCrearDocumentoFirma').classList.add('show');
}
function cerrarModalCrearDocumento() { document.getElementById('modalCrearDocumentoFirma').classList.remove('show'); }

function procesarCreacionDocumento() {
    var codAliado = document.getElementById('firma_aliado_cod').value;
    var codTienda = document.getElementById('firma_tienda_cod').value;

    if (codTienda == "0" || !codTienda) {
        return Swal.fire({ icon: 'warning', title: 'Tienda requerida', text: 'Debe seleccionar una tienda para continuar.', confirmButtonColor: '#8b5cf6', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    }

    Swal.fire({ title: 'Generando documento...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    $.ajax({
        url: 'crear_documento_firma_aliado_ajax.php', type: 'POST', data: { cod_aliado: codAliado, cod_tienda: codTienda }, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                // Llenar datos de compartir
                document.getElementById('input_enlace_signature').value = response.url_firma_digital_documento;
                document.getElementById('share_firma_aliado_nombre').value = response.aliado;
                document.getElementById('share_firma_aliado_tel').value = response.telefono || '';
                document.getElementById('share_firma_aliado_email').value = response.correo || '';
                // Cambiar a vista de compartir
                document.getElementById('step_confirmar_firma').style.display = 'none';
                $('#step_compartir_firma').fadeIn();
                
                Swal.fire({ icon: 'success', title: '¡Listo!', text: 'El documento ha sido creado. Ahora puede compartir el enlace.', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo conectar con el servidor', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
}
function copiarEnlaceSignature() {
    var input = document.getElementById('input_enlace_signature');
    input.select();
    input.setSelectionRange(0, 99999);
    try {
        document.execCommand('copy');
        Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'Enlace copiado al portapapeles', timer: 1500, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    } catch (e) {}
}
function enviarSignaturePorWhatsApp() {
    var enlace = document.getElementById('input_enlace_signature').value;
    var nombre = document.getElementById('share_firma_aliado_nombre').value;
    var tel = document.getElementById('share_firma_aliado_tel').value;
    var msj = encodeURIComponent("Hola " + nombre + ", le envío el enlace para realizar la firma digital del documento de alianza comercial: " + enlace);
    var url = "https://api.whatsapp.com/send?text=" + msj;
    if (tel) { url = "https://api.whatsapp.com/send?phone=57" + tel + "&text=" + msj; }
    window.open(url, '_blank');
}
function enviarSignaturePorEmail() {
    var enlace = document.getElementById('input_enlace_signature').value;
    var nombre = document.getElementById('share_firma_aliado_nombre').value;
    var emailInicial = document.getElementById('share_firma_aliado_email').value || '';
    
    Swal.fire({
        title: 'Enviar enlace por correo', text: 'Escriba o confirme el correo electrónico:', input: 'email', inputLabel: 'Correo del aliado', inputPlaceholder: 'ejemplo@correo.com', inputValue: emailInicial, showCancelButton: true, confirmButtonText: '<i class="fa-solid fa-paper-plane"></i> Enviar ahora', cancelButtonText: 'Cancelar', confirmButtonColor: '#8b5cf6', background: '#1a1f2e', color: 'white',
        inputValidator: (value) => { if (!value) { return '¡El correo electrónico es obligatorio!'; } },
        customClass: { container: 'swal-high-zindex', input: 'swal-custom-input' }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            var emailFinal = result.value;

            Swal.fire({ title: 'Enviando correo...', text: 'Procesando envío por PHPMailer', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });

            $.ajax({
                url: 'enviar_enlace_firma_aliado_email_ajax.php', type: 'POST', data: { correo: emailFinal, nombre_aliado: nombre, enlace_firma: enlace }, dataType: 'json',
                success: function(response) {
                    Swal.close();
                    if (response.success) {
                        Swal.fire({ icon: 'success', title: '¡Enviado!', text: response.mensaje, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                    }
                },
                error: function() {
                    Swal.close();
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Ocurrió un error técnico al intentar enviar el correo.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                }
            });
        }
    });
}
// Cerrar modales al clic fuera
$(document).ready(function() {
    const modalFirma = document.getElementById('modalCrearDocumentoFirma');
    if (modalFirma) modalFirma.addEventListener('click', function(e) { if (e.target === this) { cerrarModalCrearDocumento(); } });
    
    const modalTiendas = document.getElementById('modalVerTiendas');
    if (modalTiendas) modalTiendas.addEventListener('click', function(e) { if (e.target === this) { cerrarModalVerTiendas(); } });
    
    const modalCuentas = document.getElementById('modalVerCuentas');
    if (modalCuentas) modalCuentas.addEventListener('click', function(e) { if (e.target === this) { cerrarModalVerCuentas(); } });
});

// Funciones para ver tiendas
function abrirModalVerTiendas(codAliado, nombreAliado) {
    document.getElementById('v_nombre_aliado_t').textContent = nombreAliado;
    const container = document.getElementById('lista_tiendas_aliadas_v');
    container.innerHTML = '<div style="text-align: center; padding: 2rem;"><i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #10b981;"></i><p style="margin-top: 1rem; color: rgba(255,255,255,0.6);">Cargando tiendas...</p></div>';
    $('#modalVerTiendas').fadeIn().css('display', 'flex');

    $.ajax({
        url: 'obtener_tiendas_por_aliado_ajax.php', type: 'POST', data: { cod_aliado_estrategico: codAliado }, dataType: 'json',
        success: function(response) {
            if (response.success && response.tiendas.length > 0) {
                let html = '<div class="view-list">';
                response.tiendas.forEach(tienda => {
                    html += `
                        <div class="view-item" onclick="window.location.href='lista_tienda_asesor_movil.php?busqueda=${encodeURIComponent(tienda.identificacion_tercero)}'">
                            <div class="view-item-title">${tienda.nombre_tienda}</div>
                            <div class="view-item-detail"><i class="fa-solid fa-id-card"></i> ${tienda.identificacion_tercero}</div>
                            <div class="view-item-detail"><i class="fa-solid fa-map-marker-alt"></i> ${tienda.direccion_tercero}</div>
                        </div>
                    `;
                });
                html += '</div>';
                container.innerHTML = html;
            } else {
                container.innerHTML = '<div style="text-align: center; padding: 2rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-store-slash" style="font-size: 2rem; margin-bottom: 1rem;"></i><p>No hay tiendas registradas</p></div>';
            }
        },
        error: function() {
            container.innerHTML = '<div style="text-align: center; padding: 2rem; color: #ef4444;"><i class="fa-solid fa-exclamation-triangle" style="font-size: 2rem; margin-bottom: 1rem;"></i><p>Error al cargar tiendas</p></div>';
        }
    });
}
function cerrarModalVerTiendas() { $('#modalVerTiendas').fadeOut(); }

// Funciones para ver cuentas
function abrirModalVerCuentas(codAliado, nombreAliado) {
    document.getElementById('v_nombre_aliado_c').textContent = nombreAliado;
    const container = document.getElementById('lista_cuentas_aliadas_v');
    container.innerHTML = '<div style="text-align: center; padding: 2rem;"><i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #f97316;"></i><p style="margin-top: 1rem; color: rgba(255,255,255,0.6);">Cargando cuentas...</p></div>';
    $('#modalVerCuentas').fadeIn().css('display', 'flex');

    $.ajax({
        url: 'obtener_bancos_cuenta_por_aliado_ajax.php', type: 'POST', data: { cod_aliado_estrategico: codAliado }, dataType: 'json',
        success: function(response) {
            if (response.success && response.bancos.length > 0) {
                let html = '<div class="view-list">';
                response.bancos.forEach(banco => {
                    html += `
                        <div class="view-item">
                            <div class="view-item-title">${banco.nombre_banco_cuenta}</div>
                            <div class="view-item-detail"><i class="fa-solid fa-hashtag"></i> No. ${banco.numero_banco_cuenta}</div>
                            <div class="view-item-detail"><i class="fa-solid fa-user"></i> ${banco.nombre_titular_cuenta}</div>
                        </div>
                    `;
                });
                html += '</div>';
                container.innerHTML = html;
            } else {
                container.innerHTML = '<div style="text-align: center; padding: 2rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-university" style="font-size: 2rem; margin-bottom: 1rem;"></i><p>No hay cuentas registradas</p></div>';
            }
        },
        error: function() {
            container.innerHTML = '<div style="text-align: center; padding: 2rem; color: #ef4444;"><i class="fa-solid fa-exclamation-triangle" style="font-size: 2rem; margin-bottom: 1rem;"></i><p>Error al cargar cuentas</p></div>';
        }
    });
}
function cerrarModalVerCuentas() { $('#modalVerCuentas').fadeOut(); }
</script>

<!-- Modal Ver Tiendas -->
<div class="modal-overlay" id="modalVerTiendas" style="align-items: flex-start; padding-top: 20px;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <h2 style="font-size: 1rem;"><i class="fa-solid fa-store"></i> Tiendas: <span id="v_nombre_aliado_t"></span></h2>
            <button class="modal-close" onclick="cerrarModalVerTiendas()" style="background: rgba(255,255,255,0.2); color: white;"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div id="lista_tiendas_aliadas_v"></div>
        </div>
    </div>
</div>

<!-- Modal Ver Cuentas -->
<div class="modal-overlay" id="modalVerCuentas" style="align-items: flex-start; padding-top: 20px;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);">
            <h2 style="font-size: 1rem;"><i class="fa-solid fa-university"></i> Cuentas: <span id="v_nombre_aliado_c"></span></h2>
            <button class="modal-close" onclick="cerrarModalVerCuentas()" style="background: rgba(255,255,255,0.2); color: white;"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div id="lista_cuentas_aliadas_v"></div>
        </div>
    </div>
</div>

<style>
.view-list { display: flex; flex-direction: column; gap: 0.75rem; }
.view-item { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 1rem; transition: all 0.3s ease; }
.view-item:active { background: rgba(255,255,255,0.1); transform: scale(0.98); }
.view-item-title { color: white; font-weight: 700; font-size: 0.95rem; margin-bottom: 0.25rem; }
.view-item-detail { color: rgba(255,255,255,0.6); font-size: 0.8rem; display: flex; align-items: center; gap: 0.5rem; margin-top: 0.25rem; }

/* ====================== PREMIUM PAGINATION ====================== */
.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.6rem;
    margin: 2.5rem 0;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, 0.05);
    animation: fadeInUp 0.8s ease forwards;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.pagination-btn {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: #10b981;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    font-size: 0.9rem;
}

.pagination-btn i {
    font-size: 1.1rem;
}

.pagination-btn:hover:not(.disabled) {
    background: #10b981;
    color: white !important;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
    border-color: #10b981;
}

.pagination-btn.disabled {
    opacity: 0.25;
    cursor: not-allowed;
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.3);
}

.pagination-info {
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.7);
    padding: 0 1.25rem;
    background: rgba(16, 185, 129, 0.05);
    height: 42px;
    display: flex;
    align-items: center;
    border-radius: 12px;
    border: 1px solid rgba(16, 185, 129, 0.1);
    letter-spacing: 0.5px;
}

.pagination-info span {
    color: #10b981;
    margin: 0 4px;
}

@media (max-width: 480px) {
    .pagination-btn span {
        display: none;
    }
    .pagination-container {
        margin: 2rem 0;
        gap: 0.5rem;
        padding: 0.6rem;
    }
    
    .pagination-btn {
        width: 38px;
        height: 38px;
    }
    
    .pagination-info {
        height: 38px;
        font-size: 0.8rem;
        padding: 0 0.75rem;
    }
}
</style>

</body>
</html>


<!-- Modal Registro Rápido -->
<div class="modal-overlay" id="modalRegistroRapido" style="align-items: center; z-index: 5000;">
    <div class="modal-content" style="max-width: 450px; border-radius: 24px; padding: 0; background: #0f172a; border: 1px solid rgba(255,255,255,0.1); overflow: hidden;">
        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 1.5rem; position: relative;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 14px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                    <i class="fa-solid fa-bolt" style="color: white; font-size: 1.5rem;"></i>
                </div>
                <div>
                    <h2 style="color: white; margin: 0; font-size: 1.25rem; font-weight: 700;">Registro Rápido</h2>
                    <p style="color: rgba(255,255,255,0.8); margin: 0; font-size: 0.85rem;">Crear aliado de prueba en segundos</p>
                </div>
            </div>
            <button class="modal-close" onclick="cerrarModalRapido()" style="background: rgba(0,0,0,0.2); border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; top: 1.25rem; right: 1.25rem; color: white;">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body" style="padding: 1.5rem;">
            <form id="formRegistroRapido">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.25rem;">
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label" style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Nombre Comercial del Aliado *</label>
                        <div style="position: relative;">
                            <i class="fa-solid fa-store" style="position: absolute; left: 1rem; top: 1rem; color: #f59e0b;"></i>
                            <input type="text" class="form-input" name="nombres_apellidos_tercero" placeholder="Ej: Tienda La Bendición" required style="padding-left: 2.75rem; border-radius: 12px; background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Teléfono Móvil *</label>
                        <div style="position: relative;">
                            <i class="fa-solid fa-phone" style="position: absolute; left: 1rem; top: 1rem; color: #f59e0b;"></i>
                            <input type="tel" class="form-input" name="telefono1_tercero" placeholder="Ej: 300..." required style="padding-left: 2.75rem; border-radius: 12px; background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1);">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Correo Electrónico *</label>
                        <div style="position: relative;">
                            <i class="fa-solid fa-envelope" style="position: absolute; left: 1rem; top: 1rem; color: #f59e0b;"></i>
                            <input type="email" class="form-input" name="correo_tercero" placeholder="Email..." required style="padding-left: 2.75rem; border-radius: 12px; background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1);">
                        </div>
                    </div>
                </div>

                <div style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2); border-radius: 16px; padding: 1rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; gap: 0.75rem;">
                        <i class="fa-solid fa-circle-info" style="color: #f59e0b; font-size: 1.1rem; margin-top: 0.15rem;"></i>
                        <p style="color: rgba(255,255,255,0.8); margin: 0; font-size: 0.75rem; line-height: 1.5;">
                            Este registro creará un <strong>Aliado de Prueba</strong> con un límite inicial de <strong>3 créditos</strong>. Podrá completar su información después.
                        </p>
                    </div>
                </div>

                <button type="submit" style="width: 100%; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 1.1rem; border-radius: 16px; font-size: 1rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.75rem; transition: all 0.3s ease; box-shadow: 0 10px 15px -3px rgba(217, 119, 6, 0.3);">
                    <i class="fa-solid fa-bolt"></i> Crear Aliado de Prueba
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function abrirModalRapido() {
    $('#modalRegistroRapido').fadeIn().css('display', 'flex');
}

function cerrarModalRapido() {
    $('#modalRegistroRapido').fadeOut();
}

$(document).ready(function() {
    $('#formRegistroRapido').on('submit', function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        
        Swal.fire({
            title: 'Registrando...',
            text: 'Estamos creando el aliado de prueba',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: 'reg_aliado_rapido_ajax_reg.php', type: 'POST', data: formData, dataType: 'json',
            success: function(response) {
                if (response.afectado === "SI") {
                    Swal.fire({ icon: 'success', title: '¡Aliado Creado!', text: response.mensaje, confirmButtonText: 'Perfecto' }).then(() => { cerrarModalRapido(); location.reload(); });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje });
                }
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Error de Red', text: 'No se pudo conectar con el servidor' });
            }
        });
    });
});

function habilitarAliado(cod_administrador, nombre_aliado) {
    Swal.fire({
        title: '¿Habilitar Aliado?', text: "El aliado " + nombre_aliado + " pasará a ser un aliado normal sin límite de créditos.", icon: 'question', showCancelButton: true, confirmButtonColor: '#10b981', cancelButtonColor: '#3085d6', confirmButtonText: 'Sí, habilitar', cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({ title: 'Procesando...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

            $.ajax({
                url: 'habilitar_aliado_prueba_ajax.php', type: 'POST', data: { cod_administrador: cod_administrador }, dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire('¡Habilitado!', response.message, 'success')
                        .then(() => { location.reload(); });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'No se pudo procesar la solicitud', 'error');
                }
            });
        }
    });
}
</script>