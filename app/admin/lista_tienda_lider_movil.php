<?php 
$nombre_pagina          = "Mis Tiendas";
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
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Select2 CDN -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* Ajustes para Select2 en modo oscuro con estética Premium */
.select2-container--default .select2-selection--single {
    background: rgba(139, 92, 246, 0.1) !important;
    border: 1px solid rgba(139, 92, 246, 0.3) !important;
    border-radius: 12px !important;
    height: 50px !important;
    display: flex !important;
    align-items: center !important;
    transition: all 0.3s ease !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: white !important;
    padding-left: 1.25rem !important;
    font-size: 0.95rem !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 48px !important;
    right: 10px !important;
}
.select2-container--default.select2-container--open .select2-selection--single {
    border-color: #8b5cf6 !important;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2) !important;
}
.select2-dropdown {
    background: #1a1f2e !important;
    border: 1px solid rgba(139, 92, 246, 0.4) !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5) !important;
    color: white !important;
    overflow: hidden !important;
    z-index: 9999 !important;
}
.select2-results__option {
    padding: 10px 15px !important;
    font-size: 0.9rem !important;
    transition: all 0.2s ease !important;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%) !important;
}
.select2-search--dropdown {
    padding: 10px !important;
    background: #0d1117 !important;
}
.select2-search--dropdown .select2-search__field {
    background: rgba(255,255,255,0.05) !important;
    border: 1px solid rgba(139, 92, 246, 0.3) !important;
    color: white !important;
    padding: 8px 12px !important;
    border-radius: 8px !important;
    outline: none !important;
}
/* Asegurar que Select2 este encima del modal */
.select2-container {
    z-index: 10000 !important;
}
</style>

<style>
/* ============================================ */
/* LISTA TIENDAS lider - TEMA VERDE ESMERALDA */
/* ============================================ */

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
    min-height: 100vh;
}

/* SweetAlert z-index fix */
.swal-high-zindex, .swal2-container {
    z-index: 100000 !important;
}

.page-container {
    padding: 1rem;
    padding-bottom: 100px;
    max-width: 1200px;
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

/* Search Bar */
.search-bar {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(139, 92, 246, 0.3);
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
    color: #8b5cf6;
    font-size: 1.1rem;
}

/* Add Button */
.add-button {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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
    box-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);
}

.add-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 30px rgba(139, 92, 246, 0.5);
}

/* Store Cards */
.store-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.store-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 16px;
    padding: 1.25rem;
    transition: all 0.3s ease;
}

.store-card:hover {
    border-color: #8b5cf6;
    box-shadow: 0 5px 20px rgba(139, 92, 246, 0.2);
}

.store-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.store-info {
    flex: 1;
}

.store-name {
    font-size: 1rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.25rem;
}

.store-nit {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.6);
}

.store-status {
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
}

.store-status.active {
    background: rgba(52, 211, 153, 0.2);
    color: #34d399;
}

.store-status.pending {
    background: rgba(245, 158, 11, 0.2);
    color: #f59e0b;
}

.store-details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.store-detail {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.store-detail i {
    color: #8b5cf6;
    font-size: 0.85rem;
    width: 20px;
}

.store-detail span {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.8);
}

.store-actions {
    display: flex;
    gap: 0.5rem;
    border-top: 1px solid rgba(139, 92, 246, 0.15);
    padding-top: 1rem;
}

.action-btn {
    flex: 1;
    padding: 0.6rem;
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
}

.action-btn.primary {
    background: rgba(139, 92, 246, 0.2);
    color: #8b5cf6;
}

.action-btn.primary:hover {
    background: #8b5cf6;
    color: white;
}

.action-btn.secondary {
    background: rgba(139, 92, 246, 0.2);
    color: #8b5cf6;
}

.action-btn.secondary:hover {
    background: #8b5cf6;
    color: white;
}

.action-btn.info {
    background: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
}

.action-btn.info:hover {
    background: #3b82f6;
    color: white;
}

.action-btn.archive {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.1);
}

.action-btn.archive:hover {
    background: #ef4444;
    color: white;
}

/* Store Stats */
.store-stats {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid rgba(139, 92, 246, 0.15);
}

.store-stat-item {
    flex: 1;
    text-align: center;
    padding: 0.4rem;
    border-radius: 8px;
    background: rgba(139, 92, 246, 0.08);
}

.store-stat-number {
    font-size: 1.1rem;
    font-weight: 700;
    color: #8b5cf6;
    display: block;
}

.store-stat-label {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.6);
    font-weight: 500;
}

/* Quick Action Buttons */
.store-quick-actions {
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

.btn-quick-action.btn-vendedor {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
}

.btn-quick-action.btn-producto {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

/* Pagination Styles */
.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    margin-top: 2rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.pagination-btn {
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    color: white;
    padding: 0.5rem 0.85rem;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination-btn:hover {
    background: rgba(139, 92, 246, 0.3);
    border-color: #8b5cf6;
    color: white;
}

.pagination-btn.active {
    background: #8b5cf6;
    border-color: #8b5cf6;
    color: white;
}

.pagination-btn.disabled {
    opacity: 0.5;
    pointer-events: none;
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

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-state i {
    font-size: 4rem;
    color: rgba(139, 92, 246, 0.3);
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
    align-items: center;
    justify-content: center;
}

.modal-overlay.show {
    display: flex;
}

.modal-content {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 20px;
    width: 100%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 0;
    animation: modalFadeIn 0.3s ease;
}

@keyframes modalFadeIn {
    from { 
        opacity: 0;
        transform: scale(0.9);
    }
    to { 
        opacity: 1;
        transform: scale(1);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    position: sticky;
    top: 0;
    background: #1a1f2e;
    border-radius: 20px 20px 0 0;
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

.modal-header h2 i {
    color: #8b5cf6;
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
.form-section-title {
    color: #8b5cf6;
    font-size: 0.9rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 1.5rem 0 1rem 0;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

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
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 12px;
    padding: 0.85rem 1rem;
    color: white;
    font-size: 0.95rem;
    outline: none;
    transition: all 0.3s ease;
}

.form-input:focus, .form-select:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
}

.form-input::placeholder {
    color: rgba(255,255,255,0.4);
}

.form-input[readonly] {
    background: rgba(255,255,255,0.05);
    border-color: rgba(255,255,255,0.1);
    cursor: not-allowed;
}

.form-select {
    appearance: none;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2310b981' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1rem;
    background-color: #1a1f2e;
}

.form-select option {
    background-color: #1a1f2e;
    color: white;
    padding: 0.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.file-input-wrapper {
    position: relative;
    border: 2px dashed rgba(139, 92, 246, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    background: rgba(139, 92, 246, 0.05);
    transition: all 0.3s ease;
}

.file-input-wrapper:hover {
    border-color: #8b5cf6;
    background: rgba(139, 92, 246, 0.1);
}

.file-input-wrapper input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.file-input-icon {
    font-size: 2rem;
    color: #8b5cf6;
    margin-bottom: 0.5rem;
}

.file-input-text {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.7);
}

.image-preview {
    margin-top: 1rem;
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    display: none;
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.document-preview {
    margin-top: 1rem;
    padding: 1rem;
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 8px;
    display: none;
}

.document-preview iframe,
.document-preview embed {
    width: 100%;
    height: 400px;
    border: none;
    border-radius: 4px;
    background: white;
}

.document-preview img {
    width: 100%;
    max-height: 400px;
    object-fit: contain;
    border-radius: 4px;
    background: white;
}

.document-preview-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid rgba(139, 92, 246, 0.3);
}

.document-preview-title {
    color: #8b5cf6;
    font-weight: 600;
    font-size: 0.9rem;
}

.document-preview-actions {
    display: flex;
    gap: 0.5rem;
}

.document-preview-btn {
    background: #8b5cf6;
    color: white;
    border: none;
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
    transition: background 0.3s;
}

.document-preview-btn:hover {
    background: #7c3aed;
}

.gps-btn {
    background: #8b5cf6;
    color: white;
    border: none;
    padding: 0.85rem;
    border-radius: 12px;
    cursor: pointer;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-weight: 600;
}

.gps-status {
    margin-top: 0.5rem;
    font-size: 0.8rem;
    padding: 0.5rem;
    border-radius: 8px;
    display: none;
}

.submit-btn {
    width: 100%;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    margin-top: 2rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(139, 92, 246, 0.5);
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

/* SweetAlert z-index fix - FORZAR SIEMPRE POR ENCIMA DE MODALES */
.swal2-container {
    z-index: 100000 !important;
}

.swal-high-zindex {
    z-index: 100000 !important;
}

.swal2-container.swal-high-zindex {
    z-index: 100000 !important;
}

/* ============================================ */
/* MODAL CONFIRMACIÓN POST-REGISTRO             */
/* ============================================ */
.confirm-modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.85);
    backdrop-filter: blur(8px);
    z-index: 4000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.confirm-modal-overlay.show { display: flex; }

.confirm-modal-box {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 24px;
    width: 100%;
    max-width: 480px;
    padding: 0;
    animation: confirmModalIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    overflow: hidden;
}

@keyframes confirmModalIn {
    from { opacity: 0; transform: scale(0.8) translateY(30px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}

.confirm-success-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    padding: 2rem 1.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.confirm-success-icon {
    width: 80px; height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1rem;
    animation: successPulse 2s ease-in-out infinite;
    position: relative; z-index: 2;
}

.confirm-success-icon i { font-size: 2.5rem; color: white; }
.confirm-success-header h3 { color: white; font-size: 1.4rem; font-weight: 800; margin: 0 0 0.5rem 0; position: relative; z-index: 2; }
.confirm-success-header p { color: rgba(255,255,255,0.9); font-size: 0.9rem; margin: 0; position: relative; z-index: 2; }

.confirm-store-name {
    background: rgba(255,255,255,0.15);
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-weight: 700;
    display: inline-block;
    margin-top: 0.5rem;
    position: relative; z-index: 2;
}

.confirm-body { padding: 1.5rem; }
.confirm-body-title { color: rgba(255,255,255,0.7); font-size: 0.85rem; text-align: center; margin-bottom: 1.25rem; font-weight: 500; }
.confirm-actions-grid { display: flex; flex-direction: column; gap: 0.75rem; }

.confirm-action-card {
    display: flex; align-items: center; gap: 1rem;
    padding: 1rem 1.25rem;
    border-radius: 16px;
    border: 1px solid transparent;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none !important;
}

.confirm-action-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.3); }

.confirm-action-card.vendedores { background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.1) 100%); border-color: rgba(99, 102, 241, 0.3); }
.confirm-action-card.productos { background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(234, 88, 12, 0.1) 100%); border-color: rgba(245, 158, 11, 0.3); }

.confirm-action-icon { width: 50px; height: 50px; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.confirm-action-card.vendedores .confirm-action-icon { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); }
.confirm-action-card.productos .confirm-action-icon { background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%); }
.confirm-action-icon i { font-size: 1.25rem; color: white; }

.confirm-action-text { flex: 1; }
.confirm-action-text h4 { color: white; font-size: 0.95rem; font-weight: 700; margin: 0 0 0.2rem 0; }
.confirm-action-text p { color: rgba(255,255,255,0.5); font-size: 0.78rem; margin: 0; }

.confirm-action-arrow { color: rgba(255,255,255,0.3); font-size: 1rem; transition: all 0.3s ease; }
.confirm-action-card:hover .confirm-action-arrow { color: rgba(255,255,255,0.7); transform: translateX(3px); }

.confirm-footer { padding: 0 1.5rem 1.5rem; text-align: center; }
.confirm-skip-btn {
    background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.5);
    border: 1px solid rgba(255,255,255,0.1);
    padding: 0.75rem 1.5rem; border-radius: 12px;
    cursor: pointer; font-size: 0.85rem; font-weight: 600; width: 100%; transition: all 0.3s ease;
}
.confirm-skip-btn:hover { background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.8); }

/* ============================================ */
/* MODAL REGISTRO VENDEDORES / PRODUCTOS        */
/* ============================================ */
.reg-modal-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.85); backdrop-filter: blur(8px);
    z-index: 3000; display: none; align-items: center; justify-content: center; padding: 15px;
}
.reg-modal-overlay.show { display: flex; }

.reg-modal-container {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 20px; width: 100%; max-width: 550px; max-height: 92vh; overflow-y: auto;
    animation: confirmModalIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.reg-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 1.25rem 1.5rem; position: sticky; top: 0; z-index: 10; border-radius: 20px 20px 0 0; }
.reg-modal-header.vendedor-theme { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); }
.reg-modal-header.producto-theme { background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%); }
.reg-modal-header h2 { color: white; font-size: 1.15rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; margin: 0; }
.reg-modal-header .modal-close { background: rgba(255,255,255,0.2); color: white; }

.reg-modal-body { padding: 1.5rem; }
.reg-tienda-badge { background: rgba(255,255,255,0.1); padding: 0.5rem 1rem; border-radius: 12px; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.8); }
.reg-tienda-badge i { color: #10b981; }

.reg-submit-btn {
    width: 100%; color: white; border: none; padding: 0.9rem; border-radius: 12px;
    font-size: 0.95rem; font-weight: 700; cursor: pointer; margin-top: 1.25rem;
    transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 0.5rem;
}
.reg-submit-btn.vendedor-theme { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4); }
.reg-submit-btn.producto-theme { background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%); box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4); }

.reg-modal-footer { padding: 0 1.5rem 1.5rem; display: flex; gap: 0.75rem; }
.reg-footer-btn { flex: 1; padding: 0.75rem; border-radius: 12px; border: none; font-size: 0.85rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.4rem; transition: all 0.3s ease; }
.reg-footer-btn.back-btn { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.1); }
.reg-footer-btn.finish-btn { background: rgba(34, 197, 94, 0.15); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.3); }

/* Items registrados */
.items-registrados { margin-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem; }
.items-registrados-title { font-size: 0.8rem; font-weight: 700; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
.items-registrados-title .badge-count { background: rgba(255,255,255,0.15); padding: 0.15rem 0.5rem; border-radius: 10px; font-size: 0.75rem; }

.item-registrado {
    background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px;
    padding: 0.75rem 1rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.75rem;
}
.item-registrado-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.item-registrado-icon.vendedor-bg { background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(139, 92, 246, 0.3)); color: #a78bfa; }
.item-registrado-icon.producto-bg { background: linear-gradient(135deg, rgba(245, 158, 11, 0.3), rgba(234, 88, 12, 0.3)); color: #fbbf24; }
.item-registrado-info { flex: 1; min-width: 0; }
.item-registrado-info h5 { color: white; font-size: 0.85rem; font-weight: 600; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.item-registrado-info span { color: rgba(255,255,255,0.45); font-size: 0.75rem; }
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Parámetros de paginación
$registros_por_pagina = 30;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina <= 0) $pagina = 1;
$inicio = ($pagina - 1) * $registros_por_pagina;

$busqueda = isset($_GET['busqueda']) ? trim(mysqli_real_escape_string($conectar, $_GET['busqueda'])) : '';
$cod_coordinador_filtro = isset($_GET['cod_coordinador']) ? (int)$_GET['cod_coordinador'] : 0;
// Subquery para obtener los cod_administrador de los aliados que pertenecen a este líder
$subquery_aliados_lider = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_seguridad = '23' AND cod_lider = '$cod_administrador' AND cod_estado != '0' AND cod_estado_activacion_usuario != '3'";
if ($cod_coordinador_filtro > 0) { $subquery_aliados_lider .= " AND cod_coordinador = '$cod_coordinador_filtro'"; }
// Consulta para contar el total de tiendas (para la paginación)
$sql_conteo = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_aliado_estrategico IN ($subquery_aliados_lider)";
if (!empty($busqueda)) { $sql_conteo .= " AND (nombre_tienda LIKE '%$busqueda%' OR identificacion_tercero LIKE '%$busqueda%' OR nombre1_tercero LIKE '%$busqueda%' OR cod_tienda LIKE '$busqueda')"; }
$resultado_conteo = mysqli_query($conectar, $sql_conteo);
$fila_conteo = mysqli_fetch_assoc($resultado_conteo);
$total_registros = $fila_conteo['total'];
$total_paginas = ceil($total_registros / $registros_por_pagina);
// Consulta principal adaptada para paginación
$sql_tiendas = "SELECT t.*, a.nombres_apellidos_tercero as nombre_aliado, 
(SELECT COUNT(*) FROM tbl15_info_factura_venta WHERE cod_tienda = t.cod_tienda AND nombre_estado_factura = 'ABIERTA') as creditos_activos 
FROM tbl15_tienda t LEFT JOIN tbl15_administrador a ON t.cod_aliado_estrategico = a.cod_administrador WHERE t.cod_aliado_estrategico IN ($subquery_aliados_lider)";
if (!empty($busqueda)) { $sql_tiendas .= " AND (t.nombre_tienda LIKE '%$busqueda%' OR t.identificacion_tercero LIKE '%$busqueda%' OR t.nombre1_tercero LIKE '%$busqueda%' OR t.cod_tienda LIKE '$busqueda')"; }

$sql_tiendas .= " ORDER BY t.fecha_creacion DESC LIMIT $inicio, $registros_por_pagina";
$resultado_tiendas = mysqli_query($conectar, $sql_tiendas);
$total_tiendas_pagina = ($resultado_tiendas) ? mysqli_num_rows($resultado_tiendas) : 0;
// Contar tiendas con firma
$sql_con_firma = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_aliado_estrategico IN ($subquery_aliados_lider) AND url_firma_electronica IS NOT NULL AND url_firma_electronica != ''";
$resultado_con_firma = mysqli_query($conectar, $sql_con_firma);
$tiendas_con_firma = 0;
if ($resultado_con_firma) { $datos_con_firma = mysqli_fetch_assoc($resultado_con_firma); $tiendas_con_firma = isset($datos_con_firma['total']) ? intval($datos_con_firma['total']) : 0; }
// Contar tiendas con GPS
$sql_con_gps = "SELECT COUNT(*) as total FROM tbl15_tienda WHERE cod_aliado_estrategico IN ($subquery_aliados_lider) AND ubicacion_gps_tienda IS NOT NULL AND ubicacion_gps_tienda != ''";
$resultado_con_gps = mysqli_query($conectar, $sql_con_gps);
$tiendas_con_gps = 0;
if ($resultado_con_gps) { $datos_con_gps = mysqli_fetch_assoc($resultado_con_gps); $tiendas_con_gps = isset($datos_con_gps['total']) ? intval($datos_con_gps['total']) : 0; }
// Obtener aliados estratégicos para el select (cod_seguridad = 23)
$sql_aliados = "SELECT cod_administrador, cedula, nombres, apellidos, nombres_apellidos_tercero, comision_ptj FROM tbl15_administrador WHERE cod_seguridad = '23' ORDER BY nombres_apellidos_tercero ASC";
$resultado_aliados = mysqli_query($conectar, $sql_aliados);
// Obtener Líderes (cod_seguridad = 21)
$sql_lideres = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '21' ORDER BY nombres_apellidos_tercero ASC";
$resultado_lideres = mysqli_query($conectar, $sql_lideres);
// Obtener Coordinadores (cod_seguridad = 22)
$sql_coordinadores = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '22' ORDER BY nombres_apellidos_tercero ASC";
$resultado_coordinadores = mysqli_query($conectar, $sql_coordinadores);
// Obtener Asesores (cod_seguridad = 2)
$sql_asesores = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '2' ORDER BY nombres_apellidos_tercero ASC";
$resultado_asesores = mysqli_query($conectar, $sql_asesores);
// Consulta de tipos de sector para el formulario de registro de tienda
$sql_tipo_sector = "SELECT cod_tipo_sector, nombre_tipo_sector, descripcion_tipo_sector FROM tbl15_tipo_sector WHERE cod_estado = '1' ORDER BY cod_tipo_sector ASC";
$res_tipo_sector = mysqli_query($conectar, $sql_tipo_sector);

$sql_cat_prod = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE cod_estado = '1' ORDER BY nombre_categoria ASC";
$res_cat_prod = mysqli_query($conectar, $sql_cat_prod);
?>
<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-store"></i> Mis Tiendas</h1>
        <p>Gestiona tus tiendas afiliadas</p>
        <div class="header-stats">
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $total_registros; ?></div>
                <div class="header-stat-label">Total</div>
            </div>
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $tiendas_con_firma; ?></div>
                <div class="header-stat-label">Con Firma</div>
            </div>
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $tiendas_con_gps; ?></div>
                <div class="header-stat-label">Con GPS</div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="search-bar animate-in delay-1">
        <i class="fa-solid fa-search"></i>
        <input type="text" id="searchInput" placeholder="Buscar tienda..." value="<?php echo htmlspecialchars($busqueda); ?>" onkeyup="filtrarTiendas(this.value)">
    </div>
    <!-- Add Button -->
    <div style="display: flex; gap: 10px; margin-bottom: 1.5rem;" class="animate-in delay-1">
        <button class="add-button" style="margin-bottom: 0; flex: 1;" onclick="abrirModalRegistro('normal')"><i class="fa-solid fa-plus"></i>Tienda Normal</button>
        <button class="add-button" style="margin-bottom: 0; flex: 1; background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); box-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);" onclick="abrirModalRegistro('rapida')"><i class="fa-solid fa-bolt"></i>Tienda Rápida</button>
    </div>
    <!-- Store List -->
    <div class="store-list" id="storeList">
        <?php if ($total_tiendas_pagina > 0 && $resultado_tiendas): ?>
            <?php while ($tienda = mysqli_fetch_assoc($resultado_tiendas)): 
                $tiene_firma = !empty($tienda['url_firma_electronica']);
                $tiene_gps = !empty($tienda['ubicacion_gps_tienda']);
                $cod_tienda_cryp = DAXCODIFCRYPTOR::encriptardax(DAXCODIFCRYPTOR::encodifdax($tienda['cod_tienda']));
                
                // Consultar vendedores de esta tienda (desde tbl15_administrador)
                $cod_aliado_tienda = $tienda['cod_aliado_estrategico'];
                $sql_vendedores_tienda = "SELECT cod_administrador, nombres_apellidos_tercero, identificacion_tercero, telefono1_tercero FROM tbl15_administrador 
                WHERE cod_seguridad = '2' AND cod_aliado_estrategico = '$cod_aliado_tienda' AND cod_estado_activacion_usuario = '1' ORDER BY nombres_apellidos_tercero ASC";
                $res_vendedores_tienda = mysqli_query($conectar, $sql_vendedores_tienda);
                $total_vendedores_tienda = $res_vendedores_tienda ? mysqli_num_rows($res_vendedores_tienda) : 0;

                // Contar productos de esta tienda
                $cod_tienda_actual = $tienda['cod_tienda'];
                $sql_total_prod = "SELECT COUNT(*) as total FROM tbl15_producto WHERE cod_tienda = '$cod_tienda_actual'";
                $consulta_total_prod = mysqli_query($conectar, $sql_total_prod);
                $datos_total_prod = mysqli_fetch_assoc($consulta_total_prod);
                $total_productos_tienda = $datos_total_prod['total'];
            ?>
            <div class="store-card animate-in delay-2">
                <div class="store-card-header">
                    <div class="store-info" style="min-width: 0; flex: 1;">
                        <div class="store-name" style="word-break: break-word; line-height: 1.3; font-size: 1.05rem;"><?php echo ucwords(strtolower($tienda['nombre_tienda'])); ?></div>
                        <div class="store-nit" style="font-size: 0.75rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                            <span>NIT: <?php echo $tienda['identificacion_tercero']; ?></span>
                            <?php if(!empty($tienda['fecha_creacion'])): ?>
                            <span style="color: rgba(255,255,255,0.3);">|</span>
                            <span><i class="fa-solid fa-calendar-day" style="color: #8b5cf6; font-size: 0.7rem;"></i> <?php echo date('d/m/Y', strtotime($tienda['fecha_creacion'])); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 5px;">
                        <span class="store-status <?php echo $tiene_firma ? 'active' : 'pending'; ?>"><?php echo $tiene_firma ? 'Firmado' : 'Pendiente'; ?></span>
                        <?php if (isset($tienda['cod_estado_firma_signature']) && $tienda['cod_estado_firma_signature'] == '1'): ?>
                            <i class="fa-solid fa-circle-check" style="color: #34d399; font-size: 1.2rem;" title="Firma Verificada"></i>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="store-details">
                    <div class="store-detail"><i class="fa-solid fa-handshake"></i><span>Aliado: <?php echo !empty($tienda['nombre_aliado']) ? ucwords(strtolower($tienda['nombre_aliado'])) : 'Sin asignar'; ?></span></div>
                    <div class="store-detail"><i class="fa-solid fa-user"></i><span><?php echo ucwords(strtolower($tienda['nombre1_tercero'])); ?></span></div>
                    <div class="store-detail"><i class="fa-solid fa-phone"></i><span><?php echo $tienda['telefono1_tercero']; ?></span></div>
                    <div class="store-detail"><i class="fa-solid fa-envelope"></i><span><?php echo strtolower($tienda['correo_tercero']); ?></span></div>
                    <div class="store-detail"><i class="fa-solid fa-credit-card"></i><span><?php echo $tienda['creditos_activos']; ?> créditos activos</span></div>
                </div>

                <!-- Estadísticas y Botones de Acción Rápida -->
                <div class="store-stats">
                    <div class="store-stat-item">
                        <span class="store-stat-number"><?php echo $total_productos_tienda; ?></span>
                        <span class="store-stat-label">Productos</span>
                    </div>
                    <div class="store-stat-item">
                        <span class="store-stat-number"><?php echo $total_vendedores_tienda; ?></span>
                        <span class="store-stat-label">Vendedores</span>
                    </div>
                    <div class="store-stat-item">
                        <span class="store-stat-number"><?php echo $tienda['creditos_activos']; ?></span>
                        <span class="store-stat-label">Créditos</span>
                    </div>
                </div>

                <div class="store-quick-actions">
                    <button type="button" class="btn-quick-action btn-vendedor" onclick="abrirRegistroVendedorDirecto(<?php echo $tienda['cod_tienda']; ?>, '<?php echo addslashes($tienda['nombre_tienda']); ?>')">
                        <i class="fa-solid fa-user-plus"></i> Vendedor
                    </button>
                    <button type="button" class="btn-quick-action btn-producto" onclick="abrirRegistroProductoDirecto(<?php echo $tienda['cod_tienda']; ?>, '<?php echo addslashes($tienda['nombre_tienda']); ?>')">
                        <i class="fa-solid fa-box-open"></i> Producto
                    </button>
                </div>

                <div class="store-actions">
                    <button class="action-btn primary" onclick="editarTienda(<?php echo $tienda['cod_tienda']; ?>)"><i class="fa-solid fa-edit"></i> Editar</button>
                    <button class="action-btn secondary" 
                        data-cod="<?php echo htmlspecialchars($cod_tienda_cryp, ENT_QUOTES); ?>"
                        data-nombre="<?php echo htmlspecialchars($tienda['nombre_tienda'], ENT_QUOTES); ?>"
                        data-estado="<?php echo isset($tienda['cod_estado_firma_signature']) ? htmlspecialchars($tienda['cod_estado_firma_signature'], ENT_QUOTES) : '0'; ?>"
                        data-url="<?php echo isset($tienda['url_firma_electronica']) ? htmlspecialchars($tienda['url_firma_electronica'], ENT_QUOTES) : ''; ?>"
                        onclick="abrirModalRevisionFirma(this.getAttribute('data-cod'), this.getAttribute('data-nombre'), this.getAttribute('data-estado'), this.getAttribute('data-url'))">
                        <i class="fa-solid fa-signature"></i> Firma
                    </button>
                    <button class="action-btn <?php echo $tiene_gps ? 'info' : 'secondary'; ?>" 
                        data-cod="<?php echo htmlspecialchars($cod_tienda_cryp, ENT_QUOTES); ?>"
                        data-nombre="<?php echo htmlspecialchars($tienda['nombre_tienda'], ENT_QUOTES); ?>"
                        data-gps="<?php echo isset($tienda['ubicacion_gps_tienda']) ? htmlspecialchars($tienda['ubicacion_gps_tienda'], ENT_QUOTES) : ''; ?>"
                        onclick="abrirModalRevisionGPS(this.getAttribute('data-cod'), this.getAttribute('data-nombre'), this.getAttribute('data-gps'))">
                        <i class="fa-solid fa-map-marker-alt"></i> GPS
                    </button>
                    <!--
                    <button class="action-btn" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);" onclick="abrirModalAgregarBanco(<?php echo $tienda['cod_tienda']; ?>, '<?php echo htmlspecialchars($tienda['nombre_tienda'], ENT_QUOTES); ?>')">
                        <i class="fa-solid fa-university"></i> Banco
                    </button>
                    <button class="action-btn" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);" onclick="abrirModalAgregarVendedor(<?php echo $tienda['cod_tienda']; ?>, '<?php echo htmlspecialchars($tienda['nombre_tienda'], ENT_QUOTES); ?>')">
                        <i class="fa-solid fa-user-plus"></i> Vendedor
                    </button>
                    -->
                    <button class="action-btn info" onclick="verDetalles(<?php echo $tienda['cod_tienda']; ?>)"><i class="fa-solid fa-eye"></i> Ver</button>
                    <button class="action-btn archive" onclick="archivarTienda(<?php echo $tienda['cod_tienda']; ?>, '<?php echo addslashes($tienda['nombre_tienda']); ?>')">
                        <i class="fa-solid fa-box-archive"></i> Archivar
                    </button>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state animate-in delay-2">
                <i class="fa-solid fa-store-slash" style="font-size: 3rem; color: rgba(139, 92, 246, 0.3); display: block; margin-bottom: 1rem;"></i>
                <h3 style="color: white; margin-bottom: 0.5rem;">No se encontraron tiendas</h3>
                <p style="color: rgba(255,255,255,0.5);">No hay tiendas registradas que coincidan con tu búsqueda.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_paginas > 1): ?>
    <div class="pagination-container animate-in delay-2">
        <a href="?pagina=1&busqueda=<?php echo urlencode($busqueda); ?>" 
           class="pagination-btn <?php echo $pagina == 1 ? 'disabled' : ''; ?>" title="Primera página">
            <i class="fa-solid fa-angles-left"></i>
        </a>
        <a href="?pagina=<?php echo max(1, $pagina - 1); ?>&busqueda=<?php echo urlencode($busqueda); ?>" 
           class="pagination-btn <?php echo $pagina == 1 ? 'disabled' : ''; ?>">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        
        <?php 
        $rango = 2;
        $inicio_p = max(1, $pagina - $rango);
        $fin_p = min($total_paginas, $pagina + $rango);
        
        for ($i = $inicio_p; $i <= $fin_p; $i++): 
        ?>
        <a href="?pagina=<?php echo $i; ?>&busqueda=<?php echo urlencode($busqueda); ?>" 
           class="pagination-btn <?php echo $pagina == $i ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
        <?php endfor; ?>

        <a href="?pagina=<?php echo min($total_paginas, $pagina + 1); ?>&busqueda=<?php echo urlencode($busqueda); ?>" 
           class="pagination-btn <?php echo $pagina == $total_paginas ? 'disabled' : ''; ?>">
            <i class="fa-solid fa-angle-right"></i>
        </a>
        <a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo urlencode($busqueda); ?>" 
           class="pagination-btn <?php echo $pagina == $total_paginas ? 'disabled' : ''; ?>" title="Última página">
            <i class="fa-solid fa-angles-right"></i>
        </a>
    </div>
    <?php endif; ?>
</main>

<!-- Modal Registro -->
<div class="modal-overlay" id="modalRegistro" style="align-items: center; padding: 20px;">
    <div class="modal-content">
        <div class="modal-header"><h2><i class="fa-solid fa-store" id="iconModalTienda"></i> <span id="tituloModalTienda">Nueva Tienda</span></h2><button class="modal-close" onclick="cerrarModal()"><i class="fa-solid fa-times"></i></button></div>
        
        <div class="modal-body">
            <form id="formRegistroTienda" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                <input type="hidden" id="accion" name="accion" value="registrar">
                <input type="hidden" id="cod_tienda_edit" name="cod_tienda_edit" value="">
                <input type="hidden" id="tipo_tienda_actual" name="tipo_tienda" value="normal">

                <!-- Sección: Información Básica -->
                <div class="form-section-title"><i class="fa-solid fa-info-circle"></i> Información Básica</div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombre de la Tienda *</label>
                        <input type="text" class="form-input" name="nombre1_tercero" id="nombre1_tercero" placeholder="Ej: Tienda El Éxito" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-input" name="correo_tercero" id="correo_tercero" placeholder="Ej: tienda@ejemplo.com">
                    </div>
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
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Departamento *</label>
                        <select class="form-select" name="cod_departamento" id="cod_departamento" onchange="cargarMunicipiosRegistro()" required>
                            <option value="">Seleccione un departamento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Municipio *</label>
                        <select class="form-select" name="cod_municipio" id="cod_municipio" required>
                            <option value="">Seleccione primero un departamento</option>
                        </select>
                    </div>
                </div>
                
                 <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Dirección *</label>
                        <input type="text" class="form-input" name="direccion_tercero" id="direccion_tercero" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Barrio</label>
                        <input type="text" class="form-input" name="barrio_tercero" id="barrio_tercero" placeholder="Ej: Centro, Santa Isabel...">
                    </div>
                </div>

                <!-- Sección 2: Representante Legal -->
                <div class="form-section-title"><i class="fa-solid fa-user-tie"></i> Representante Legal</div>
                
                <div class="form-group">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" class="form-input" name="nombre_representante" id="nombre_representante">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">NIT / Documento</label>
                        <input type="number" class="form-input" name="documento_representante" id="documento_representante">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-input" name="correo_representante" id="correo_representante">
                    </div>
                </div>

                <!-- Sección: Información del Negocio -->
                <div class="form-section-title"><i class="fa-solid fa-briefcase"></i> Información del Negocio</div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo de Sector</label>
                        <select class="form-select" name="cod_tipo_sector" id="cod_tipo_sector">
                            <option value="">-- Seleccione --</option>
                            <?php 
                            if (isset($res_tipo_sector)) { mysqli_data_seek($res_tipo_sector, 0); }
                            while ($tipo_sector = mysqli_fetch_assoc($res_tipo_sector)): ?>
                            <option value="<?php echo $tipo_sector['cod_tipo_sector']; ?>" title="<?php echo htmlspecialchars($tipo_sector['descripcion_tipo_sector']); ?>"><?php echo $tipo_sector['nombre_tipo_sector']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">¿Existe en RUES?</label>
                        <select class="form-select" name="existe_rues" id="existe_rues">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">¿Venta Presencial?</label>
                        <select class="form-select" name="venta_presencial" id="venta_presencial">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">¿Venta Online?</label>
                        <select class="form-select" name="venta_online" id="venta_online">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Plataforma E-commerce</label>
                        <input type="text" class="form-input" name="nombre_plataforma_ecommerce" id="nombre_plataforma_ecommerce" placeholder="Ej: Shopify, WooCommerce...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sistema Contable</label>
                        <input type="text" class="form-input" name="nombre_sistema_contable" id="nombre_sistema_contable" placeholder="Ej: Siigo, World Office, Alegra...">
                    </div>
                </div>

                <!-- Sección 3: Información Financiera (Desactivada por solicitud) -->
                <!--
                <div class="form-section-title"><i class="fa-solid fa-dollar-sign"></i> Información Financiera</div>
                <div class="form-group">
                    <label class="form-label">Banco</label>
                    <select class="form-select" name="cod_banco_cuenta" id="cod_banco_cuenta" disabled>
                        <option value="">Seleccione Aliado primero</option>
                    </select>
                    <div id="loading_bancos" style="display:none; color: #8b5cf6; font-size: 0.8rem; margin-top: 5px;">Cargando bancos...</div>
                </div>
                -->

                <!-- Sección 4: Ubicación GPS -->
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
                
                <!-- Sección: Jerarquía de Gestión -->
                <div class="form-section-title" id="sectionJerarquia"><i class="fa-solid fa-users"></i> Jerarquía de Gestión</div>
                
                <div id="containerJerarquia">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Líder / Director *</label>
                            <select class="form-select select2-simple" name="cod_lider" id="cod_lider" required>
                                <option value="">Seleccione Líder</option>
                                <?php 
                                if ($resultado_lideres) {
                                    mysqli_data_seek($resultado_lideres, 0);
                                    while ($lider = mysqli_fetch_assoc($resultado_lideres)): ?>
                                    <option value="<?php echo $lider['cod_administrador']; ?>"><?php echo ucwords(strtolower($lider['nombres_apellidos_tercero'])); ?></option>
                                <?php endwhile; } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Coordinador *</label>
                            <select class="form-select select2-simple" name="cod_coordinador" id="cod_coordinador" required>
                                <option value="">Seleccione Coordinador</option>
                                <?php 
                                if ($resultado_coordinadores) {
                                    mysqli_data_seek($resultado_coordinadores, 0);
                                    while ($coord = mysqli_fetch_assoc($resultado_coordinadores)): ?>
                                    <option value="<?php echo $coord['cod_administrador']; ?>"><?php echo ucwords(strtolower($coord['nombres_apellidos_tercero'])); ?></option>
                                <?php endwhile; } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Asesor *</label>
                            <select class="form-select select2-simple" name="cod_asesor" id="cod_asesor" required>
                                <option value="">Seleccione Asesor</option>
                                <?php 
                                if ($resultado_asesores) {
                                    mysqli_data_seek($resultado_asesores, 0);
                                    while ($asesor = mysqli_fetch_assoc($resultado_asesores)): ?>
                                    <option value="<?php echo $asesor['cod_administrador']; ?>"><?php echo ucwords(strtolower($asesor['nombres_apellidos_tercero'])); ?></option>
                                <?php endwhile; } ?>
                            </select>
                        </div>
                        <div class="form-group" id="containerAliado">
                            <label class="form-label">Aliado Estratégico *</label>
                            <select class="form-select select2-simple" name="cod_aliado_estrategico" id="cod_aliado_estrategico" onchange="actualizarBancosYComision(this)" required>
                                <option value="">Seleccione Aliado</option>
                                <?php 
                                if ($resultado_aliados) {
                                    mysqli_data_seek($resultado_aliados, 0);
                                    while ($aliado = mysqli_fetch_assoc($resultado_aliados)): ?>
                                    <option value="<?php echo $aliado['cod_administrador']; ?>" data-comision="<?php echo $aliado['comision_ptj']; ?>">
                                        <?php echo $aliado['nombres_apellidos_tercero'].' ('.$aliado['cedula'].')'; ?>
                                    </option>
                                <?php endwhile; } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Sección 5: Documentación Legal -->
                <div class="form-section-title"><i class="fa-solid fa-file-contract"></i> Documentación Legal</div>
                
                <div class="form-group">
                    <label class="form-label">RUT (PDF/Imagen)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="url_rut_tienda" id="url_rut_tienda" accept=".pdf,.jpg,.jpeg,.png" onchange="updateFileName(this)">
                        <div class="file-input-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="file-input-text">Seleccionar archivo</div>
                    </div>
                    <div id="preview_rut" class="document-preview" style="display: none;"></div>
                </div>

                 <div class="form-group">
                    <label class="form-label">Cámara de Comercio (PDF/Imagen)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="url_camara_comercio_tienda" id="url_camara_comercio_tienda" accept=".pdf,.jpg,.jpeg,.png" onchange="updateFileName(this)">
                        <div class="file-input-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="file-input-text">Seleccionar archivo</div>
                    </div>
                    <div id="preview_camara" class="document-preview" style="display: none;"></div>
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

                <button type="button" class="submit-btn" onclick="ejecutarRegistroTienda()">
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
                <div style="background: linear-gradient(135deg, rgba(139, 92, 246,0.2), rgba(79, 70, 229,0.2)); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                    <i class="fa-solid fa-check-circle" style="font-size: 2.5rem; color: #8b5cf6;"></i>
                    <h3 style="color: #8b5cf6; margin: 0.5rem 0;">¡Tienda Registrada!</h3>
                    <p style="color: rgba(255,255,255,0.7); margin: 0;" id="firma_tienda_nombre_display"></p>
                </div>
                <p style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Ahora comparta el enlace de firma con su cliente para completar el proceso.</p>
            </div>
            
            <div class="form-group">
                <label class="form-label">Correo del Cliente</label>
                <input type="email" class="form-input" id="firma_correo" placeholder="correo@ejemplo.com">
                <small style="color: rgba(255,255,255,0.5); font-size: 0.75rem; margin-top: 0.25rem; display: block;">
                    <i class="fa-solid fa-info-circle"></i> Se enviará un correo profesional con el enlace de firma
                </small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Teléfono del Cliente</label>
                <input type="tel" class="form-input" id="firma_telefono" placeholder="3001234567">
            </div>
            
            <div class="form-group">
                <label class="form-label">Enlace de Firma</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" class="form-input" id="firma_enlace" readonly style="flex: 1;">
                    <button type="button" onclick="copiarEnlaceFirma()" style="background: #8b5cf6; color: white; border: none; padding: 0.85rem 1rem; border-radius: 12px; cursor: pointer;">
                        <i class="fa-solid fa-copy"></i>
                    </button>
                </div>
            </div>
            
            <div style="display: flex; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" onclick="enviarPorWhatsApp()" style="flex: 1; background: #25d366; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                </button>
                <button type="button" onclick="enviarPorCorreo()" style="flex: 1; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);">
                    <i class="fa-solid fa-envelope"></i> Email
                </button>
            </div>
            
            <button type="button" onclick="cerrarModalFirmaYRecargar()" class="submit-btn" style="margin-top: 1rem; background: rgba(255,255,255,0.1);">
                <i class="fa-solid fa-check"></i> Finalizar y Cerrar
            </button>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Cargar departamentos en el modal de registro
function cargarDepartamentosRegistro() {
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            if (response.success) {
                var select = $('#cod_departamento');
                select.empty();
                select.append('<option value="">Seleccione un departamento *</option>');
                $.each(response.departamentos, function(index, dept) {
                    select.append('<option value="' + dept.cod_departamento + '">' +
                                dept.nombre_departamento + '</option>');
                });
            } else {
                console.error('Error al cargar departamentos:', response.mensaje);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX al cargar departamentos:', status, error);
        }
    });
}
// Cargar municipios cuando se selecciona un departamento en el modal de registro
function cargarMunicipiosRegistro() {
    var codDepartamento = $('#cod_departamento').val();
    var selectMuni = $('#cod_municipio');
    selectMuni.empty();
    selectMuni.append('<option value="">Seleccione un municipio *</option>');
    
    if (!codDepartamento) { return; }
    
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php', type: 'GET', data: { cod_departamento: codDepartamento }, dataType: 'json',
        success: function(response) {
            if (response.success) {
                $.each(response.municipios, function(index, muni) { selectMuni.append('<option value="' + muni.cod_municipio + '">' + muni.nombre_municipio + '</option>'); });
            }
        },
        error: function() {
            console.error('Error al cargar municipios');  }
    });
}
// Cargar municipios con preselección
function cargarMunicipiosRegistroConPreseleccion(codDepartamento, selectedMuni) {
    var selectMuni = $('#cod_municipio');
    selectMuni.empty();
    selectMuni.append('<option value="">Seleccione un municipio *</option>');
    if (!codDepartamento) return;
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php', type: 'GET', data: { cod_departamento: codDepartamento }, dataType: 'json',
        success: function(response) {
            if (response.success) {
                $.each(response.municipios, function(index, muni) {
                    var isSelected = (selectedMuni && muni.cod_municipio == selectedMuni) ? ' selected' : '';
                    selectMuni.append('<option value="' + muni.cod_municipio + '"' + isSelected + '>' + muni.nombre_municipio + '</option>');
                });
            }
        }
    });
}
// ====================== REGISTRO DE VENDEDORES (GEOLOCALIZACION) ======================
function cargarDepartamentosVendedor(prefix) {
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            if (response.success) {
                var select = $('#' + prefix + 'cod_departamento');
                select.empty();
                select.append('<option value="">Seleccione Departamento *</option>');
                $.each(response.departamentos, function(index, dept) { select.append('<option value="' + dept.cod_departamento + '">' + dept.nombre_departamento + '</option>'); });
            }
        }
    });
}
function cargarMunicipiosVendedor(prefix) {
    var codDepartamento = $('#' + prefix + 'cod_departamento').val();
    var selectMuni = $('#' + prefix + 'cod_municipio');
    selectMuni.empty();
    selectMuni.append('<option value="">Seleccione un municipio *</option>');
    if (!codDepartamento) return;
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php', type: 'GET', data: { cod_departamento: codDepartamento }, dataType: 'json',
        success: function(response) {
            if (response.success) {
                $.each(response.municipios, function(index, muni) { selectMuni.append('<option value="' + muni.cod_municipio + '">' + muni.nombre_municipio + '</option>'); });
            }
        }
    });
}
function abrirModalRegistro(tipo) {
    const form = document.getElementById('formRegistroTienda');
    form.reset();
    
    const containerAliado = document.getElementById('containerAliado');
    const selectAliado = document.getElementById('cod_aliado_estrategico');
    const sectionJerarquia = document.getElementById('sectionJerarquia');
    const containerJerarquia = document.getElementById('containerJerarquia');
    const tituloModal = document.getElementById('tituloModalTienda');
    const iconModal = document.getElementById('iconModalTienda');
    const tipoTiendaInput = document.getElementById('tipo_tienda_actual');
    
    // Al abrir como registro nuevo, restauramos required por si venía de edición
    const camposOpcionales = [
        { id: 'identificacion_tercero', label: 'NIT / Documento' },
        { id: 'telefono1_tercero', label: 'Teléfono' },
        { id: 'cod_departamento', label: 'Departamento' },
        { id: 'cod_municipio', label: 'Municipio' }
    ];

    // Habilitar campos y mostrar botón por si vienen desactivados de "Ver Detalles"
    Array.from(form.elements).forEach(ele => ele.disabled = false);
    document.querySelector('.submit-btn').style.display = 'block';
    document.getElementById('accion').value = 'registrar';
    document.getElementById('cod_tienda_edit').value = '';

    if (tipo === 'rapida') {
        tipoTiendaInput.value = 'rapida';
        containerJerarquia.style.display = 'block';
        sectionJerarquia.style.display = 'block';
        selectAliado.removeAttribute('required');
        selectAliado.value = '0';
        
        // Quitar required y asteriscos
        camposOpcionales.forEach(item => {
            const el = document.getElementById(item.id);
            if (el) {
                el.removeAttribute('required');
                const label = el.closest('.form-group').querySelector('.form-label');
                if (label) label.innerHTML = item.label;
            }
        });
        
        tituloModal.innerText = 'Nueva Tienda Rápida';
        iconModal.className = 'fa-solid fa-bolt';
        document.querySelector('.submit-btn').innerHTML = '<i class="fa-solid fa-bolt"></i> Registrar Tienda Rápida';
        document.querySelector('.submit-btn').style.background = 'linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%)';
    } else {
        tipoTiendaInput.value = 'normal';
        containerJerarquia.style.display = 'block';
        sectionJerarquia.style.display = 'block';
        selectAliado.setAttribute('required', 'required');
        
        // Restaurar required y asteriscos
        camposOpcionales.forEach(item => {
            const el = document.getElementById(item.id);
            if (el) {
                el.setAttribute('required', 'required');
                const label = el.closest('.form-group').querySelector('.form-label');
                if (label) label.innerHTML = item.label + ' *';
            }
        });

        tituloModal.innerText = 'Nueva Tienda';
        iconModal.className = 'fa-solid fa-store';
        document.querySelector('.submit-btn').innerHTML = '<i class="fa-solid fa-save"></i> Registrar Tienda Completa';
        document.querySelector('.submit-btn').style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
    }

    // Limpiar previsualizaciones
    document.querySelectorAll('.image-preview').forEach(el => { el.src = ''; el.style.display = 'none'; });
    
    // Cargar departamentos
    cargarDepartamentosRegistro();
    document.getElementById('modalRegistro').classList.add('show');
    
    // Inicializar Select2
    $('.select2-simple').select2({
        dropdownParent: $('#modalRegistro'),
        width: '100%'
    });
}

function cerrarModal() { document.getElementById('modalRegistro').classList.remove('show'); }
// Cargar bancos al seleccionar aliado
function actualizarBancosYComision(select) {
    if (!select) return;
    var codAliado = select.value;
    // Cargar bancos
    var bancoSelect = document.getElementById('cod_banco_cuenta');
    var loading = document.getElementById('loading_bancos');
    
    // Si no existen los elementos en el DOM, no hacemos nada (evita errores)
    if (!bancoSelect || !loading) return;

    if (codAliado) {
        bancoSelect.disabled = true;
        loading.style.display = 'block';
        
        // Pre-llenar datos del aliado
        prellenarDatosAliado(codAliado);
        
        $.ajax({
            url: 'obtener_bancos_cuenta_por_aliado_ajax.php', type: 'POST', data: { cod_aliado_estrategico: codAliado }, dataType: 'json',
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
                // Actualizar comisión desde respuesta si existe
                if (response.comision_ptj) { 
                    var comisionInput = document.getElementById('comision_ptj');
                    if (comisionInput) comisionInput.value = response.comision_ptj; 
                }
                bancoSelect.disabled = false;
                loading.style.display = 'none';
            },
            error: function() {
                loading.style.display = 'none';
                bancoSelect.innerHTML = '<option value="">-- Error al cargar bancos --</option>';
                bancoSelect.disabled = false;
                Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudieron cargar los bancos', background: '#1a1f2e', color: 'white' });
            }
        });
    } else {
        bancoSelect.innerHTML = '<option value="">Seleccione Aliado primero</option>';
        bancoSelect.disabled = true;
    }
}

// Pre-llenar campos del formulario con datos del aliado seleccionado
function prellenarDatosAliado(codAliado) {
    if (!codAliado) return;
    $.ajax({
        url: 'obtener_datos_aliado_ajax.php', type: 'POST', data: { cod_aliado: codAliado }, dataType: 'json',
        success: function(response) {
            if (response.success && response.aliado) {
                var a = response.aliado;
                var setVal = function(id, val) { var el = document.getElementById(id); if (el && val) el.value = val; };
                setVal('identificacion_tercero', a.identificacion_tercero);
                setVal('telefono1_tercero', a.telefono1_tercero);
                setVal('correo_tercero', a.correo_tercero);
                setVal('direccion_tercero', a.direccion_tercero);
                setVal('barrio_tercero', a.barrio_tercero);
                setVal('cod_tipo_sector', a.cod_tipo_sector);
                if (a.cod_departamento) {
                    $('#cod_departamento').val(a.cod_departamento).trigger('change');
                    setTimeout(function() { cargarMunicipiosRegistroConPreseleccion(a.cod_departamento, a.cod_municipio); }, 500);
                }
            }
        }
    });
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
            
            status.style.background = 'rgba(139, 92, 246, 0.2)';
            status.style.color = '#8b5cf6';
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
        // Find the sibling .file-input-text and update it
        var wrapper = input.parentElement;
        var textElement = wrapper.querySelector('.file-input-text');
        if (textElement) {
            textElement.textContent = fileName;
            textElement.style.color = '#8b5cf6';
            textElement.style.fontWeight = 'bold';
        }
    }
}
function filtrarTiendas(busqueda) { 
    clearTimeout(window.searchTimeout); 
    window.searchTimeout = setTimeout(function() { 
        const urlParams = new URLSearchParams(window.location.search);
        const cod_coordinador = urlParams.get('cod_coordinador') || '';
        window.location.href = 'lista_tienda_lider_movil.php?busqueda=' + encodeURIComponent(busqueda) + '&cod_coordinador=' + encodeURIComponent(cod_coordinador); 
    }, 500); 
}

function editarTienda(codTienda) {
    Swal.fire({ title: 'Cargando...', didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white' });
    
    $.ajax({
        url: 'get_tienda_modal_lider_ajax.php', type: 'POST', data: { cod_tienda: codTienda }, dataType: 'json',
        success: function(response) {
            Swal.close();
            if(response.success) {
                const t = response.tienda;
                const form = document.getElementById('formRegistroTienda');
                form.reset();
                Array.from(form.elements).forEach(ele => ele.disabled = false);
                document.querySelector('.submit-btn').style.display = 'block';
                document.getElementById('accion').value = 'editar';
                document.getElementById('cod_tienda_edit').value = t.cod_tienda;
                // nombre_tienda va al campo nombre1_tercero del form
                document.getElementById('nombre1_tercero').value = t.nombre_tienda || t.nombre1_tercero || '';
                document.getElementById('identificacion_tercero').value = t.identificacion_tercero || '';
                document.getElementById('nombre_representante').value = t.nombre_representante || t.nombre1_tercero || '';
                document.getElementById('documento_representante').value = t.documento_representante || '';
                document.getElementById('telefono1_tercero').value = t.telefono1_tercero;
                document.getElementById('direccion_tercero').value = t.direccion_tercero;
                document.getElementById('barrio_tercero').value = t.barrio_tercero || '';
                document.getElementById('correo_tercero').value = t.correo_tercero;
                document.getElementById('cod_aliado_estrategico').value = t.cod_aliado_estrategico || '';
                document.getElementById('cod_lider').value = t.cod_lider || '';
                document.getElementById('cod_coordinador').value = t.cod_coordinador || '';
                document.getElementById('cod_asesor').value = t.cod_asesor || '';
                
                // Nuevos campos de información del negocio
                if (document.getElementById('cod_tipo_sector')) document.getElementById('cod_tipo_sector').value = t.cod_tipo_sector || '';
                if (document.getElementById('existe_rues')) document.getElementById('existe_rues').value = t.existe_rues || '';
                if (document.getElementById('venta_presencial')) document.getElementById('venta_presencial').value = t.venta_presencial || '';
                if (document.getElementById('venta_online')) document.getElementById('venta_online').value = t.venta_online || '';
                if (document.getElementById('nombre_plataforma_ecommerce')) document.getElementById('nombre_plataforma_ecommerce').value = t.nombre_plataforma_ecommerce || '';
                if (document.getElementById('nombre_sistema_contable')) document.getElementById('nombre_sistema_contable').value = t.nombre_sistema_contable || '';
                
                // Actualizar Select2 para mostrar los valores seleccionados
                $('.select2-simple').trigger('change');
                
                document.getElementById('ubicacion_gps_tienda').value = t.ubicacion_gps_tienda;
                
                // Cargar departamentos y luego municipios con valores guardados
                cargarDepartamentosRegistro();
                setTimeout(() => {
                    if (t.cod_departamento) {
                        $('#cod_departamento').val(t.cod_departamento);
                        cargarMunicipiosRegistro();
                        setTimeout(() => { if (t.cod_municipio) { $('#cod_municipio').val(t.cod_municipio); } }, 500);
                    }
                }, 500);
                // Cargar bancos (simulado manualmente ya que es dependiente)
                actualizarBancosYComision(document.getElementById('cod_aliado_estrategico'));
                setTimeout(() => { if(document.getElementById('cod_banco_cuenta')) { document.getElementById('cod_banco_cuenta').value = t.cod_banco_cuenta; } }, 1000);
                
                // ========== MOSTRAR DOCUMENTOS E IMÁGENES EXISTENTES ==========
                mostrarDocumentosCargados(t);
                mostrarImagenesCargadas(t);
                
                document.querySelector('.modal-header h2').innerHTML = '<i class="fa-solid fa-edit"></i> Editar Tienda';
                document.querySelector('.submit-btn').innerHTML = '<i class="fa-solid fa-save"></i> Guardar Cambios';
                document.getElementById('modalRegistro').classList.add('show');
            } else {
                Swal.fire({ icon:'error', title:'Error', text:response.message, background:'#1a1f2e', color:'white' });
            }
        },
        error: function() {
             Swal.fire({ icon:'error', title:'Error', text:'No se pudo obtener la información', background:'#1a1f2e', color:'white' });
        }
    });
}

function verDetalles(codTienda) {
    // Redirigir a la página de detalles de tienda
    window.location.href = 'ver_detalle_tienda_movil.php?cod_tienda=' + codTienda;
}

// Función para mostrar documentos cargados
function mostrarDocumentosCargados(tienda) {
    // Limpiar textos previos de documentos y previsualizaciones
    document.querySelectorAll('.file-input-text').forEach(el => el.textContent = 'Seleccionar archivo');
    document.querySelectorAll('.document-preview').forEach(el => { el.innerHTML = ''; el.style.display = 'none'; });
    
    // RUT
    if (tienda.url_documentacion_rut_tienda && tienda.url_documentacion_rut_tienda.trim() !== '') {
        const rutWrapper = document.querySelector('#url_rut_tienda').closest('.file-input-wrapper');
        const rutText = rutWrapper.querySelector('.file-input-text');
        rutText.innerHTML = '<i class="fa-solid fa-check-circle" style="color: #8b5cf6;"></i> Documento cargado';
        
        // Mostrar previsualización
        const previewRut = document.getElementById('preview_rut');
        mostrarPreviewDocumento(tienda.url_documentacion_rut_tienda, previewRut, 'RUT');
    }
    
    // Cámara de Comercio
    if (tienda.url_documentacion_camaracomercio_tienda && tienda.url_documentacion_camaracomercio_tienda.trim() !== '') {
        const camaraWrapper = document.querySelector('#url_camara_comercio_tienda').closest('.file-input-wrapper');
        const camaraText = camaraWrapper.querySelector('.file-input-text');
        camaraText.innerHTML = '<i class="fa-solid fa-check-circle" style="color: #8b5cf6;"></i> Documento cargado';
        
        // Mostrar previsualización
        const previewCamara = document.getElementById('preview_camara');
        mostrarPreviewDocumento(tienda.url_documentacion_camaracomercio_tienda, previewCamara, 'Cámara de Comercio');
    }
}

// Función para mostrar previsualización de documentos (PDF o imagen)
function mostrarPreviewDocumento(url, contenedor, titulo) {
    if (!url || !contenedor) return;
    
    console.log('Mostrando preview de:', url);
    
    const extension = url.split('.').pop().toLowerCase();
    const esPDF = extension === 'pdf';
    const esImagen = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension);
    
    // Limpiar contenedor
    contenedor.innerHTML = '';
    
    // Crear encabezado
    const header = document.createElement('div');
    header.className = 'document-preview-header';
    
    const titleDiv = document.createElement('div');
    titleDiv.className = 'document-preview-title';
    titleDiv.innerHTML = `<i class="fa-solid fa-${esPDF ? 'file-pdf' : 'image'}"></i> ${titulo}`;
    
    const actionsDiv = document.createElement('div');
    actionsDiv.className = 'document-preview-actions';
    
    // Botón Abrir
    const btnAbrir = document.createElement('button');
    btnAbrir.type = 'button';
    btnAbrir.className = '';
    btnAbrir.innerHTML = '';
    //btnAbrir.className = 'document-preview-btn';
    //btnAbrir.innerHTML = '<i class="fa-solid fa-external-link-alt"></i> Abrir';
    btnAbrir.onclick = function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Abriendo:', url);
        window.open(url, '_blank');
        return false;
    };
    
    // Botón Descargar
    const btnDescargar = document.createElement('button');
    btnDescargar.type = 'button';
    btnDescargar.className = '';
    btnDescargar.innerHTML = '';
    //btnDescargar.className = 'document-preview-btn';
    //btnDescargar.innerHTML = '<i class="fa-solid fa-download"></i> Descargar';
    btnDescargar.onclick = function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Descargando:', url);
        const a = document.createElement('a');
        a.href = url;
        a.download = '';
        a.target = '_blank';
        a.click();
        return false;
    };
    
    actionsDiv.appendChild(btnAbrir);
    actionsDiv.appendChild(btnDescargar);
    header.appendChild(titleDiv);
    header.appendChild(actionsDiv);
    contenedor.appendChild(header);
    
    // Agregar previsualización según tipo
    if (esPDF) {
        const embed = document.createElement('embed');
        embed.src = url;
        embed.type = 'application/pdf';
        contenedor.appendChild(embed);
    } else if (esImagen) {
        const img = document.createElement('img');
        img.src = url;
        img.alt = titulo;
        img.style.cursor = 'pointer';
        img.onclick = function() {
            console.log('Clic en imagen:', url);
            window.open(url, '_blank');
        };
        contenedor.appendChild(img);
    } else {
        const mensaje = document.createElement('p');
        mensaje.style.cssText = 'color: rgba(255,255,255,0.7); text-align: center; padding: 2rem;';
        mensaje.innerHTML = `
            <i class="fa-solid fa-file" style="font-size: 3rem; color: #8b5cf6; display: block; margin-bottom: 1rem;"></i>
            Archivo no soportado para previsualización.<br>
            Usa los botones de arriba para abrir o descargar.
        `;
        contenedor.appendChild(mensaje);
    }
    contenedor.style.display = 'block';
}

// Función para descargar archivo
function descargarArchivo(url, nombre) {
    console.log('descargarArchivo llamada con:', url, nombre);
    const link = document.createElement('a');
    link.href = url;
    link.download = nombre || 'documento';
    link.target = '_blank';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Función para mostrar imágenes cargadas
function mostrarImagenesCargadas(tienda) {
    // Limpiar previsualizaciones
    document.querySelectorAll('.image-preview').forEach(el => { el.src = ''; el.style.display = 'none'; });
    
    // Logo de la tienda
    if (tienda.url_img_orig_tienda && tienda.url_img_orig_tienda.trim() !== '') {
        const previewLogo = document.getElementById('preview_logo');
        previewLogo.src = tienda.url_img_orig_tienda;
        previewLogo.style.display = 'block';
        previewLogo.style.cursor = 'pointer';
        previewLogo.onclick = function() { window.open(tienda.url_img_orig_tienda, '_blank'); };
    }
    // Fachada
    if (tienda.url_img_fachada_tienda && tienda.url_img_fachada_tienda.trim() !== '') {
        const previewFachada = document.getElementById('preview_fachada');
        previewFachada.src = tienda.url_img_fachada_tienda;
        previewFachada.style.display = 'block';
        previewFachada.style.cursor = 'pointer';
        previewFachada.onclick = function() { window.open(tienda.url_img_fachada_tienda, '_blank'); };
    }
    // Interna
    if (tienda.url_img_interna_tienda && tienda.url_img_interna_tienda.trim() !== '') {
        const previewInterna = document.getElementById('preview_interna');
        previewInterna.src = tienda.url_img_interna_tienda;
        previewInterna.style.display = 'block';
        previewInterna.style.cursor = 'pointer';
        previewInterna.onclick = function() { window.open(tienda.url_img_interna_tienda, '_blank'); };
    }
    // Selfie con Admin
    if (tienda.url_img_selfieadmin_tienda && tienda.url_img_selfieadmin_tienda.trim() !== '') {
        const previewSelfie = document.getElementById('preview_selfie');
        previewSelfie.src = tienda.url_img_selfieadmin_tienda;
        previewSelfie.style.display = 'block';
        previewSelfie.style.cursor = 'pointer';
        previewSelfie.onclick = function() { window.open(tienda.url_img_selfieadmin_tienda, '_blank'); };
    }
}

// Funciones auxiliares para apertura directa desde tarjetas
function abrirRegistroVendedorDirecto(codTienda, nombreTienda) {
    document.getElementById('vendedor_cod_tienda').value = codTienda;
    document.getElementById('vendedorNombreTienda').textContent = nombreTienda;
    document.getElementById('formRegistroVendedor').reset();
    document.getElementById('modalRegistroVendedor').classList.add('show');
}

function abrirRegistroProductoDirecto(codTienda, nombreTienda) {
    document.getElementById('producto_cod_tienda').value = codTienda;
    document.getElementById('productoNombreTienda').textContent = nombreTienda;
    document.getElementById('formRegistroProducto').reset();
    document.getElementById('modalRegistroProducto').classList.add('show');
}

function previewImageProducto(input) {
    var preview = document.getElementById('preview_producto_img');
    if (preview && input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { preview.src = e.target.result; preview.style.display = 'block'; }
        reader.readAsDataURL(input.files[0]);
    }
}

// Función para registrar producto
function ejecutarRegistroProducto() {
    console.log("Iniciando ejecutarRegistroProducto()");
    const form = document.getElementById('formRegistroProducto');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Limpiar precio y sincronizar con hidden
    var precioVentaRaw = document.getElementById('producto_precio_venta').value.replace(/\D/g, '');
    document.getElementById('precio_venta_producto_hidden').value = precioVentaRaw;
    
    var precioCompraRaw = document.getElementById('producto_precio_compra').value.replace(/\D/g, '');
    document.getElementById('precio_compra_producto_hidden').value = precioCompraRaw;
    
    // Asegurar que el código de la tienda esté presente
    let codTiendaProducto = document.getElementById('producto_cod_tienda').value;
    if (!codTiendaProducto && window._tiendaRegistrada) {
        codTiendaProducto = window._tiendaRegistrada.cod_tienda;
        document.getElementById('producto_cod_tienda').value = codTiendaProducto;
    }
    
    var formData = new FormData(form);
    // Verificación final de cod_tienda
    if (!formData.get('cod_tienda') && codTiendaProducto) { formData.append('cod_tienda', codTiendaProducto); }

    const nom = document.getElementById('producto_nombre').value;
    const precio = document.getElementById('producto_precio_venta').value;
    
    Swal.fire({ title: 'Registrando Producto...', didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    $.ajax({
        url: 'reg_producto_tienda_ajax.php', type: 'POST', data: formData, processData: false, contentType: false,
        success: function(responseText) {
            //console.log("Respuesta producto:", responseText);
            let response;
            try {
                let cleanJson = responseText;
                if (typeof responseText === 'string') {
                    const firstBrace = responseText.indexOf('{');
                    const lastBrace = responseText.lastIndexOf('}');
                    if (firstBrace !== -1 && lastBrace !== -1) { cleanJson = responseText.substring(firstBrace, lastBrace + 1); }
                }
                response = typeof cleanJson === 'object' ? cleanJson : JSON.parse(cleanJson);
            } catch (e) {
                console.error("Error parseando respuesta producto:", e, responseText);
                Swal.fire({ icon: 'error', title: 'Error de respuesta', text: 'El servidor devolvió un formato inválido.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                return;
            }

            Swal.close();
            if(response.success) {
                setTimeout(function() {
                    document.getElementById('exitoProductoNombre').textContent = nom;
                    document.getElementById('exitoProductoPrecio').textContent = '$ ' + precio;
                    document.getElementById('modalExitoProducto').classList.add('show');
                    
                    agregarProductoALista(nom, precio);
                    form.reset();
                    // Restaurar datos esenciales después del reset
                    document.getElementById('producto_cod_tienda').value = codTiendaProducto;
                    if(document.getElementById('preview_producto_img')) document.getElementById('preview_producto_img').style.display = 'none';
                }, 400);
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error("Error AJAX Producto:", status, error, xhr.responseText);
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'Problema al comunicarse con el servidor.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
}

function agregarProductoALista(nombre, precio) {
    const list = document.getElementById('productosRegistradosList');
    const container = document.getElementById('listaProductosRegistrados');
    const count = document.getElementById('contadorProductos');
    
    container.style.display = 'block';
    
    const item = document.createElement('div');
    item.className = 'item-registrado animate-in';
    item.innerHTML = `
        <div class="item-registrado-icon producto-bg">
            <i class="fa-solid fa-box"></i>
        </div>
        <div class="item-registrado-info">
            <h5>${nombre}</h5>
            <span><i class="fa-solid fa-tag"></i> Precio: ${precio}</span>
        </div>
        <div style="color: #f59e0b;"><i class="fa-solid fa-check-circle"></i></div>
    `;
    list.prepend(item);
    count.textContent = parseInt(count.textContent) + 1;
}

function formatearPrecio(input) {
    let valor = input.value.replace(/\D/g, "");
    if (valor === "") { input.value = ""; return; }
    input.value = "$ " + new Intl.NumberFormat('es-CO').format(valor);
}
// Cerrar modal al hacer clic fuera
document.getElementById('modalRegistro').addEventListener('click', function(e) { if (e.target === this) { cerrarModal(); } });
// Función para ejecutar el registro o edición de tienda
function ejecutarRegistroTienda() {
    console.log("Iniciando ejecutarRegistroTienda()");
    const form = document.getElementById('formRegistroTienda');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    var formData = new FormData(form);
    formData.append('cod_administrador', '<?php echo $cod_administrador; ?>');
    
    var accion = document.getElementById('accion').value;
    var url = accion === 'editar' ? 'edit_tienda_modal_lider_movil_ajax_reg.php' : '../admin/reg_tienda_modal_lider_movil_ajax_reg.php';
    var titulo = accion === 'editar' ? 'Actualizando...' : 'Registrando...';
    var successTitle = accion === 'editar' ? '¡Tienda Actualizada!' : '¡Tienda Registrada!';

    Swal.fire({   title: titulo, text: 'Procesando información', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white' });
    
    $.ajax({
        url: url, type: 'POST', data: formData, processData: false, contentType: false,
        success: function(responseText) {
            //console.log("Respuesta recibida:", responseText);
            let response;
            try {
                let cleanJson = responseText;
                if (typeof responseText === 'string') {
                    const firstBrace = responseText.indexOf('{');
                    const lastBrace = responseText.lastIndexOf('}');
                    if (firstBrace !== -1 && lastBrace !== -1) { cleanJson = responseText.substring(firstBrace, lastBrace + 1); }
                }
                response = typeof cleanJson === 'object' ? cleanJson : JSON.parse(cleanJson);
            } catch (e) {
                console.error("Error parseando respuesta:", e, responseText);
                Swal.fire({ icon: 'error', title: 'Error de respuesta', text: 'El servidor devolvió un formato inválido.', background: '#1a1f2e', color: 'white' });
                return;
            }

            Swal.close();
            if (response.success) {
                cerrarModal(); 
                if (accion === 'registrar') {
                    window._tiendaRegistrada = { cod_tienda: response.cod_tienda, cod_tienda_codifcryp: response.cod_tienda_codifcryp, nombre_tienda: response.nombre_tienda, correo_tercero: response.correo_tercero, telefono1_tercero: response.telefono1_tercero };
                    setTimeout(function() { abrirModalConfirmacion(response.nombre_tienda); }, 400);
                } else {
                    Swal.fire({ icon: 'success', title: successTitle, text: 'Tienda actualizada correctamente.', confirmButtonColor: '#10b981', background: '#1a1f2e', color: 'white', timer: 2000 }).then(() => { location.reload(); });
                }
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo procesar', background: '#1a1f2e', color: 'white' });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error("Error AJAX:", status, error, xhr.responseText);
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'Problema al comunicarse con el servidor.', background: '#1a1f2e', color: 'white' });
        }
    });
}
// =====================================================
// FUNCIONES PARA FLUJO POST-REGISTRO
// =====================================================
function abrirModalConfirmacion(nombreTienda) { 
    if (!nombreTienda && window._tiendaRegistrada) { nombreTienda = window._tiendaRegistrada.nombre_tienda; }
    if (nombreTienda) { 
        const el = document.getElementById('confirmNombreTienda');
        if (el) el.textContent = nombreTienda; 
    }
    const modal = document.getElementById('modalConfirmacionRegistro');
    if (modal) {
        modal.classList.add('show');
    } else {
        console.error("Modal de confirmación no encontrado en el DOM");
        // Fallback en caso de que el modal no exista por algún error de PHP
        Swal.fire({ icon: 'success', title: '¡Tienda Registrada!', text: 'La tienda ' + (nombreTienda || '') + ' se registró correctamente.', background: '#1a1f2e', color: 'white' });
    }
}
function cerrarModalConfirmacion() { document.getElementById('modalConfirmacionRegistro').classList.remove('show'); }
function cerrarConfirmacionYRecargar() { cerrarModalConfirmacion(); location.reload(); }

function cerrarExitoVendedor() { document.getElementById('modalExitoVendedor').classList.remove('show'); }
function cerrarExitoProducto() { document.getElementById('modalExitoProducto').classList.remove('show'); }

function copiarTexto(texto, btn) {
    if (!texto) return;
    navigator.clipboard.writeText(texto).then(() => {
        const icon = btn.querySelector('i');
        const originalClass = icon.className;
        icon.className = 'fa-solid fa-check';
        btn.style.color = '#10b981';
        setTimeout(() => { icon.className = originalClass; btn.style.color = ''; }, 2000);
    });
}

function irCrearVendedores() {
    cerrarModalConfirmacion();
    if (window._tiendaRegistrada) {
        let t = window._tiendaRegistrada;
        document.getElementById('vendedor_cod_tienda').value = t.cod_tienda;
        document.getElementById('vendedorNombreTienda').textContent = t.nombre_tienda;
        document.getElementById('formRegistroVendedor').reset();
        
        // Limpiar lista de vendedores previos
        document.getElementById('vendedoresRegistradosList').innerHTML = '';
        document.getElementById('listaVendedoresRegistrados').style.display = 'none';
        document.getElementById('contadorVendedores').textContent = '0';
        
        // Cargar departamentos para el vendedor
        cargarDepartamentosVendedor('vendedor_');
        
        document.getElementById('modalRegistroVendedor').classList.add('show');
    } else { location.reload(); }
}

function irCrearProductos() {
    cerrarModalConfirmacion();
    if (window._tiendaRegistrada) {
        let t = window._tiendaRegistrada;
        document.getElementById('producto_cod_tienda').value = t.cod_tienda;
        document.getElementById('productoNombreTienda').textContent = t.nombre_tienda;
        document.getElementById('formRegistroProducto').reset();
        
        // Limpiar lista de productos previos
        document.getElementById('productosRegistradosList').innerHTML = '';
        document.getElementById('listaProductosRegistrados').style.display = 'none';
        document.getElementById('contadorProductos').textContent = '0';
        
        document.getElementById('modalRegistroProducto').classList.add('show');
    } else { location.reload(); }
}

function cerrarModalVendedor() { 
    document.getElementById('modalRegistroVendedor').classList.remove('show'); 
    if (window._tiendaRegistrada) { abrirModalConfirmacion(); }
}
function cerrarModalProducto() { 
    document.getElementById('modalRegistroProducto').classList.remove('show'); 
    if (window._tiendaRegistrada) { abrirModalConfirmacion(); }
}

// Función para registrar vendedor
function ejecutarRegistroVendedor() {
    console.log("Iniciando ejecutarRegistroVendedor()");
    const form = document.getElementById('formRegistroVendedor');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Asegurar que el código de la tienda esté presente
    let codTiendaVendedor = document.getElementById('vendedor_cod_tienda').value;
    if (!codTiendaVendedor && window._tiendaRegistrada) {
        codTiendaVendedor = window._tiendaRegistrada.cod_tienda;
        document.getElementById('vendedor_cod_tienda').value = codTiendaVendedor;
    }
    
    var formData = new FormData(form);
    // Verificación final de cod_tienda
    if (!formData.get('cod_tienda') && codTiendaVendedor) {
        formData.append('cod_tienda', codTiendaVendedor);
    }

    const nom = document.getElementById('vendedor_nombre').value;
    const ape = document.getElementById('vendedor_apellido').value;
    const tel = document.getElementById('vendedor_telefono').value;
    
    Swal.fire({ title: 'Registrando Vendedor...', didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    $.ajax({
        url: 'reg_vendedor_tienda_ajax.php', type: 'POST', data: formData, processData: false, contentType: false,
        success: function(responseText) {
            console.log("Respuesta vendedor:", responseText);
            let response;
            try {
                let cleanJson = responseText;
                if (typeof responseText === 'string') {
                    const firstBrace = responseText.indexOf('{');
                    const lastBrace = responseText.lastIndexOf('}');
                    if (firstBrace !== -1 && lastBrace !== -1) { cleanJson = responseText.substring(firstBrace, lastBrace + 1); }
                }
                response = typeof cleanJson === 'object' ? cleanJson : JSON.parse(cleanJson);
            } catch (e) {
                console.error("Error parseando respuesta vendedor:", e, responseText);
                Swal.fire({ icon: 'error', title: 'Error de respuesta', text: 'El servidor devolvió un formato inválido.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                return;
            }

            Swal.close();
            if(response.success) {
                setTimeout(function() {
                    document.getElementById('exitoVendedorNombre').textContent = nom + ' ' + ape;
                    document.getElementById('exitoVendedorUsuario').textContent = response.usuario;
                    document.getElementById('exitoVendedorPass').textContent = response.contrasena_inicial;
                    document.getElementById('modalExitoVendedor').classList.add('show');
                    
                    agregarVendedorALista(nom + ' ' + ape, tel);
                    form.reset();
                    // Restaurar el cod_tienda después del reset
                    document.getElementById('vendedor_cod_tienda').value = codTiendaVendedor;
                }, 400);
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error("Error AJAX Vendedor:", status, error, xhr.responseText);
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'Problema al comunicarse con el servidor.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
}

function agregarVendedorALista(nombre, telefono) {
    const list = document.getElementById('vendedoresRegistradosList');
    const container = document.getElementById('listaVendedoresRegistrados');
    const count = document.getElementById('contadorVendedores');
    
    container.style.display = 'block';
    
    const item = document.createElement('div');
    item.className = 'item-registrado animate-in';
    item.innerHTML = `
        <div class="item-registrado-icon vendedor-bg">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="item-registrado-info">
            <h5>${nombre}</h5>
            <span><i class="fa-solid fa-phone"></i> ${telefono}</span>
        </div>
        <div style="color: #10b981;"><i class="fa-solid fa-check-circle"></i></div>
    `;
    list.prepend(item);
    count.textContent = parseInt(count.textContent) + 1;
}

function finalizarVendedoresYPasarAProductos() {
    cerrarModalVendedor();
    //Swal.fire({ title: '¡Vendedores Listos!', text: '¿Deseas registrar ahora los productos de la tienda?', icon: 'question', showCancelButton: true, confirmButtonText: 'Sí, ir a productos', cancelButtonText: 'No, finalizar aquí', confirmButtonColor: '#f59e0b', cancelButtonColor: '#6c757d', background: '#1a1f2e', color: 'white' }).then((result) => { if (result.isConfirmed) { irCrearProductos(); } else { location.reload(); } });
}
// =====================================================
// FUNCIONES PARA MODAL DE FIRMA ELECTRÓNICA
// =====================================================
function abrirModalFirma(codTiendaCryp, nombreTienda, correo, telefono) {
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(codTiendaCryp);
    document.getElementById('firma_cod_tienda').value = codTiendaCryp;
    document.getElementById('firma_nombre_tienda').value = nombreTienda;
    document.getElementById('firma_correo').value = correo || '';
    document.getElementById('firma_telefono').value = telefono || '';
    document.getElementById('firma_enlace').value = enlaceFirma;
    document.getElementById('firma_tienda_nombre_display').textContent = nombreTienda;
    document.getElementById('modalFirmaElectronica').classList.add('show');
}
function cerrarModalFirma() { 
    var modal = document.getElementById('modalFirmaElectronica');
    if (modal) modal.classList.remove('show'); 
}
function cerrarModalFirmaYRecargar() { 
    cerrarModalFirma(); 
    setTimeout(function() { location.reload(); }, 100);
}

function copiarEnlaceFirma() {
    var enlace = document.getElementById('firma_enlace').value;
    
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(enlace).then(function() {
            Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'Enlace copiado al portapapeles', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' }); });
    } else {
        // Fallback para navegadores antiguos
        var tempInput = document.createElement('input');
        tempInput.value = enlace;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        Swal.fire({ icon: 'success', title: '¡Copiado!', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
    }
}

function enviarPorWhatsApp() {
    var telefono = document.getElementById('firma_telefono').value;
    var nombreTienda = document.getElementById('firma_nombre_tienda').value;
    var enlace = document.getElementById('firma_enlace').value;
    
    var telefonoFormateado = telefono.replace(/[\s\-\(\)\.]/g, '');
    if (!telefonoFormateado.startsWith('+') && !telefonoFormateado.startsWith('57')) { telefonoFormateado = '57' + telefonoFormateado; }
    
    var mensaje = encodeURIComponent(
        'Hola!\n\n' +
        '*EXCELENTES NOTICIAS*\n\n' +
        'Su tienda *' + nombreTienda + '* ha sido registrada exitosamente.\n\n' +
        '--------------------\n' +
        '*FIRMA ELECTRONICA*\n' +
        '--------------------\n\n' +
        'Para completar el proceso, siga estos pasos:\n\n' +
        '1. Haga clic en el enlace\n' +
        '2. Dibuje su firma\n' +
        '3. Confirme\n\n' +
        '*Enlace de firma:*\n' +
        enlace + '\n\n' +
        'Gracias por confiar en nosotros!'
    );
    if (telefonoFormateado && telefonoFormateado.length >= 10) { window.open('https://wa.me/' + telefonoFormateado + '?text=' + mensaje, '_blank'); } else { window.open('https://wa.me/?text=' + mensaje, '_blank'); }
}
function enviarPorCorreo() {
    var correo = document.getElementById('firma_correo').value;
    var nombreTienda = document.getElementById('firma_nombre_tienda').value;
    var enlace = document.getElementById('firma_enlace').value;
    var codTienda = document.getElementById('firma_cod_tienda').value;
    
    // Validar que el correo esté completo
    if (!correo || correo.trim() === '') {
        Swal.fire({ icon: 'warning', title: 'Correo Requerido', text: 'Por favor ingrese el correo electrónico del cliente', confirmButtonColor: '#667eea', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    // Validar formato de correo
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(correo)) {
        Swal.fire({ icon: 'warning', title: 'Correo Inválido', text: 'Por favor ingrese un correo electrónico válido', confirmButtonColor: '#667eea', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    // Mostrar loading
    Swal.fire({ title: 'Enviando Correo...', html: 'Por favor espere mientras se envía el correo electrónico', allowOutsideClick: false, allowEscapeKey: false, customClass: { container: 'swal-high-zindex' }, didOpen: () => { Swal.showLoading(); } });
    // Enviar correo mediante AJAX
    $.ajax({
        url: 'enviar_enlace_firma_correo.php', type: 'POST', data: { correo: correo, enlace: enlace, nombre_tienda: nombreTienda, cod_tienda: codTienda }, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({ icon: 'success',  title: '¡Correo Enviado!', html: '<p>' + response.mensaje + '</p><p style="font-size: 0.9rem; color: #6b7280; margin-top: 10px;">El cliente recibirá el enlace para firmar en su correo electrónico.</p>', confirmButtonColor: '#8b5cf6', confirmButtonText: 'Entendido', customClass: { container: 'swal-high-zindex' } });
            } else {
                Swal.fire({ icon: 'error', title: 'Error al Enviar', text: response.mensaje || 'No se pudo enviar el correo electrónico', footer: response.error ? '<small style="color: #ef4444;">' + response.error + '</small>' : '', confirmButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error de Conexión', text: 'No se pudo conectar con el servidor para enviar el correo', footer: '<small style="color: #ef4444;">Error: ' + error + '</small>', confirmButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' } });
        }
    });
}
</script>

<!-- Modal Revisión Firma -->
<div class="modal-overlay" id="modalRevisionFirma">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-file-signature"></i> Revisar Firma</h2>
            <button class="modal-close" onclick="cerrarModalRevisionFirma()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="revision_cod_tienda" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h3 style="color: white; margin-bottom: 0.5rem;" id="revision_nombre_tienda"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Por favor revise la firma electrónica antes de aceptarla.</p>
            </div>
            
            <div style="background: white; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; justify-content: center; align-items: center; min-height: 200px;">
                <img id="revision_imagen_firma" src="" alt="Firma Electrónica" style="max-width: 100%; max-height: 300px;">
            </div>
            
            <!-- Opciones de Compartir -->
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                <h4 style="color: #8b5cf6; margin: 0 0 1rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-share-nodes"></i> Compartir Enlace para Firmar
                </h4>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
                    <button onclick="compartirWhatsApp()" style="background: #25D366; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </button>
                    <button onclick="compartirEmail()" style="background: #EA4335; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por Email">
                        <i class="fa-solid fa-envelope"></i> Email
                    </button>
                    <button onclick="copiarEnlace()" style="background: #8b5cf6; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Copiar enlace">
                        <i class="fa-solid fa-copy"></i> Copiar
                    </button>
                </div>
            </div>
            
            <!-- Botones de Gestión -->
            <div style="display: flex; gap: 1rem;">
                <button onclick="gestionarFirma('rechazar')" style="flex: 1; background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.5); padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; transition: all 0.3s ease;">
                    <i class="fa-solid fa-times"></i> Rechazar
                </button>
                <button onclick="gestionarFirma('aceptar')" style="flex: 1; background: #8b5cf6; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; transition: all 0.3s ease;">
                    <i class="fa-solid fa-check"></i> Aceptar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Revisión GPS -->
<div class="modal-overlay" id="modalRevisionGPS">
    <div class="modal-content" style="max-width: 600px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-map-marker-alt"></i> Ubicación GPS</h2>
            <button class="modal-close" onclick="cerrarModalRevisionGPS()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="revision_gps_cod_tienda" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h3 style="color: white; margin-bottom: 0.5rem;" id="revision_gps_nombre_tienda"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;" id="revision_gps_coordenadas"></p>
            </div>
            
            <div id="gps_mapa_container" style="background: white; border-radius: 12px; margin-bottom: 1.5rem; min-height: 300px; display: none;">
                <iframe id="gps_mapa_iframe" width="100%" height="300" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
            <div id="gps_sin_ubicacion" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 12px; padding: 2rem; text-align: center; display: none;">
                <i class="fa-solid fa-map-marker-slash" style="font-size: 3rem; color: #ef4444; margin-bottom: 1rem;"></i>
                <h4 style="color: #ef4444; margin: 0 0 0.5rem 0;">Sin Ubicación GPS</h4>
                <p style="color: rgba(255,255,255,0.7); margin: 0 0 1.5rem 0;">Esta tienda aún no ha registrado su ubicación GPS.</p>
                
                <!-- Opciones de Compartir Enlace para Capturar GPS -->
                <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 1rem; margin-top: 1rem;">
                    <h4 style="color: #8b5cf6; margin: 0 0 1rem 0; font-size: 0.9rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-solid fa-share-nodes"></i> Compartir Enlace para Capturar GPS
                    </h4>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
                        <button onclick="compartirGPSWhatsApp()" style="background: #25D366; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </button>
                        <button onclick="compartirGPSEmail()" style="background: #EA4335; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Compartir por Email">
                            <i class="fa-solid fa-envelope"></i> Email
                        </button>
                        <button onclick="copiarEnlaceGPS()" style="background: #8b5cf6; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" title="Copiar enlace">
                            <i class="fa-solid fa-copy"></i> Copiar
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Botones de Acción -->
            <div style="display: flex; gap: 1rem;" id="gps_botones_accion">
                <button onclick="abrirGoogleMaps()" style="flex: 1; background: #4285F4; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; transition: all 0.3s ease;">
                    <i class="fa-solid fa-map"></i> Abrir en Google Maps
                </button>
                <button onclick="copiarCoordenadas()" style="flex: 1; background: #8b5cf6; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; transition: all 0.3s ease;">
                    <i class="fa-solid fa-copy"></i> Copiar Coordenadas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmación Firma -->
<div class="modal-overlay" id="modalConfirmacionFirma">
    <div class="modal-content" style="max-width: 450px;">
        <div class="modal-header">
            <h2 id="confirmacion_titulo"><i class="fa-solid fa-question-circle"></i> Confirmar Acción</h2>
            <button class="modal-close" onclick="cerrarModalConfirmacion()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div id="confirmacion_icono" style="font-size: 3rem; margin-bottom: 1rem; color: #8b5cf6;">
                    <i class="fa-solid fa-question-circle"></i>
                </div>
                <h3 id="confirmacion_mensaje" style="color: white; margin-bottom: 0.5rem;">¿Deseas continuar?</h3>
                <p id="confirmacion_descripcion" style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Esta acción no se puede deshacer.</p>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button onclick="cerrarModalConfirmacion()" style="flex: 1; background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;">
                    <i class="fa-solid fa-times"></i> Cancelar
                </button>
                <button id="btn_confirmar_accion" onclick="confirmarAccionFirma()" style="flex: 1; background: #8b5cf6; color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 700; transition: all 0.3s ease;">
                    <i class="fa-solid fa-check"></i> Confirmar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Banco a Tienda -->
<div class="modal-overlay" id="modalAgregarBanco" style="z-index: 5000;">
    <div class="modal-content" style="max-width: 550px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-university"></i> Agregar Cuenta Bancaria</h2>
            <button class="modal-close" onclick="cerrarModalAgregarBanco()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 0.75rem; margin-bottom: 1rem;">
                <strong style="color: #3b82f6;">Tienda:</strong> <span id="banco_nombre_tienda" style="color: white;"></span>
            </div>
            <form id="formAgregarBanco">
                <input type="hidden" id="banco_cod_tienda" name="cod_tienda">
                
                <div class="form-group">
                    <label class="form-label">Banco *</label>
                    <select class="form-select" id="banco_select" name="cod_banco" required>
                        <option value="">Cargando bancos...</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Número de Cuenta *</label>
                    <input type="text" class="form-input" id="banco_numero_cuenta" name="numero_banco_cuenta" placeholder="Ej: 1234567890" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo de Cuenta *</label>
                        <select class="form-select" id="banco_tipo_cuenta" name="cod_tipo_cuenta_banco" required>
                            <option value="1">Ahorros</option>
                            <option value="2">Corriente</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Estado *</label>
                        <select class="form-select" id="banco_estado" name="cod_estado" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Titular de la Cuenta</label>
                    <input type="text" class="form-input" id="banco_nombre_titular" name="nombre_titular_cuenta" placeholder="Nombre completo">
                </div>

                <div class="form-group">
                    <label class="form-label">CC / NIT Titular</label>
                    <input type="text" class="form-input" id="banco_id_titular" name="identificacion_titular_cuenta" placeholder="Documento">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-file-certificate"></i> Certificado Bancario</label>
                    <div style="background: rgba(139, 92, 246, 0.05); border: 2px dashed rgba(139, 92, 246, 0.3); border-radius: 10px; padding: 1rem; text-align: center; cursor: pointer; transition: all 0.3s ease;" onclick="document.getElementById('banco_certificado').click()" onmouseover="this.style.borderColor='rgba(139, 92, 246, 0.6)'" onmouseout="this.style.borderColor='rgba(139, 92, 246, 0.3)'">
                        <input type="file" id="banco_certificado" name="certificado_banco" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx" style="display: none;" onchange="mostrarNombreArchivoBanco(this)">
                        <div id="preview_certificado_banco">
                            <i class="fa-solid fa-cloud-upload-alt" style="font-size: 2rem; color: rgba(139, 92, 246, 0.6); margin-bottom: 0.5rem;"></i>
                            <p style="margin: 0; color: rgba(255,255,255,0.7); font-size: 0.85rem;">Clic para seleccionar archivo</p>
                            <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.7rem;">Imagen o documento (JPG, PNG, PDF, DOC)</p>
                        </div>
                    </div>
                </div>

                <div class="form-row" style="gap: 0.5rem; margin-top: 1.5rem;">
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

<!-- Modal Agregar Vendedor a Tienda -->
<div class="modal-overlay" id="modalAgregarVendedor" style="z-index: 5000;">
    <div class="modal-content" style="max-width: 650px;">
        <div class="modal-header">
            <h2><i class="fa-solid fa-user-plus"></i> Registrar Nuevo Vendedor</h2>
            <button class="modal-close" onclick="cerrarModalAgregarVendedor()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; padding: 0.75rem; margin-bottom: 1rem;">
                <strong style="color: #8b5cf6;">Tienda:</strong> <span id="vendedor_nombre_tienda" style="color: white;"></span>
            </div>
            <div id="vendedor_info_adicional" style="margin-bottom: 1rem; color: rgba(255,255,255,0.7); font-size: 0.85rem; padding: 0.5rem; border-left: 3px solid #8b5cf6;">
                <i class="fa-solid fa-location-dot"></i> <span id="vendedor_tienda_ubicacion"></span>
            </div>
            <form id="formAgregarVendedor">
                <input type="hidden" id="vendedor_cod_tienda" name="cod_tienda">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombres *</label>
                        <input type="text" class="form-input" id="vend_nombres" name="nombre1_tercero" placeholder="Ej: Juan Carlos" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellidos *</label>
                        <input type="text" class="form-input" id="vend_apellidos" name="apellido1_tercero" placeholder="Ej: Pérez López" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Identificación (CC) *</label>
                        <input type="text" class="form-input" id="vend_identificacion" name="identificacion_tercero" placeholder="Cédula de ciudadanía" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" id="vend_telefono" name="telefono1_tercero" placeholder="Número de contacto" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" class="form-input" id="vend_correo" name="correo_tercero" placeholder="correo@ejemplo.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Dirección *</label>
                    <input type="text" class="form-input" id="vend_direccion" name="direccion_tercero" placeholder="Ej: Calle 10 # 20-30" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Departamento *</label>
                        <select class="form-select" name="cod_departamento" id="vend_cod_departamento" onchange="cargarMunicipiosVendedor('vend_')" required>
                            <option value="">Seleccione Departamento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Municipio *</label>
                        <select class="form-select" name="cod_municipio" id="vend_cod_municipio" required>
                            <option value="">Seleccione Municipio</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Barrio</label>
                    <input type="text" class="form-input" name="barrio_tercero" id="vend_barrio" placeholder="Opcional">
                </div>

                <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 0.75rem; margin-top: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                        <i class="fa-solid fa-info-circle" style="color: #3b82f6; font-size: 1.2rem;"></i>
                        <strong style="color: #3b82f6; font-size: 0.95rem;">Información:</strong>
                    </div>
                    <p style="color: rgba(255,255,255,0.8); font-size: 0.85rem; margin: 0; line-height: 1.4;">
                        El usuario y contraseña se generarán automáticamente basándose en la identificación del vendedor.
                    </p>
                    <p style="color: rgba(255,255,255,0.6); font-size: 0.75rem; margin: 0.5rem 0 0 0;">
                        <strong>Usuario:</strong> identificacion-codigoautogenerado<br>
                        <strong>Contraseña:</strong> identificación
                    </p>
                </div>

                <div class="form-row" style="gap: 0.5rem; margin-top: 1.5rem;">
                    <button type="button" onclick="cerrarModalAgregarVendedor()" style="flex: 1; background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-times"></i> Cancelar
                    </button>
                    <button type="submit" style="flex: 1; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-save"></i> Guardar Vendedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// ====================== GESTIÓN DE FIRMAS ======================
function compartirEnlaceFirma(codTiendaCryp, nombreTienda, codEstadoFirma, urlFirma) {
    console.log('compartirEnlaceFirma Debug:', { codTiendaCryp, nombreTienda, codEstadoFirma, urlFirma });
    // Normalize inputs
    codEstadoFirma = String(codEstadoFirma);
    urlFirma = urlFirma ? String(urlFirma).trim() : '';

    // Check condition: State is '0' AND URL exists
    if (codEstadoFirma === '0' && urlFirma.length > 0) {
        var modal = document.getElementById('modalRevisionFirma');
        if (modal) {
            abrirModalRevisionFirma(codTiendaCryp, nombreTienda, urlFirma);
        } else {
            console.error('Error: Modal modalRevisionFirma not found in DOM');
            Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo abrir el modal de revisión (Elemento no encontrado)', background: '#1a1f2e', color: 'white' });
        }
        return;
    }
    // Default: Show Sharing Link Modal
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(codTiendaCryp);
    
    Swal.fire({
        title: 'Compartir Enlace de Firma',
        html: `
            <p style="color: rgba(255,255,255,0.7); margin-bottom: 1rem;">Tienda: <strong>${nombreTienda}</strong></p>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; justify-content: center;">
                <button onclick="copiarEnlace('${enlaceFirma}')" style="flex: 1; min-width: 120px; padding: 0.75rem; background: #8b5cf6; color: white; border: none; border-radius: 8px; cursor: pointer;">
                    <i class="fa-solid fa-copy"></i> Copiar
                </button>
                <a href="https://wa.me/?text=${encodeURIComponent('Por favor firma tu documento digital aquí: ' + enlaceFirma)}" target="_blank" style="flex: 1; min-width: 120px; padding: 0.75rem; background: #25d366; color: white; border: none; border-radius: 8px; text-decoration: none; text-align: center;">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                </a>
            </div>
        `,
        showConfirmButton: false, showCloseButton: true, background: '#1a1f2e', color: 'white'
    });
}

function abrirModalRevisionFirma(codTiendaCryp, nombreTienda, codEstadoFirma, urlFirma) {
    console.log('abrirModalRevisionFirma:', { codTiendaCryp, nombreTienda, codEstadoFirma, urlFirma });
    // Fallback logic if called with different parameters or from sharing function // If the 3rd arg is the URL (old call style), swap variables or handle it // But since user changed onclick to pass 4 args, we MUST accept 4 args.
    // Logic: If state is NOT 0 (Pending), maybe we shouldn't be here? // The user forced the call, so we display what we have.
    document.getElementById('revision_cod_tienda').value = codTiendaCryp;
    document.getElementById('revision_nombre_tienda').textContent = nombreTienda;
    
    // Ensure URL is valid
    if (urlFirma && urlFirma.trim() !== '') {
        document.getElementById('revision_imagen_firma').src = urlFirma;
        document.getElementById('revision_imagen_firma').style.display = 'block';
    } else {
        // If no URL (maybe already accepted and cleared, or never signed), hide image or show placeholder
        document.getElementById('revision_imagen_firma').style.display = 'none';
        // Optionally show message
    }
    
    // Verificar si la firma ya fue aceptada o no hay imagen cargada y deshabilitar botón aceptar
    var btnAceptar = document.querySelector('#modalRevisionFirma button[onclick="gestionarFirma(\'aceptar\')"]');
    if (btnAceptar) {
        var firmaAceptada = (codEstadoFirma === "1" || codEstadoFirma === 1);
        var sinImagen = (!urlFirma || urlFirma.trim() === '');
        
        if (firmaAceptada) {
            // Firma ya aceptada - deshabilitar botón
            btnAceptar.disabled = true;
            btnAceptar.style.background = 'rgba(139, 92, 246, 0.3)';
            btnAceptar.style.color = 'rgba(255, 255, 255, 0.5)';
            btnAceptar.style.cursor = 'not-allowed';
            btnAceptar.innerHTML = '<i class="fa-solid fa-check"></i> Ya Aceptada';
        } else if (sinImagen) {
            // No hay imagen de firma - deshabilitar botón
            btnAceptar.disabled = true;
            btnAceptar.style.background = 'rgba(239, 68, 68, 0.3)';
            btnAceptar.style.color = 'rgba(255, 255, 255, 0.5)';
            btnAceptar.style.cursor = 'not-allowed';
            btnAceptar.innerHTML = '<i class="fa-solid fa-exclamation-triangle"></i> Sin Firma';
        } else {
            // Firma pendiente con imagen - habilitar botón
            btnAceptar.disabled = false;
            btnAceptar.style.background = '#8b5cf6';
            btnAceptar.style.color = 'white';
            btnAceptar.style.cursor = 'pointer';
            btnAceptar.innerHTML = '<i class="fa-solid fa-check"></i> Aceptar';
        }
    }
    document.getElementById('modalRevisionFirma').classList.add('show');
}
function cerrarModalRevisionFirma() { document.getElementById('modalRevisionFirma').classList.remove('show'); }
// ====================== FUNCIONES PARA COMPARTIR ENLACE DE FIRMA ======================
function compartirWhatsApp() {
    var codTiendaElem = document.getElementById('revision_cod_tienda');
    var nombreTiendaElem = document.getElementById('revision_nombre_tienda');
    if (!codTiendaElem || !nombreTiendaElem) { console.error('No se encontraron los elementos necesarios para compartir'); return; }
    var codTienda = codTiendaElem.value;
    var nombreTienda = nombreTiendaElem.textContent;
    if (!codTienda) { alert('No se encontró el código de la tienda'); return; }
    // Construir URL de firma
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(codTienda);
    var mensaje = '¡Hola! Por favor firma el documento de ' + nombreTienda + ' en el siguiente enlace: ' + enlaceFirma;
    var urlWhatsApp = 'https://wa.me/?text=' + encodeURIComponent(mensaje);
    window.open(urlWhatsApp, '_blank');
}

function compartirEmail() {
    var codTiendaElem = document.getElementById('revision_cod_tienda');
    var nombreTiendaElem = document.getElementById('revision_nombre_tienda');
    if (!codTiendaElem || !nombreTiendaElem) { console.error('No se encontraron los elementos necesarios para compartir'); return; }
    var codTienda = codTiendaElem.value;
    var nombreTienda = nombreTiendaElem.textContent;
    
    if (!codTienda) { Swal.fire({ icon: 'error', title: 'Error', text: 'No se encontró el código de la tienda', background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' }}); return;  }
    // Solicitar correo electrónico del destinatario
    Swal.fire({
        title: 'Enviar por Correo', html: '<p style="margin-bottom: 15px;">Ingrese el correo electrónico del destinatario:</p>',
        input: 'email', inputPlaceholder: 'ejemplo@correo.com', showCancelButton: true, confirmButtonText: 'Enviar', cancelButtonText: 'Cancelar',
        background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6', cancelButtonColor: '#6b7280',
        customClass: { container: 'swal-high-zindex' },
        inputAttributes: {
            autocomplete: 'email', style: 'background: #2d3748; color: white; border: 1px solid #4a5568; padding: 10px; border-radius: 8px;'
        },
        inputValidator: (value) => {
            if (!value) { return 'Debe ingresar un correo electrónico'; }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) { return 'Ingrese un correo electrónico válido'; }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            // Construir URL de firma
            var currentPath = window.location.pathname;
            var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
            var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(codTienda);
            
            // Mostrar indicador de carga
            Swal.fire({ title: 'Enviando correo...', html: 'Por favor espere', allowOutsideClick: false, allowEscapeKey: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }, didOpen: () => { Swal.showLoading(); } });
            
            // Enviar correo mediante AJAX
            $.ajax({
                url: '../admin/enviar_firma_tienda_email.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    correo: result.value, nombre_tienda: nombreTienda, enlace_firma: enlaceFirma
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Correo Enviado!',
                            text: response.mensaje || 'El correo se envió exitosamente',
                            background: '#1a1f2e',
                            color: 'white',
                            confirmButtonColor: '#8b5cf6',
                            customClass: { container: 'swal-high-zindex' }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.mensaje || 'No se pudo enviar el correo',
                            background: '#1a1f2e',
                            color: 'white',
                            confirmButtonColor: '#ef4444',
                            customClass: { container: 'swal-high-zindex' }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al enviar correo:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Conexión',
                        text: 'No se pudo conectar con el servidor para enviar el correo',
                        background: '#1a1f2e',
                        color: 'white',
                        confirmButtonColor: '#ef4444',
                        customClass: { container: 'swal-high-zindex' }
                    });
                }
            });
        }
    });
}

function copiarEnlace() {
    var codTiendaElem = document.getElementById('revision_cod_tienda');
    
    if (!codTiendaElem) {
        console.error('No se encontró el elemento revision_cod_tienda');
        Swal.fire({ 
            icon: 'error', 
            title: 'Error', 
            text: 'No se pudo obtener la información de la tienda', 
            background: '#1a1f2e', 
            color: 'white',
            confirmButtonColor: '#8b5cf6',
            customClass: { container: 'swal-high-zindex' }
        });
        return;
    }
    
    var codTienda = codTiendaElem.value;
    
    if (!codTienda) { 
        Swal.fire({ 
            icon: 'error', 
            title: 'Error', 
            text: 'No se encontró el código de la tienda', 
            background: '#1a1f2e', 
            color: 'white',
            confirmButtonColor: '#8b5cf6',
            customClass: { container: 'swal-high-zindex' }
        }); 
        return; 
    }
    // Construir URL de firma
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(codTienda);
    
    // Intentar usar la API moderna de Clipboard
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(enlaceFirma).then(function() {
            Swal.fire({ icon: 'success', title: '¡Enlace Copiado!', text: 'Enlace copiado al portapapeles', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }).catch(function() {
            copiarEnlaceFallback(enlaceFirma);
        });
    } else {
        copiarEnlaceFallback(enlaceFirma);
    }
}

function copiarEnlaceFallback(texto) {
    var tempInput = document.createElement('input');
    tempInput.value = texto;
    tempInput.style.position = 'fixed';
    tempInput.style.opacity = '0';
    document.body.appendChild(tempInput);
    tempInput.select();
    tempInput.setSelectionRange(0, 99999);
    
    try {
        var exitoso = document.execCommand('copy');
        if (exitoso) {
            Swal.fire({ 
                icon: 'success', title: '¡Enlace Copiado!', text: 'Enlace copiado al portapapeles', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } 
            });
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo copiar el enlace', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    } catch (err) {
        alert('Error al copiar: ' + err);
    }
    document.body.removeChild(tempInput);
}

function gestionarFirma(accion) {
    var codTienda = document.getElementById('revision_cod_tienda').value;
    
    if (!codTienda) { alert('No se encontró el código de la tienda'); return; }

    // Verificar si el botón aceptar está deshabilitado
    if (accion === 'aceptar') {
        var btnAceptar = document.querySelector('#modalRevisionFirma button[onclick="gestionarFirma(\'aceptar\')"]');
        if (btnAceptar && btnAceptar.disabled) {
            var mensaje = 'Esta firma no puede ser procesada.';
            var detalle = '';
            
            if (btnAceptar.innerHTML.includes('Ya Aceptada')) {
                detalle = 'Esta firma ya fue aceptada anteriormente.';
            } else if (btnAceptar.innerHTML.includes('Sin Firma')) {
                detalle = 'No hay una imagen de firma electrónica para revisar.';
            }
            
            Swal.fire({
                icon: 'info',
                title: 'Acción no disponible', text: detalle || mensaje,   background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
            return;
        }
    }

    // Configurar el modal de confirmación
    var titulo = accion === 'aceptar' ? 'Aceptar Firma' : 'Rechazar Firma';
    var mensaje = accion === 'aceptar' ? '¿Deseas aceptar esta firma?' : '¿Deseas rechazar esta firma?';
    var descripcion = accion === 'aceptar' ? 'La firma será aprobada y el proceso se completará.' : 'El cliente deberá firmar nuevamente.';
    var icono = accion === 'aceptar' ? 'fa-check-circle' : 'fa-times-circle';
    var color = accion === 'aceptar' ? '#8b5cf6' : '#ef4444';
    
    document.getElementById('confirmacion_titulo').innerHTML = '<i class="fa-solid ' + icono + '"></i> ' + titulo;
    document.getElementById('confirmacion_mensaje').textContent = mensaje;
    document.getElementById('confirmacion_descripcion').textContent = descripcion;
    document.getElementById('confirmacion_icono').innerHTML = '<i class="fa-solid ' + icono + '"></i>';
    document.getElementById('confirmacion_icono').style.color = color;
    
    // Guardar los datos en el botón de confirmación
    var btnConfirmar = document.getElementById('btn_confirmar_accion');
    btnConfirmar.style.background = color;
    btnConfirmar.setAttribute('data-accion', accion);
    btnConfirmar.setAttribute('data-cod-tienda', codTienda);
    
    console.log('Datos guardados en botón:', {
        accion: btnConfirmar.getAttribute('data-accion'),
        codTienda: btnConfirmar.getAttribute('data-cod-tienda')
    });
    
    // Mostrar modal de confirmación
    document.getElementById('modalConfirmacionFirma').classList.add('show');
}

function confirmarAccionFirma() {
    var btnConfirmar = document.getElementById('btn_confirmar_accion');
    var accion = btnConfirmar.getAttribute('data-accion');
    var codTienda = btnConfirmar.getAttribute('data-cod-tienda');
    
    console.log('Datos recuperados del botón:', {
        accion: accion,
        codTienda: codTienda
    });
    
    if (!accion || !codTienda) {
        alert('Error: No hay acción pendiente');
        return;
    }
    
    console.log('Enviando AJAX con parámetros:', {
        accion: accion,
        cod_tienda: codTienda
    });
    
    // Cerrar modal de confirmación
    cerrarModalConfirmacion();
    
    // Enviar petición AJAX con formato más explícito
    $.ajax({
        url: '../admin/gestionar_firma_ajax.php',
        type: 'POST',
        data: {
            'accion': accion,
            'cod_tienda': codTienda
        },
        dataType: 'json',
        beforeSend: function() {
            console.log('Enviando datos:', {
                'accion': accion,
                'cod_tienda': codTienda
            });
        },
        success: function(response) {
            console.log('Respuesta del servidor:', response);
            if (response && response.success) {
                cerrarModalRevisionFirma();
                location.reload();
            } else {
                alert('Error: ' + (response.message || 'Respuesta inválida del servidor'));
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error AJAX completo:', {
                status: jqXHR.status,
                statusText: jqXHR.statusText,
                responseText: jqXHR.responseText,
                textStatus: textStatus,
                errorThrown: errorThrown
            });
            alert('Error de conexión: ' + (jqXHR.status === 404 ? 'Archivo no encontrado' : 'Error ' + jqXHR.status + ' - ' + textStatus));
        }
    });
    
    // Limpiar datos del botón
    btnConfirmar.removeAttribute('data-accion');
    btnConfirmar.removeAttribute('data-cod-tienda');
}

function cerrarModalConfirmacion() {
    document.getElementById('modalConfirmacionFirma').classList.remove('show');
    // Limpiar datos del botón al cerrar
    var btnConfirmar = document.getElementById('btn_confirmar_accion');
    btnConfirmar.removeAttribute('data-accion');
    btnConfirmar.removeAttribute('data-cod-tienda');
}
// ====================== GESTIÓN DE GPS ======================
function abrirModalRevisionGPS(codTiendaCryp, nombreTienda, coordenadasGPS) {
    console.log('abrirModalRevisionGPS:', { codTiendaCryp, nombreTienda, coordenadasGPS });
    
    document.getElementById('revision_gps_cod_tienda').value = codTiendaCryp;
    document.getElementById('revision_gps_nombre_tienda').textContent = nombreTienda;
    
    var mapaContainer = document.getElementById('gps_mapa_container');
    var sinUbicacion = document.getElementById('gps_sin_ubicacion');
    var botonesAccion = document.getElementById('gps_botones_accion');
    var coordenadasTexto = document.getElementById('revision_gps_coordenadas');
    
    // Verificar si hay coordenadas GPS
    if (coordenadasGPS && coordenadasGPS.trim() !== '') {
        // Mostrar mapa
        mapaContainer.style.display = 'block';
        sinUbicacion.style.display = 'none';
        botonesAccion.style.display = 'flex';
        
        // Mostrar coordenadas
        coordenadasTexto.textContent = 'Coordenadas: ' + coordenadasGPS;
        coordenadasTexto.style.display = 'block';
        
        // Cargar mapa de Google Maps en iframe
        var iframe = document.getElementById('gps_mapa_iframe');
        var googleMapsUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(coordenadasGPS) + '&output=embed';
        iframe.src = googleMapsUrl;
        
        // Guardar coordenadas para usar en botones
        window.currentGPSCoords = coordenadasGPS;
    } else {
        // No hay ubicación GPS
        mapaContainer.style.display = 'none';
        sinUbicacion.style.display = 'block';
        botonesAccion.style.display = 'none';
        coordenadasTexto.style.display = 'none';
        window.currentGPSCoords = null;
    }
    
    document.getElementById('modalRevisionGPS').classList.add('show');
}

function cerrarModalRevisionGPS() {
    document.getElementById('modalRevisionGPS').classList.remove('show');
    // Limpiar iframe
    document.getElementById('gps_mapa_iframe').src = '';
    window.currentGPSCoords = null;
}

function abrirGoogleMaps() {
    if (window.currentGPSCoords) {
        var googleMapsUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(window.currentGPSCoords);
        window.open(googleMapsUrl, '_blank');
    } else {
        Swal.fire({ 
            icon: 'error', 
            title: 'Error', 
            text: 'No hay coordenadas disponibles', 
            background: '#1a1f2e', 
            color: 'white' 
        });
    }
}

function copiarCoordenadas() {
    if (window.currentGPSCoords) {
        navigator.clipboard.writeText(window.currentGPSCoords).then(function() {
            Swal.fire({ 
                icon: 'success', 
                title: '¡Copiado!', 
                text: 'Coordenadas copiadas al portapapeles', 
                timer: 1500, 
                showConfirmButton: false, 
                background: '#1a1f2e', 
                color: 'white' 
            });
        }).catch(function() {
            Swal.fire({ 
                icon: 'error', 
                title: 'Error', 
                text: 'No se pudo copiar las coordenadas', 
                background: '#1a1f2e', 
                color: 'white' 
            });
        });
    } else {
        Swal.fire({ 
            icon: 'error', 
            title: 'Error', 
            text: 'No hay coordenadas disponibles', 
            background: '#1a1f2e', 
            color: 'white' 
        });
    }
}

// ====================== COMPARTIR ENLACE PARA CAPTURAR GPS ======================
function compartirGPSWhatsApp() {
    var codTienda = document.getElementById('revision_gps_cod_tienda').value;
    var nombreTienda = document.getElementById('revision_gps_nombre_tienda').textContent;
    
    if (!codTienda) { 
        alert('No se encontró el código de la tienda'); 
        return; 
    }
    
    // Construir URL para capturar GPS (similar a firma_tienda.php)
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    var enlaceGPS = window.location.origin + basePath + 'gps_tienda.php?cod=' + encodeURIComponent(codTienda);
    
    var mensaje = '¡Hola! Por favor registra la ubicación GPS de ' + nombreTienda + ' en el siguiente enlace: ' + enlaceGPS;
    var urlWhatsApp = 'https://wa.me/?text=' + encodeURIComponent(mensaje);
    window.open(urlWhatsApp, '_blank');
}

function compartirGPSEmail() {
    var codTienda = document.getElementById('revision_gps_cod_tienda').value;
    var nombreTienda = document.getElementById('revision_gps_nombre_tienda').textContent;
    
    if (!codTienda) { 
        alert('No se encontró el código de la tienda'); 
        return; 
    }
    
    // Construir URL para capturar GPS
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    var enlaceGPS = window.location.origin + basePath + 'gps_tienda.php?cod=' + encodeURIComponent(codTienda);
    
    var asunto = 'Solicitud de Ubicación GPS - ' + nombreTienda;
    var cuerpo = 'Estimado/a,\n\nPor favor registra la ubicación GPS accediendo al siguiente enlace:\n\n' + enlaceGPS + '\n\nGracias.';
    var mailtoLink = 'mailto:?subject=' + encodeURIComponent(asunto) + '&body=' + encodeURIComponent(cuerpo);
    window.location.href = mailtoLink;
}

function copiarEnlaceGPS() {
    var codTienda = document.getElementById('revision_gps_cod_tienda').value;
    
    if (!codTienda) { 
        Swal.fire({ 
            icon: 'error', 
            title: 'Error', 
            text: 'No se encontró el código de la tienda', 
            background: '#1a1f2e', 
            color: 'white' }); 
        return; 
    }
    
    // Construir URL para capturar GPS
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    var enlaceGPS = window.location.origin + basePath + 'gps_tienda.php?cod=' + encodeURIComponent(codTienda);
    
    navigator.clipboard.writeText(enlaceGPS).then(function() {
        Swal.fire({ icon: 'success', title: '¡Copiado!', text: 'Enlace copiado al portapapeles', timer: 1500, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
    }).catch(function() {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo copiar el enlace', background: '#1a1f2e', color: 'white' });
    });
}

// Cerrar modal de revisión al hacer clic fuera
document.getElementById('modalRevisionFirma').addEventListener('click', function(e) { if (e.target === this) { cerrarModalRevisionFirma(); } });
document.getElementById('modalConfirmacionFirma').addEventListener('click', function(e) { if (e.target === this) { cerrarModalConfirmacion(); } });
document.getElementById('modalRevisionGPS').addEventListener('click', function(e) { if (e.target === this) { cerrarModalRevisionGPS(); } });
</script>

<!-- ====================== SISTEMA DE NOTIFICACIONES ====================== -->
<style>
/* Botón flotante de notificaciones - Móvil */
.notification-bell-movil {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(139, 92, 246, 0.5);
    z-index: 9999;
    transition: all 0.3s ease;
    border: none;
}

.notification-bell-movil:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 30px rgba(139, 92, 246, 0.7);
}

.notification-bell-movil i {
    font-size: 22px;
    color: white;
}

.notification-bell-movil.has-notifications {
    animation: bellPulseMovil 2s infinite;
}

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

@keyframes bellPulseMovil {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes bellShakeMovil {
    0%, 100% { transform: rotate(0); }
    25% { transform: rotate(15deg); }
    75% { transform: rotate(-15deg); }
}

.notification-bell-movil.shake i {
    animation: bellShakeMovil 0.5s ease;
}

/* Panel de notificaciones - Móvil */
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
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.notification-panel-movil.show {
    display: block;
    animation: slideUpMovil 0.3s ease;
}

@keyframes slideUpMovil {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.notification-header-movil {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
    padding: 15px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.notification-header-movil h4 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.notification-header-actions-movil {
    display: flex;
    gap: 8px;
}

.notification-header-actions-movil button {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 11px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.notification-header-actions-movil button:hover {
    background: rgba(255, 255, 255, 0.3);
}

.notification-list-movil {
    max-height: 320px;
    overflow-y: auto;
}

.notification-item-movil {
    padding: 14px 18px;
    border-bottom: 1px solid rgba(139, 92, 246, 0.15);
    cursor: pointer;
    transition: background 0.2s ease;
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.notification-item-movil:hover {
    background: rgba(139, 92, 246, 0.1);
}

.notification-item-movil:last-child {
    border-bottom: none;
}

.notification-icon-movil {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 14px;
}

.notification-icon-movil.type-1 {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
}

.notification-icon-movil.type-2 {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

.notification-icon-movil.type-3 {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
}

.notification-content-movil {
    flex: 1;
    min-width: 0;
}

.notification-title-movil {
    font-size: 13px;
    font-weight: 600;
    color: white;
    margin-bottom: 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.notification-desc-movil {
    font-size: 12px;
    color: rgba(255,255,255,0.6);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.notification-time-movil {
    font-size: 10px;
    color: rgba(139, 92, 246, 0.8);
    margin-top: 5px;
}

.notification-empty-movil {
    padding: 40px 20px;
    text-align: center;
    color: rgba(255,255,255,0.5);
}

.notification-empty-movil i {
    font-size: 40px;
    margin-bottom: 12px;
    display: block;
    color: rgba(139, 92, 246, 0.4);
}

.notification-empty-movil p {
    margin: 0;
    font-size: 14px;
}
</style>

<!-- Botón flotante de notificaciones -->
<button class="notification-bell-movil" id="notificationBellMovil" onclick="toggleNotificationPanelMovil()">
    <i class="fa-solid fa-bell"></i>
    <span class="notification-badge-movil" id="notificationBadgeMovil" style="display: none;">0</span>
</button>

<!-- Panel de notificaciones -->
<div class="notification-panel-movil" id="notificationPanelMovil">
    <div class="notification-header-movil">
        <h4><i class="fa-solid fa-bell"></i> Notificaciones</h4>
        <div class="notification-header-actions-movil">
            <button onclick="marcarTodasLeidasMovil()" title="Marcar todas como leídas">
                <i class="fa-solid fa-check-double"></i> Leer todas
            </button>
            <button onclick="toggleNotificationPanelMovil()" title="Cerrar">
                <i class="fa-solid fa-times"></i>
            </button>
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
// ====================== SISTEMA DE NOTIFICACIONES MÓVIL ======================
var notificationCheckIntervalMovil = null;

// Inicializar sistema de notificaciones
$(document).ready(function() {
    cargarNotificacionesMovil();
    notificationCheckIntervalMovil = setInterval(cargarNotificacionesMovil, 30000);
});

function cargarNotificacionesMovil() {
    $.ajax({
        url: '../admin/obtener_notificaciones_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            if (response.success) { actualizarUINotificacionesMovil(response.notificaciones, response.count); }
        },
        error: function() { console.log('Error al cargar notificaciones'); }
    });
}

function actualizarUINotificacionesMovil(notificaciones, count) {
    var $badge = $('#notificationBadgeMovil');
    var $bell = $('#notificationBellMovil');
    var $list = $('#notificationListMovil');
    
    if (count > 0) {
        $badge.text(count > 99 ? '99+' : count).show();
        $bell.addClass('has-notifications');
        if (!$bell.hasClass('notified')) {
            $bell.addClass('shake notified');
            setTimeout(function() { $bell.removeClass('shake'); }, 500);
        }
    } else {
        $badge.hide();
        $bell.removeClass('has-notifications notified');
    }
    
    if (notificaciones.length > 0) {
        var html = '';
        notificaciones.forEach(function(notif) {
            var iconClass = 'type-' + (notif.tipo || 1);
            var iconSymbol = getNotificationIconMovil(notif.tipo);
            html += '<div class="notification-item-movil" onclick="marcarNotificacionLeidaMovil(' + notif.id + ', this)">';
            html += '  <div class="notification-icon-movil ' + iconClass + '"><i class="fa-solid ' + iconSymbol + '"></i></div>';
            html += '  <div class="notification-content-movil">';
            html += '    <div class="notification-title-movil">' + escapeHtmlMovil(notif.titulo) + '</div>';
            html += '    <div class="notification-desc-movil">' + escapeHtmlMovil(notif.descripcion) + '</div>';
            html += '    <div class="notification-time-movil"><i class="fa-regular fa-clock"></i> ' + notif.fecha_corta + '</div>';
            html += '  </div>';
            html += '</div>';
        });
        $list.html(html);
    } else {
        $list.html('<div class="notification-empty-movil"><i class="fa-solid fa-bell-slash"></i><p>No hay notificaciones pendientes</p></div>');
    }
}

function getNotificationIconMovil(tipo) {
    switch(parseInt(tipo)) {
        case 1: return 'fa-signature';
        case 2: return 'fa-exclamation-circle';
        case 3: return 'fa-info-circle';
        default: return 'fa-bell';
    }
}

function toggleNotificationPanelMovil() {
    $('#notificationPanelMovil').toggleClass('show');
}

$(document).on('click', function(e) {
    if (!$(e.target).closest('#notificationPanelMovil, #notificationBellMovil').length) {
        $('#notificationPanelMovil').removeClass('show');
    }
});

function marcarNotificacionLeidaMovil(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php',
        type: 'POST',
        data: { cod_notificacion: codNotificacion },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $(element).fadeOut(300, function() {
                    $(this).remove();
                    cargarNotificacionesMovil();
                });
            }
        }
    });
}

function marcarTodasLeidasMovil() {
    Swal.fire({
        title: '¿Marcar todas como leídas?', text: 'Se marcarán todas las notificaciones pendientes como leídas', icon: 'question', showCancelButton: true, confirmButtonColor: '#8b5cf6', cancelButtonColor: '#6c757d', confirmButtonText: 'Sí, marcar todas', cancelButtonText: 'Cancelar', background: '#1a1f2e',color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { marcar_todas: 'si' },dataType: 'json',
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

function escapeHtmlMovil(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}

// ====================== GESTIÓN DE BANCO TIENDA ======================
function abrirModalAgregarBanco(codTienda, nombreTienda) {
    document.getElementById('banco_cod_tienda').value = codTienda;
    document.getElementById('banco_nombre_tienda').textContent = nombreTienda;
    
    // Cargar bancos disponibles
    $.ajax({
        url: '../admin/obtener_bancos_disponibles_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            var options = '<option value="">Seleccione un banco</option>';
            if (response.success && response.bancos) {
                response.bancos.forEach(function(banco) {
                    options += '<option value="' + banco.cod_banco + '">' + banco.nombre_banco + '</option>';
                });
            }
            $('#banco_select').html(options);
        },
        error: function() {
            $('#banco_select').html('<option value="">Error al cargar bancos</option>');
        }
    });
    
    document.getElementById('modalAgregarBanco').classList.add('show');
}

function cerrarModalAgregarBanco() {
    document.getElementById('modalAgregarBanco').classList.remove('show');
    $('#formAgregarBanco')[0].reset();
    document.getElementById('preview_certificado_banco').innerHTML = '<i class="fa-solid fa-cloud-upload-alt" style="font-size: 2rem; color: rgba(139, 92, 246, 0.6); margin-bottom: 0.5rem;"></i><p style="margin: 0; color: rgba(255,255,255,0.7); font-size: 0.85rem;">Clic para seleccionar archivo</p><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.7rem;">Imagen o documento (JPG, PNG, PDF, DOC)</p>';
}

function mostrarNombreArchivoBanco(input) {
    var preview = document.getElementById('preview_certificado_banco');
    if (input.files && input.files[0]) {
        var fileName = input.files[0].name;
        var fileSize = (input.files[0].size / 1024).toFixed(2);
        preview.innerHTML = '<i class="fa-solid fa-file-check" style="font-size: 2rem; color: #8b5cf6; margin-bottom: 0.5rem;"></i><p style="margin: 0; color: #8b5cf6; font-size: 0.85rem; font-weight: 600;">' + fileName + '</p><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.7rem;">' + fileSize + ' KB</p>';
    }
}

$('#formAgregarBanco').on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    Swal.fire({ title: 'Guardando...', html: '<i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #3b82f6;"></i>', showConfirmButton: false, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/agregar_banco_tienda_lider_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                cerrarModalAgregarBanco();
                Swal.fire({
                    icon: 'success', title: '¡Éxito!', text: response.mensaje || 'Cuenta bancaria registrada exitosamente', background: '#1a1f2e', color: 'white', confirmButtonColor: '#3b82f6', customClass: { container: 'swal-high-zindex' } }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje || 'No se pudo registrar la cuenta bancaria', background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error('Error:', error);
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo procesar la solicitud', background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' } });
        }
    });
});

// Cerrar modal al hacer clic fuera
document.getElementById('modalAgregarBanco').addEventListener('click', function(e) {
    if (e.target === this) { cerrarModalAgregarBanco(); }
});

// ====================== GESTIÓN DE VENDEDOR TIENDA ======================
function abrirModalAgregarVendedor(codTienda, nombreTienda, direccion, barrio, codDept, codMuni) {
    document.getElementById('vendedor_cod_tienda').value = codTienda;
    document.getElementById('vendedor_nombre_tienda').textContent = nombreTienda;
    
    // Pre-llenar ubicación si está disponible
    document.getElementById('vendedor_tienda_ubicacion').textContent = (direccion || '') + (barrio ? ' - ' + barrio : '');
    
    // Pre-llenar campos de ubicación para el vendedor (por defecto los de la tienda)
    if (direccion) document.getElementById('vend_direccion').value = direccion;
    if (barrio) document.getElementById('vend_barrio').value = barrio;
    
    // Cargar departamentos y pre-seleccionar si es necesario
    cargarDepartamentosVendedor('vend_');
    if (codDept) {
        setTimeout(function() {
            $('#vend_cod_departamento').val(codDept).trigger('change');
            if (codMuni) {
                // Función auxiliar para cargar municipios con preselección específica para prefijo
                $.ajax({
                    url: '../admin/obtener_municipios_ajax.php', type: 'GET', data: { cod_departamento: codDept }, dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            var selectMuni = $('#vend_cod_municipio');
                            selectMuni.empty();
                            selectMuni.append('<option value="">Seleccione un municipio *</option>');
                            $.each(response.municipios, function(index, muni) {
                                var isSelected = (muni.cod_municipio == codMuni) ? ' selected' : '';
                                selectMuni.append('<option value="' + muni.cod_municipio + '"' + isSelected + '>' + muni.nombre_municipio + '</option>');
                            });
                        }
                    }
                });
            }
        }, 800);
    }
    
    document.getElementById('modalAgregarVendedor').classList.add('show');
}

function cerrarModalAgregarVendedor() {
    document.getElementById('modalAgregarVendedor').classList.remove('show');
    $('#formAgregarVendedor')[0].reset();
}

$('#formAgregarVendedor').on('submit', function(e) {
    e.preventDefault();
    
    // Validar campos requeridos
    var nombres = $('#vend_nombres').val().trim();
    var apellidos = $('#vend_apellidos').val().trim();
    var identificacion = $('#vend_identificacion').val().trim();
    var telefono = $('#vend_telefono').val().trim();
    var correo = $('#vend_correo').val().trim();
    
    if (!nombres || !apellidos || !identificacion || !telefono || !correo) {
        Swal.fire({ icon: 'warning', title: 'Campos incompletos', text: 'Por favor completa todos los campos obligatorios', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    
    // Validar correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(correo)) {
        Swal.fire({ icon: 'warning', title: 'Correo inválido', text: 'Por favor ingresa un correo electrónico válido', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6', customClass: { container: 'swal-high-zindex' } });
        return;
    }

    var formData = new FormData(this);
    
    Swal.fire({ title: 'Registrando Vendedor...', html: '<i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #8b5cf6;"></i>', showConfirmButton: false, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/agregar_vendedor_tienda_lider_ajax.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                cerrarModalAgregarVendedor();
                Swal.fire({
                    icon: 'success',
                    title: '¡Vendedor Registrado!',
                    html: `
                        <p>${response.message}</p>
                        <div style="background: rgba(139, 92, 246, 0.1); padding: 10px; border-radius: 8px; margin-top: 15px; text-align: left;">
                            <p style="margin: 0; color: #8b5cf6;"><strong>Credenciales de acceso:</strong></p>
                            <p style="margin: 5px 0 0 0; color: white;">Usuario: ${response.usuario}</p>
                            <p style="margin: 2px 0 0 0; color: white;">Contraseña: ${response.contrasena_inicial}</p>
                        </div>
                    `,
                    background: '#1a1f2e',
                    color: 'white',
                    confirmButtonColor: '#8b5cf6',
                    customClass: { container: 'swal-high-zindex' }
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo registrar el vendedor', background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error('Error:', error);
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo procesar la solicitud', background: '#1a1f2e', color: 'white', confirmButtonColor: '#ef4444', customClass: { container: 'swal-high-zindex' } });
        }
    });
});

function archivarTienda(codTienda, nombre) {
    Swal.fire({
        title: '¿Archivar Tienda?',
        text: '¿Estás seguro de que deseas archivar la tienda ' + nombre + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6e7881',
        confirmButtonText: 'Sí, archivar',
        cancelButtonText: 'Cancelar',
        background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({ title: 'Archivando...', allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }, didOpen: () => { Swal.showLoading(); } });
            $.ajax({
                url: 'proceso_archivar_tienda_lider_movil_ajax.php', type: 'POST', data: { cod_tienda: codTienda }, dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ icon: 'success', title: '¡Archivada!', text: response.message, timer: 2000, timerProgressBar: true, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } }).then(() => { location.reload(); });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                    }
                },
                error: function() {
                    Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo procesar la solicitud.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                }
            });
        }
    });
}
</script>



<!-- Modal Confirmación Post-Registro -->
<div class="confirm-modal-overlay" id="modalConfirmacionRegistro">
    <div class="confirm-modal-box">
        <div class="confirm-success-header">
            <div class="confirm-success-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h3>¡Tienda Creada Exitosamente!</h3>
            <p>La tienda ha sido registrada correctamente</p>
            <div class="confirm-store-name" id="confirmNombreTienda"></div>
        </div>
        
        <div class="confirm-body">
            <p class="confirm-body-title">¿Qué deseas hacer ahora?</p>
            
            <div class="confirm-actions-grid">
                <!-- Opción: Crear Vendedores -->
                <div class="confirm-action-card vendedores" onclick="irCrearVendedores()">
                    <div class="confirm-action-icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="confirm-action-text">
                        <h4>Crear Vendedores</h4>
                        <p>Agrega vendedores a esta tienda</p>
                    </div>
                    <i class="fa-solid fa-chevron-right confirm-action-arrow"></i>
                </div>
                
                <!-- Opción: Crear Productos -->
                <div class="confirm-action-card productos" onclick="irCrearProductos()">
                    <div class="confirm-action-icon">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <div class="confirm-action-text">
                        <h4>Crear Productos</h4>
                        <p>Agrega productos al catálogo de la tienda</p>
                    </div>
                    <i class="fa-solid fa-chevron-right confirm-action-arrow"></i>
                </div>
            </div>
        </div>
        
        <div class="confirm-footer">
            <button class="confirm-skip-btn" onclick="cerrarConfirmacionYRecargar()">
                <i class="fa-solid fa-arrow-right"></i> Finalizar y volver a la lista
            </button>
        </div>
    </div>
</div>

<!-- Modal Registro de Vendedores -->
<div class="reg-modal-overlay" id="modalRegistroVendedor">
    <div class="reg-modal-container">
        <div class="reg-modal-header vendedor-theme">
            <h2><i class="fa-solid fa-user-plus"></i> Registrar Vendedor</h2>
            <button class="modal-close" onclick="cerrarModalVendedor()"><i class="fa-solid fa-times"></i></button>
        </div>
        
        <div class="reg-modal-body">
            <div class="reg-tienda-badge">
                <i class="fa-solid fa-store"></i>
                Tienda: <strong id="vendedorNombreTienda"></strong>
            </div>
            
            <form id="formRegistroVendedor" onsubmit="return false;">
                <input type="hidden" id="vendedor_cod_tienda" name="cod_tienda" value="">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Identificación (Cédula) *</label>
                        <input type="text" class="form-input" name="identificacion_tercero" id="vendedor_identificacion" placeholder="Ej: 1234567890" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nombres *</label>
                        <input type="text" class="form-input" name="nombre1_tercero" id="vendedor_nombre" placeholder="Ej: Juan Carlos" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Apellidos *</label>
                        <input type="text" class="form-input" name="apellido1_tercero" id="vendedor_apellido" placeholder="Ej: Pérez López" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" name="telefono1_tercero" id="vendedor_telefono" placeholder="Ej: 3001234567" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Correo *</label>
                    <input type="email" class="form-input" name="correo_tercero" id="vendedor_correo" placeholder="correo@email.com" required>
                </div>
                
                <button type="button" class="reg-submit-btn vendedor-theme" onclick="ejecutarRegistroVendedor()"><i class="fa-solid fa-user-plus"></i> Registrar Vendedor</button>
            </form>
            
            <div class="items-registrados" id="listaVendedoresRegistrados" style="display: none;">
                <div class="items-registrados-title">
                    <i class="fa-solid fa-users"></i> Vendedores Registrados<span class="badge-count" id="contadorVendedores">0</span>
                </div>
                <div id="vendedoresRegistradosList"></div>
            </div>
        </div>
        
        <div class="reg-modal-footer">
            <button class="reg-footer-btn back-btn" onclick="cerrarModalVendedor()"><i class="fa-solid fa-arrow-left"></i> Volver</button>
            <button class="reg-footer-btn finish-btn" onclick="finalizarVendedoresYPasarAProductos()"><i class="fa-solid fa-check"></i> Finalizar Vendedores</button>
        </div>
    </div>
</div>

<!-- Modal Registro de Productos -->
<div class="reg-modal-overlay" id="modalRegistroProducto">
    <div class="reg-modal-container">
        <div class="reg-modal-header producto-theme">
            <h2><i class="fa-solid fa-box-open"></i> Registrar Producto</h2>
            <button class="modal-close" onclick="cerrarModalProducto()"><i class="fa-solid fa-times"></i></button>
        </div>
        
        <div class="reg-modal-body producto-theme">
            <div class="reg-tienda-badge"><i class="fa-solid fa-store"></i>Tienda: <strong id="productoNombreTienda"></strong></div>
            
            <form id="formRegistroProducto" enctype="multipart/form-data" onsubmit="return false;">
                <input type="hidden" id="producto_cod_tienda" name="cod_tienda" value="">
                <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Código de Barras *</label>
                        <input type="text" class="form-input" name="cod_producto_barra" id="producto_codigo" placeholder="Ej: 7701234567890" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nombre del Producto *</label>
                        <input type="text" class="form-input" name="nombre_producto" id="producto_nombre" placeholder="Ej: Arroz Diana x 500g" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Precio de Compra ($)</label>
                        <input type="text" class="form-input" inputmode="numeric" id="producto_precio_compra" placeholder="$ 0" oninput="formatearPrecio(this)">
                        <input type="hidden" name="precio_compra_producto" id="precio_compra_producto_hidden" value="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Precio Venta ($) *</label>
                        <input type="text" class="form-input" inputmode="numeric" id="producto_precio_venta" placeholder="$ 0" oninput="formatearPrecio(this)">
                        <input type="hidden" name="precio_venta_producto" id="precio_venta_producto_hidden" value="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" name="cod_categoria" id="producto_categoria">
                            <option value="0">Sin categoría</option>
                            <?php 
                            if ($res_cat_prod && mysqli_num_rows($res_cat_prod) > 0) {
                                mysqli_data_seek($res_cat_prod, 0);
                                while ($cat = mysqli_fetch_assoc($res_cat_prod)) { ?>
                                    <option value="<?php echo $cat['cod_categoria']; ?>"><?php echo ucwords(strtolower($cat['nombre_categoria'])); ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Descripción</label>
                        <input type="text" class="form-input" name="descripcion_producto" id="producto_descripcion" placeholder="Opcional">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">IVA (%)</label>
                        <select class="form-select" name="iva_ptj" id="producto_iva">
                            <option value="0">0%</option>
                            <option value="5">5%</option>
                            <option value="19">19%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="cod_estado" id="producto_estado">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Imagen</label>
                        <input type="file" name="imagen_producto" id="producto_imagen" accept="image/*" class="form-input" onchange="previewImageProducto(this)">
                        <img id="preview_producto_img" class="image-preview" style="display:none; max-height: 100px; margin-top: 10px;">
                    </div>
                </div>
                
                <button type="button" class="reg-submit-btn producto-theme" onclick="ejecutarRegistroProducto()">
                    <i class="fa-solid fa-box-open"></i> Registrar Producto
                </button>
            </form>
            
            <div class="items-registrados" id="listaProductosRegistrados" style="display: none;">
                <div class="items-registrados-title">
                    <i class="fa-solid fa-boxes-stacked"></i> Productos Registrados
                    <span class="badge-count" id="contadorProductos">0</span>
                </div>
                <div id="productosRegistradosList"></div>
            </div>
        </div>
        
        <div class="reg-modal-footer">
            <button class="reg-footer-btn back-btn" onclick="cerrarModalProducto()"><i class="fa-solid fa-arrow-left"></i> Volver</button>
            <button class="reg-footer-btn finish-btn" onclick="location.reload()"><i class="fa-solid fa-check"></i> Finalizar</button>
        </div>
    </div>
</div>

<!-- Modal Éxito Vendedor -->
<div class="confirm-modal-overlay" id="modalExitoVendedor">
    <div class="confirm-modal-box" style="max-width: 450px;">
        <div class="confirm-success-header" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
            <div class="confirm-success-icon"><i class="fa-solid fa-user-check"></i></div>
            <h3>¡Vendedor Registrado!</h3>
            <p>Se han generado las credenciales de acceso</p>
        </div>
        <div class="confirm-body">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <p style="color: rgba(255,255,255,0.6); margin-bottom: 0.5rem; font-size: 0.9rem;">Vendedor:</p>
                <h4 id="exitoVendedorNombre" style="color: white; font-size: 1.3rem; font-weight: 700;"></h4>
            </div>
            
            <div style="background: rgba(99, 102, 241, 0.05); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 16px; padding: 1.25rem;">
                 <div style="margin-bottom: 1rem;">
                    <label style="color: rgba(255,255,255,0.4); font-size: 0.7rem; display: block; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">USUARIO</label>
                    <div style="display: flex; justify-content: space-between; align-items: center; background: rgba(0,0,0,0.3); padding: 10px 15px; border-radius: 10px;">
                        <span id="exitoVendedorUsuario" style="color: white; font-family: 'Monaco', 'Consolas', monospace; font-size: 1.1rem; font-weight: 700;"></span>
                        <button onclick="copiarTexto(document.getElementById('exitoVendedorUsuario').textContent, this)" style="background: none; border: none; color: #8b5cf6; cursor: pointer; padding: 5px;"><i class="fa-solid fa-copy"></i></button>
                    </div>
                 </div>
                 <div>
                    <label style="color: rgba(255,255,255,0.4); font-size: 0.7rem; display: block; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">CONTRASEÑA</label>
                    <div style="display: flex; justify-content: space-between; align-items: center; background: rgba(0,0,0,0.3); padding: 10px 15px; border-radius: 10px;">
                        <span id="exitoVendedorPass" style="color: white; font-family: 'Monaco', 'Consolas', monospace; font-size: 1.1rem; font-weight: 700;"></span>
                        <button onclick="copiarTexto(document.getElementById('exitoVendedorPass').textContent, this)" style="background: none; border: none; color: #8b5cf6; cursor: pointer; padding: 5px;"><i class="fa-solid fa-copy"></i></button>
                    </div>
                 </div>
            </div>
        </div>
        <div class="confirm-footer">
            <button class="reg-submit-btn" onclick="cerrarExitoVendedor()" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); margin: 0;">
                <i class="fa-solid fa-check"></i> Entendido
            </button>
        </div>
    </div>
</div>

<!-- Modal Éxito Producto -->
<div class="confirm-modal-overlay" id="modalExitoProducto">
    <div class="confirm-modal-box" style="max-width: 400px;">
        <div class="confirm-success-header" style="background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);">
            <div class="confirm-success-icon"><i class="fa-solid fa-box-open"></i></div>
            <h3>¡Producto Registrado!</h3>
            <p>El producto se agregó correctamente</p>
        </div>
        <div class="confirm-body" style="text-align: center; padding: 1.5rem;">
            <p style="color: rgba(255,255,255,0.6); margin-bottom: 0.25rem; font-size: 0.9rem;">Producto:</p>
            <h4 id="exitoProductoNombre" style="color: white; font-size: 1.3rem; margin-bottom: 1rem; font-weight: 700;"></h4>
            <div style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2); padding: 10px; border-radius: 10px; display: inline-block;">
                <p style="color: rgba(255,255,255,0.8); margin: 0; font-size: 0.9rem;">Precio de venta: <strong style="color: #f59e0b; font-size: 1.1rem;" id="exitoProductoPrecio"></strong></p>
            </div>
        </div>
        <div class="confirm-footer">
            <button class="reg-submit-btn" onclick="cerrarExitoProducto()" style="background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%); margin: 0;">
                <i class="fa-solid fa-check"></i> Aceptar
            </button>
        </div>
    </div>
</div>

</body>
</html>

