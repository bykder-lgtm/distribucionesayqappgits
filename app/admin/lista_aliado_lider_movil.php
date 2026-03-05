<?php 
$nombre_pagina          = "Mis Aliados";
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
    border: 1px solid rgba(139, 92, 246, 0.3);
}
.ql-container.ql-snow {
    background: rgba(139, 92, 246, 0.05);
    border-radius: 0 0 12px 12px;
    border: 1px solid rgba(139, 92, 246, 0.3);
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
    overflow-x: hidden;
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
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(139, 92, 246, 0.4);
}

@media (max-width: 768px) {
    .page-header {
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 1.25rem;
    }
}

@media (max-width: 480px) {
    .page-header {
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
    }
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

@media (max-width: 768px) {
    .page-header h1 {
        font-size: 1.35rem;
        gap: 0.6rem;
    }
}

@media (max-width: 480px) {
    .page-header h1 {
        font-size: 1.2rem;
        gap: 0.5rem;
    }
    
    .page-header h1 i {
        font-size: 1.1rem;
    }
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
    flex-wrap: wrap;
}

@media (max-width: 480px) {
    .header-stats {
        gap: 0.75rem;
        margin-top: 0.75rem;
    }
}

.header-stat {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 12px;
    text-align: center;
    min-width: 80px;
}

@media (max-width: 480px) {
    .header-stat {
        padding: 0.4rem 0.75rem;
        border-radius: 10px;
        min-width: 70px;
        flex: 1;
    }
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
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 16px;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

@media (max-width: 768px) {
    .search-bar {
        border-radius: 14px;
        padding: 0.85rem;
    }
}

@media (max-width: 480px) {
    .search-bar {
        border-radius: 12px;
        padding: 0.75rem;
        gap: 0.6rem;
    }
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

@media (max-width: 768px) {
    .add-button {
        border-radius: 14px;
        padding: 0.9rem;
        font-size: 0.95rem;
    }
}

@media (max-width: 480px) {
    .add-button {
        border-radius: 12px;
        padding: 0.85rem;
        font-size: 0.9rem;
        margin-bottom: 1.25rem;
    }
}

.add-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 30px rgba(139, 92, 246, 0.5);
}

/* Ally List */
.ally-list {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

@media (max-width: 768px) {
    .ally-list {
        gap: 0.85rem;
    }
}

@media (max-width: 640px) {
    .ally-list {
        gap: 0.75rem;
    }
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

.ally-card {
    background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 16px;
    padding: 1rem;
    transition: all 0.3s ease;
}

@media (max-width: 768px) {
    .ally-card {
        border-radius: 14px;
        padding: 0.9rem;
    }
}

@media (max-width: 480px) {
    .ally-card {
        border-radius: 12px;
        padding: 0.85rem;
    }
}

.ally-card:hover {
    border-color: #8b5cf6;
    box-shadow: 0 5px 20px rgba(139, 92, 246, 0.2);
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
    font-size: 1.05rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.25rem;
    line-height: 1.3;
    word-break: break-word; /* Permite que nombres largos bajen de línea */
}

.ally-doc {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.5);
}

.ally-role {
    padding: 0.25rem 0.5rem;
    border-radius: 16px;
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
    background: rgba(139, 92, 246, 0.2);
    color: #8b5cf6;
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
    color: #8b5cf6;
    width: 16px;
    font-size: 0.8rem;
    text-align: center;
}

.ally-detail span {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.8);
    word-break: break-word; /* Evita que correos o textos largos rompan el layout */
    line-height: 1.4;
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
    padding: 0;
}

@media (max-width: 768px) {
    .modal-overlay {
        padding: 0;
    }
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

@media (max-width: 768px) {
    .modal-content {
        border-radius: 20px 20px 0 0;
        max-height: 92vh;
    }
}

@media (max-width: 480px) {
    .modal-content {
        border-radius: 16px 16px 0 0;
        max-height: 95vh;
        max-width: 100%;
    }
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
    border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    position: sticky;
    top: 0;
    background: #1a1f2e;
    z-index: 10;
}

@media (max-width: 480px) {
    .modal-header {
        padding: 1.25rem 1rem;
    }
}

.modal-body {
    padding: 1.5rem;
}

@media (max-width: 480px) {
    .modal-body {
        padding: 1rem;
    }
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

@media (max-width: 480px) {
    .modal-header h2 {
        font-size: 1.1rem;
        gap: 0.4rem;
    }
    
    .modal-header h2 i {
        font-size: 1rem;
    }
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
    transition: all 0.3s ease;
    flex-shrink: 0;
}

@media (max-width: 480px) {
    .modal-close {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        font-size: 0.9rem;
    }
}

.modal-close:hover {
    background: rgba(239, 68, 68, 0.4);
    transform: scale(1.05);
}

/* Form Styles */
.form-group {
    margin-bottom: 1rem;
}

@media (max-width: 480px) {
    .form-group {
        margin-bottom: 0.85rem;
    }
}

.form-label {
    display: block;
    color: rgba(255,255,255,0.8);
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

@media (max-width: 480px) {
    .form-label {
        font-size: 0.8rem;
        margin-bottom: 0.4rem;
    }
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

@media (max-width: 480px) {
    .form-input, .form-select {
        padding: 0.7rem 0.85rem;
        font-size: 0.9rem;
        border-radius: 10px;
    }
}

.form-select option {
    background-color: #1a1f2e;
    color: white;
}

.form-input:focus, .form-select:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
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
}

@media (max-width: 480px) {
    .submit-btn {
        padding: 0.9rem;
        font-size: 0.95rem;
        border-radius: 10px;
        margin-top: 1.5rem;
    }
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(139, 92, 246, 0.4);
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

@media (max-width: 480px) {
    .bottom-nav {
        padding: 0.6rem 0;
    }
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

@media (max-width: 480px) {
    .nav-item {
        padding: 0.4rem 0.75rem;
        border-radius: 10px;
    }
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

@media (max-width: 480px) {
    .nav-item i {
        font-size: 1.15rem;
        margin-bottom: 0.2rem;
    }
}

.nav-item span {
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
}

@media (max-width: 480px) {
    .nav-item span {
        font-size: 0.6rem;
    }
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

@media (max-width: 480px) {
    .empty-state {
        padding: 2.5rem 1rem;
    }
}

.empty-state i {
    font-size: 4rem;
    color: rgba(139, 92, 246, 0.3);
    margin-bottom: 1rem;
}

@media (max-width: 480px) {
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 0.75rem;
    }
}

.empty-state h3 {
    color: white;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

@media (max-width: 480px) {
    .empty-state h3 {
        font-size: 1.1rem;
    }
}

.empty-state p {
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem;
}

@media (max-width: 480px) {
    .empty-state p {
        font-size: 0.85rem;
    }
}

/* Animations */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-in {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease, transform 0.6s ease;
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

.action-btn {
    flex: 1;
    padding: 0.7rem;
    border-radius: 10px;
    border: none;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    transition: all 0.3s ease;
    text-decoration: none;
    min-width: 0;
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
    background: rgba(139, 92, 246, 0.2);
    color: #8b5cf6;
}

.action-btn.view:hover {
    background: #8b5cf6;
    color: white;
}

.action-btn.share {
    background: rgba(139, 92, 246, 0.2);
    color: #a78bfa;
}

.action-btn.share:hover {
    background: #8b5cf6;
    color: white;
    transform: translateY(-2px);
}

/* Compartir Docs - Todos los documentos cargados */
.action-btn.share-complete {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    position: relative;
}

.action-btn.share-complete:hover {
    background: #10b981;
    color: white;
    transform: translateY(-2px);
}

/* Compartir Docs - Documentos parcialmente cargados */
.action-btn.share-partial {
    background: rgba(245, 158, 11, 0.2);
    color: #f59e0b;
    position: relative;
}

.action-btn.share-partial:hover {
    background: #f59e0b;
    color: white;
    transform: translateY(-2px);
}

.docs-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.3);
    border-radius: 6px;
    padding: 0.1rem 0.35rem;
    font-size: 0.65rem;
    font-weight: 700;
    margin-left: 0.25rem;
}

/* Detail Modal Specifics */
.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    gap: 1rem;
    flex-wrap: wrap;
}

@media (max-width: 480px) {
    .detail-row {
        padding: 0.65rem 0;
        gap: 0.5rem;
    }
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label-modal {
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem;
}

@media (max-width: 480px) {
    .detail-label-modal {
        font-size: 0.85rem;
    }
}

.detail-value-modal {
    color: white;
    font-weight: 600;
    text-align: right;
    word-break: break-word;
}

@media (max-width: 480px) {
    .detail-value-modal {
        font-size: 0.9rem;
    }
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
    background-color: #8b5cf6 !important;
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

/* Loader */
#loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999; /* Highest priority */
    background: rgba(15, 20, 25, 0.98);
    backdrop-filter: blur(10px);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    transition: opacity 0.6s ease-out;
}

.loader {
    width: 56px;
    height: 56px;
    border: 5px solid rgba(255, 255, 255, 0.1);
    border-top-color: #8b5cf6;
    border-right-color: #7c3aed;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 0.8s linear infinite;
    margin-bottom: 24px;
    box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
}

@media (max-width: 480px) {
    .loader {
        width: 48px;
        height: 48px;
        border-width: 4px;
        margin-bottom: 20px;
    }
}

.loader-text {
    color: #fff;
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    animation: pulse 1.5s ease-in-out infinite;
    text-shadow: 0 2px 10px rgba(139, 92, 246, 0.5);
}

@media (max-width: 480px) {
    .loader-text {
        font-size: 0.95rem;
        letter-spacing: 1px;
    }
}

@keyframes rotation {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes pulse {
    0%, 100% { opacity: 0.6; }
    50% { opacity: 1; }
}

/* Modal Responsive */
.modal-content {
    max-height: 90vh;
    overflow-y: auto;
}

@media (max-width: 768px) {
    .modal-content {
        max-width: 95%;
        margin: 0.5rem;
        max-height: 92vh;
    }
}

@media (max-width: 480px) {
    .modal-content {
        max-width: 100%;
        margin: 0;
        border-radius: 16px 16px 0 0;
        max-height: 95vh;
    }
    
    .form-row {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 0.75rem;
    }
    
    .form-row .form-group {
        width: 100%;
    }
}

/* Responsive Modal Credit Lines */
.credit-line-item {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
    padding: 0.75rem;
    background: rgba(139, 92, 246, 0.08);
    border: 1px solid rgba(139, 92, 246, 0.15);
    border-radius: 10px;
}

.credit-line-check {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex: 1;
    min-width: 200px; /* Asegura que el nombre tenga espacio */
}

.credit-line-inputs {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    flex: 1;
    justify-content: flex-end;
}

.input-group-mini {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(0,0,0,0.2);
    padding: 0.4rem 0.6rem;
    border-radius: 6px;
}

@media (max-width: 500px) {
    .credit-line-item {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .credit-line-inputs {
        width: 100%;
        justify-content: space-between;
    }
    
    .input-group-mini {
        flex: 1;
        justify-content: center;
    }
}

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
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.2);
    color: #8b5cf6;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    font-size: 0.9rem;
}

.pagination-btn i {
    font-size: 1.1rem;
}

.pagination-btn:hover:not(.disabled) {
    background: #8b5cf6;
    color: white !important;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3);
    border-color: #8b5cf6;
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
    background: rgba(139, 92, 246, 0.05);
    height: 42px;
    display: flex;
    align-items: center;
    border-radius: 12px;
    border: 1px solid rgba(139, 92, 246, 0.1);
    letter-spacing: 0.5px;
}

.pagination-info span {
    color: #8b5cf6;
    margin: 0 4px;
}

@media (max-width: 480px) {
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
<!-- Select2 CDN -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* Estilos personalizados para Select2 - Tema Oscuro/Violeta */
.select2-container--default .select2-selection--single {
    background-color: rgba(139, 92, 246, 0.05) !important;
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
    font-family: 'Inter', sans-serif !important;
    font-size: 0.95rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 48px !important;
    right: 10px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: #8b5cf6 transparent transparent transparent !important;
}

.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
    border-color: transparent transparent #8b5cf6 transparent !important;
}

.select2-container--default .select2-selection--single:focus, 
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #8b5cf6 !important;
    box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1) !important;
    background: rgba(139, 92, 246, 0.1) !important;
}

.select2-dropdown {
    background-color: #1a1f2e !important;
    border: 1px solid rgba(139, 92, 246, 0.5) !important;
    border-radius: 12px !important;
    overflow: hidden !important;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5) !important;
    z-index: 9999 !important;
}

.select2-search--dropdown {
    padding: 10px !important;
    background-color: rgba(139, 92, 246, 0.05) !important;
}

.select2-search--dropdown .select2-search__field {
    background-color: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(139, 92, 246, 0.3) !important;
    color: white !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    outline: none !important;
}

.select2-results__option {
    padding: 10px 15px !important;
    color: rgba(255,255,255,0.8) !important;
    font-family: 'Inter', sans-serif !important;
    font-size: 0.9rem !important;
}

.select2-results__option--highlighted[aria-selected] {
    background-color: #8b5cf6 !important;
    color: white !important;
}

.select2-results__option[aria-selected=true] {
    background-color: rgba(139, 92, 246, 0.2) !important;
    color: white !important;
}

/* Fix para que Select2 se vea bien dentro del modal con z-index alto */
.select2-container {
    z-index: 10001 !important;
}
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<!-- Loader Container -->
<div id="loader-wrapper">
    <span class="loader"></span>
    <span class="loader-text">Cargando aliados...</span>
</div>

<?php
// Parámetros de paginación
$registros_por_pagina = 30;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina <= 0) $pagina = 1;
$inicio = ($pagina - 1) * $registros_por_pagina;

// Obtener parámetros de búsqueda
$busqueda = isset($_GET['busqueda']) ? trim(mysqli_real_escape_string($conectar, $_GET['busqueda'])) : '';
$cod_aliado_get = isset($_GET['cod_administrador']) ? trim(mysqli_real_escape_string($conectar, $_GET['cod_administrador'])) : '';

$filtro_doc = isset($_GET['filtro_doc']) ? mysqli_real_escape_string($conectar, $_GET['filtro_doc']) : '';
$cod_coordinador_filtro = isset($_GET['cod_coordinador']) ? (int)$_GET['cod_coordinador'] : 0;
// Consulta base para contar el total de registros (OPTIMIZADO)
$sql_conteo = "SELECT COUNT(*) as total FROM tbl15_administrador a WHERE a.cod_seguridad = '23' AND (a.cod_lider = '$cod_administrador' OR a.cod_coordinador IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador') OR a.cod_asesor IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador'))";

if (!empty($cod_aliado_get)) { $sql_conteo .= " AND a.cod_administrador = '$cod_aliado_get'"; }
if (!empty($busqueda)) { $sql_conteo .= " AND (a.cod_administrador = '$busqueda' OR a.cod_administrador LIKE '$busqueda' OR a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%' OR a.nit_razon_social LIKE '%$busqueda%' OR a.nombre_razon_social LIKE '%$busqueda%')"; }
if ($cod_coordinador_filtro > 0) { $sql_conteo .= " AND a.cod_coordinador = '$cod_coordinador_filtro'"; }

// Filtro de documentación
if ($filtro_doc == '1') {
    $sql_conteo .= " AND (a.url_documentacion_rut_aliado != '' OR a.url_documentacion_camaracomercio_aliado != '' OR (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '2') {
    $sql_conteo .= " AND (a.url_documentacion_rut_aliado != '' AND a.url_documentacion_camaracomercio_aliado != '' AND (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '3') {
    $sql_conteo .= " AND (a.url_documentacion_rut_aliado = '' AND a.url_documentacion_camaracomercio_aliado = '' AND (a.url_documentacion_cedula_aliado IS NULL OR a.url_documentacion_cedula_aliado = ''))";
}

$res_conteo = mysqli_query($conectar, $sql_conteo);
$row_conteo = mysqli_fetch_assoc($res_conteo);
$total_registros = $row_conteo['total'];
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Consulta de aliados con LIMIT
$sql = "SELECT a.cod_administrador, a.cedula, a.nombres, a.apellidos, a.cuenta, a.correo, a.telefono, a.nombres_apellidos_tercero, a.cod_estado_activacion_usuario, a.comision_ptj, a.cod_asesor, a.cod_lider, a.cod_coordinador, a.url_documentacion_rut_aliado, a.url_documentacion_camaracomercio_aliado, a.url_documentacion_cedula_aliado, a.nombre_tipo_cliente, a.cod_tipo_sector, a.nit_razon_social, a.nombre_razon_social, a.direccion_tercero, a.barrio_tercero, a.cod_departamento, a.cod_municipio, a.fecha, a.fecha_hora 
FROM tbl15_administrador a WHERE a.cod_seguridad = '23' AND (a.cod_lider = '$cod_administrador' OR a.cod_coordinador IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador') OR a.cod_asesor IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador'))";
if (!empty($cod_aliado_get)) { $sql .= " AND a.cod_administrador = '$cod_aliado_get'"; }
if (!empty($busqueda)) { $sql .= " AND (a.cod_administrador = '$busqueda' OR a.cod_administrador LIKE '$busqueda' OR a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%' OR a.nit_razon_social LIKE '%$busqueda%' OR a.nombre_razon_social LIKE '%$busqueda%')"; }
if ($cod_coordinador_filtro > 0) { $sql .= " AND a.cod_coordinador = '$cod_coordinador_filtro'"; }

if ($filtro_doc == '1') {
    $sql .= " AND (a.url_documentacion_rut_aliado != '' OR a.url_documentacion_camaracomercio_aliado != '' OR (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '2') {
    $sql .= " AND (a.url_documentacion_rut_aliado != '' AND a.url_documentacion_camaracomercio_aliado != '' AND (a.url_documentacion_cedula_aliado IS NOT NULL AND a.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '3') {
    $sql .= " AND (a.url_documentacion_rut_aliado = '' AND a.url_documentacion_camaracomercio_aliado = '' AND (a.url_documentacion_cedula_aliado IS NULL OR a.url_documentacion_cedula_aliado = ''))";
}

$sql .= " ORDER BY a.cod_administrador DESC LIMIT $inicio, $registros_por_pagina";
$resultado = mysqli_query($conectar, $sql);

// Fallback por si falla la columna de cédula (mismo limit)
if (!$resultado) {
    $sql = "SELECT a.cod_administrador, a.cedula, a.nombres, a.apellidos, a.cuenta, a.correo, a.telefono, a.nombres_apellidos_tercero, a.cod_estado_activacion_usuario, a.comision_ptj, 
    a.cod_asesor, a.url_documentacion_rut_aliado, a.url_documentacion_camaracomercio_aliado, a.nombre_tipo_cliente, a.cod_tipo_sector, a.nit_razon_social, a.nombre_razon_social, a.direccion_tercero, a.barrio_tercero, a.cod_departamento, a.cod_municipio, a.fecha, a.fecha_hora 
    FROM tbl15_administrador a WHERE a.cod_seguridad = '23' AND (a.cod_lider = '$cod_administrador' OR a.cod_coordinador IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador')OR a.cod_asesor IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador'))";

    if (!empty($cod_aliado_get)) { $sql .= " AND a.cod_administrador = '$cod_aliado_get'"; }
    if (!empty($busqueda)) { $sql .= " AND (a.cod_administrador = '$busqueda' OR a.cod_administrador LIKE '$busqueda' OR a.cedula LIKE '%$busqueda%' OR a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%' OR a.nit_razon_social LIKE '%$busqueda%' OR a.nombre_razon_social LIKE '%$busqueda%')"; }
    if ($cod_coordinador_filtro > 0) { $sql .= " AND a.cod_coordinador = '$cod_coordinador_filtro'"; }

    if ($filtro_doc == '1') { $sql .= " AND (a.url_documentacion_rut_aliado != '' OR a.url_documentacion_camaracomercio_aliado != '')"; } elseif ($filtro_doc == '2') { $sql .= " AND (a.url_documentacion_rut_aliado != '' AND a.url_documentacion_camaracomercio_aliado != '')"; } elseif ($filtro_doc == '3') { $sql .= " AND (a.url_documentacion_rut_aliado = '' AND a.url_documentacion_camaracomercio_aliado = '')"; }
    $sql .= " ORDER BY a.cod_administrador DESC LIMIT $inicio, $registros_por_pagina";
    $resultado = mysqli_query($conectar, $sql);
}
// Consultas para combos - Líder (20)
$sql_lider = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '20' ORDER BY nombres_apellidos_tercero ASC";
$res_lider = mysqli_query($conectar, $sql_lider);
// Consultas para combos - lider (21)
$sql_coord = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '21' ORDER BY nombres_apellidos_tercero ASC";
$res_coord = mysqli_query($conectar, $sql_coord);
// Consultas para combos - Asesor (22)// Por defecto se preselecciona el actual
$sql_asesor = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '22' ORDER BY nombres_apellidos_tercero ASC";
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
?>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-users"></i> Mis Aliados</h1>
        <p>Gestiona tu red de aliados estratégicos</p>
        <div class="header-stats">
            <div class="header-stat">
                <div class="header-stat-value"><?php echo $total_registros; ?></div>
                <div class="header-stat-label">Total</div>
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
    <!-- Add Button -->
    <button class="add-button animate-in delay-1" onclick="abrirModal()"><i class="fa-solid fa-plus"></i>Registrar Nuevo Aliado</button>

    <!-- List -->
    <div class="ally-list" id="allyList">
        <?php if ($total_registros > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($resultado)): 
                $nombre_completo = !empty($row['nombres_apellidos_tercero']) ? $row['nombres_apellidos_tercero'].' ('.$row['nombres'].' '.$row['apellidos'].')' : trim($row['nombres'].' '.$row['apellidos']);
                $cod_estado = $row['cod_estado_activacion_usuario'];
                // Determinar estado y colores
                if ($cod_estado == '1') { $estado_texto = 'Activo'; $estado_bg = 'rgba(139, 92, 246, 0.2)'; $estado_color = '#8b5cf6'; } elseif ($cod_estado == '2') { $estado_texto = 'En Espera'; $estado_bg = 'rgba(245, 158, 11, 0.2)'; $estado_color = '#f59e0b'; } else { $estado_texto = 'Inactivo'; $estado_bg = 'rgba(239, 68, 68, 0.2)'; $estado_color = '#ef4444'; }
                // Obtener tiendas asociadas a este aliado
                $cod_aliado = $row['cod_administrador'];
                $sql_tiendas = "SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE cod_aliado_estrategico = '$cod_aliado' LIMIT 3";
                $res_tiendas = mysqli_query($conectar, $sql_tiendas);
                $tiendas_arr = [];
                while($t = mysqli_fetch_assoc($res_tiendas)) { $tiendas_arr[] = '<a href="ver_detalle_tienda_lider_movil.php?cod_tienda=' . $t['cod_tienda'] . '" style="color: #8b5cf6; text-decoration: underline; font-weight: 600;">' . htmlspecialchars($t['nombre_tienda']) . '</a>'; }
                $tiendas_texto = count($tiendas_arr) > 0 ? implode(', ', $tiendas_arr) : 'Sin tiendas';
                // Obtener líneas de crédito asociadas a este aliado
                $sql_lineas_credito = "SELECT ec.nombre_entidad_crediticia, peca.interes_ptj 
                FROM tbl15_parametrizacion_entidad_crediticia_aliado peca INNER JOIN tbl15_entidad_crediticia ec ON peca.cod_entidad_crediticia = ec.cod_entidad_crediticia 
                WHERE peca.cod_aliado_estrategico = '$cod_aliado' AND peca.cod_estado = '1' ORDER BY ec.cod_posicion ASC";
                $res_lineas_credito = mysqli_query($conectar, $sql_lineas_credito);
                $lineas_credito_html = '';
                $count_lineas = 0;
                while($lc = mysqli_fetch_assoc($res_lineas_credito)) { 
                    $lineas_credito_html .= '<span style="display: inline-block; background: rgba(139, 92, 246, 0.15); color: #8b5cf6; padding: 0.2rem 0.5rem; border-radius: 8px; font-size: 0.7rem; font-weight: 600; margin: 0.15rem;">' . htmlspecialchars($lc['nombre_entidad_crediticia']) . ' <strong>' . number_format($lc['interes_ptj'], 2) . '%</strong></span> ';
                    $count_lineas++;
                }
                $lineas_credito_texto = $count_lineas > 0 ? $lineas_credito_html : '<span style="color: rgba(255,255,255,0.5); font-size: 0.75rem;">Sin entidades</span>';
            ?>
            <div class="ally-card animate-in delay-2">
                <div class="ally-header">
                    <div class="ally-info">
                        <div class="ally-name"><?php echo ucwords(strtolower($nombre_completo)); ?></div>
                        <div class="ally-doc">
                            CC: <?php echo $row['cedula']; ?> 
                            <?php if(!empty($row['fecha'])): ?>
                            <span style="margin-left: 0.5rem; color: rgba(255,255,255,0.4);">•</span>
                            <span style="margin-left: 0.5rem;"><i class="fa-solid fa-calendar-day" style="color: #8b5cf6; font-size: 0.7rem;"></i> <?php echo date('d/m/Y', strtotime($row['fecha'])); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <span class="ally-role" style="background: <?php echo $estado_bg; ?>; color: <?php echo $estado_color; ?>;">
                        <?php echo $estado_texto; ?>
                    </span>
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
                            <i class="fa-solid fa-credit-card" style="color: #8b5cf6; font-size: 0.8rem; margin-top: 0.25rem; flex-shrink: 0;"></i>
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

                <div class="ally-actions">
                    <a href="ver_detalle_aliado_lider_movil.php?cod_administrador=<?php echo $row['cod_administrador']; ?>" class="action-btn view"><i class="fa-solid fa-eye"></i> Detalles</a>
                    <button class="action-btn edit" onclick="abrirModalEditar(<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>)"><i class="fa-solid fa-edit"></i> Editar y Agregar</button>
                    <?php
                    $tiene_rut = !empty($row['url_documentacion_rut_aliado']);
                    $tiene_camara = !empty($row['url_documentacion_camaracomercio_aliado']);
                    $tiene_cedula = isset($row['url_documentacion_cedula_aliado']) && !empty($row['url_documentacion_cedula_aliado']);
                    $total_docs = ($tiene_rut ? 1 : 0) + ($tiene_camara ? 1 : 0) + ($tiene_cedula ? 1 : 0);
                    if ($total_docs == 3): ?>
                    <button class="action-btn share-complete" onclick="compartirDocumentacion(<?php echo $row['cod_administrador']; ?>)"><i class="fa-solid fa-circle-check"></i> Docs <span class="docs-badge"><?php echo $total_docs; ?>/3</span></button>
                    <?php elseif ($total_docs > 0): ?>
                    <button class="action-btn share-partial" onclick="compartirDocumentacion(<?php echo $row['cod_administrador']; ?>)"><i class="fa-solid fa-file-circle-exclamation"></i> Docs <span class="docs-badge"><?php echo $total_docs; ?>/3</span></button>
                    <?php else: ?>
                    <button class="action-btn share" disabled style="opacity: 0.5; cursor: not-allowed;" title="El aliado no ha cargado documentos">
                        <i class="fa-solid fa-share-nodes"></i> Compartir Docs
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state"><i class="fa-solid fa-users-slash"></i><h3>No hay aliados</h3><p>No se encontraron registros</p></div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_paginas > 1): ?>
    <div class="pagination-container animate-in delay-2">
        <a href="?pagina=1&busqueda=<?php echo urlencode($busqueda); ?>&filtro_doc=<?php echo urlencode($filtro_doc); ?>" 
           class="pagination-btn <?php echo $pagina == 1 ? 'disabled' : ''; ?>" title="Primera página">
            <i class="fa-solid fa-angles-left"></i>
        </a>
        <a href="?pagina=<?php echo max(1, $pagina - 1); ?>&busqueda=<?php echo urlencode($busqueda); ?>&filtro_doc=<?php echo urlencode($filtro_doc); ?>" 
           class="pagination-btn <?php echo $pagina == 1 ? 'disabled' : ''; ?>">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        
        <?php 
        $rango = 2;
        $inicio_p = max(1, $pagina - $rango);
        $fin_p = min($total_paginas, $pagina + $rango);
        
        for ($i = $inicio_p; $i <= $fin_p; $i++): 
        ?>
        <a href="?pagina=<?php echo $i; ?>&busqueda=<?php echo urlencode($busqueda); ?>&filtro_doc=<?php echo urlencode($filtro_doc); ?>" 
           class="pagination-btn <?php echo $pagina == $i ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
        <?php endfor; ?>

        <a href="?pagina=<?php echo min($total_paginas, $pagina + 1); ?>&busqueda=<?php echo urlencode($busqueda); ?>&filtro_doc=<?php echo urlencode($filtro_doc); ?>" 
           class="pagination-btn <?php echo $pagina == $total_paginas ? 'disabled' : ''; ?>">
            <i class="fa-solid fa-angle-right"></i>
        </a>
        <a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo urlencode($busqueda); ?>&filtro_doc=<?php echo urlencode($filtro_doc); ?>" 
           class="pagination-btn <?php echo $pagina == $total_paginas ? 'disabled' : ''; ?>" title="Última página">
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

                <div class="form-group">
                    <label class="form-label" id="label_nombre_comercial">Nombre Comercial *</label>
                    <input type="text" class="form-input" id="nombres_apellidos_tercero" name="nombres_apellidos_tercero" required>
                    <small id="mensaje_identificacion" style="display:none; color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;"></small>
                </div>

                <div class="form-row">
                    <div class="group-group" id="container_nit_razon_social" style="display:none;">
                        <label class="form-label">NIT Razón Social *</label>
                        <input type="text" class="form-input" id="nit_razon_social" name="nit_razon_social">
                    </div>
                    <div class="form-group" id="container_nombre_razon_social" style="display:none;">
                        <label class="form-label">Razón Social *</label>
                        <input type="text" class="form-input" id="nombre_razon_social" name="nombre_razon_social">
                    </div>
                </div>

                <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin-bottom: 0.75rem; display: block;"><i class="fa-solid fa-building-columns"></i> Datos del Representante Legal</label>
                <div class="form-group">
                    <label class="form-label">Identificación *</label>
                    <input type="number" class="form-input" id="identificacion_tercero" name="identificacion_tercero" required>
                    <small id="mensaje_identificacion" style="display:none; color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;"></small>
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

                <label class="form-label" style="color: #8b5cf6; font-weight: 700; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.75rem; display: block;"><i class="fa-solid fa-sitemap"></i> Asignación de Jerarquía</label>
                <div style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Líder *</label>
                            <select class="form-select" id="cod_lider" name="cod_lider" required>
                                <option value="">Seleccione...</option>
                                <?php 
                                mysqli_data_seek($res_lider, 0);
                                while ($lider = mysqli_fetch_assoc($res_lider)): 
                                ?>
                                <option value="<?php echo $lider['cod_administrador']; ?>" <?php echo ($lider['cod_administrador'] == $cod_administrador) ? 'selected' : ''; ?>><?php echo $lider['nombres_apellidos_tercero']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Coordinador *</label>
                            <select class="form-select" id="cod_coordinador" name="cod_coordinador" required>
                                <option value="">Seleccione...</option>
                                <?php 
                                mysqli_data_seek($res_coord, 0);
                                while ($coord = mysqli_fetch_assoc($res_coord)): 
                                ?>
                                <option value="<?php echo $coord['cod_administrador']; ?>"><?php echo $coord['nombres_apellidos_tercero']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row" style="margin-top: 0.5rem;">
                        <div class="form-group">
                            <label class="form-label">Asesor *</label>
                            <select class="form-select" id="cod_asesor" name="cod_asesor" required>
                                <option value="">Seleccione...</option>
                                <?php 
                                mysqli_data_seek($res_asesor, 0);
                                while ($asesor = mysqli_fetch_assoc($res_asesor)): 
                                ?>
                                <option value="<?php echo $asesor['cod_administrador']; ?>"><?php echo $asesor['nombres_apellidos_tercero']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group" style="visibility: hidden;"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Departamento</label>
                        <select class="form-select" id="cod_departamento" name="cod_departamento" onchange="cargarMunicipiosRegistro(this.value)">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Municipio</label>
                        <select class="form-select" id="cod_municipio" name="cod_municipio">
                            <option value="">Primero seleccione departamento</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Municipio</label>
                        <select class="form-select" id="cod_municipio" name="cod_municipio">
                            <option value="">Primero seleccione departamento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-input" id="direccion_tercero" name="direccion_tercero" placeholder="Ej: Cra 10 #20-30">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Barrio</label>
                        <input type="text" class="form-input" id="barrio_tercero" name="barrio_tercero" placeholder="Ej: Centro, Santa Isabel...">
                    </div>
                    <div class="form-group" style="visibility: hidden;">
                    </div>
                </div>

                <!-- Parametrización de Lineas de Credito -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin-bottom: 0.75rem; display: block;"><i class="fa-solid fa-building-columns"></i> Lineas de Credito</label>
                    <div style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 0.75rem; max-height: 350px; overflow-y: auto;">
                        <?php 
                        mysqli_data_seek($res_entidades, 0);
                        while ($entidad = mysqli_fetch_assoc($res_entidades)): 
                        ?>
                        <div class="credit-line-item">
                            <div class="credit-line-check">
                                <input type="checkbox" name="entidades[]" value="<?php echo $entidad['cod_entidad_crediticia']; ?>" id="ent_<?php echo $entidad['cod_entidad_crediticia']; ?>" style="accent-color: #8b5cf6; width: 18px; height: 18px; cursor: pointer; margin: 0;">
                                <label for="ent_<?php echo $entidad['cod_entidad_crediticia']; ?>" style="color: rgba(255,255,255,0.95); font-size: 0.9rem; font-weight: 600; cursor: pointer; margin: 0; word-break: break-word;">
                                    <?php echo $entidad['nombre_entidad_crediticia']; ?>
                                </label>
                            </div>
                            
                            <div class="credit-line-inputs">
                                <div class="input-group-mini">
                                    <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">% Adtvo:</label>
                                    <input type="number" step="0.01" min="0" max="100" class="form-input" name="interes_<?php echo $entidad['cod_entidad_crediticia']; ?>" value="<?php echo $entidad['aliado_estrategico_interes_ptj']; ?>" placeholder="0.00" style="width: 70px; padding: 0.3rem 0.4rem; font-size: 0.8rem; text-align: center; border: none; background: rgba(255,255,255,0.1); color: white;">
                                </div>
                                <div class="input-group-mini">
                                    <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">Portal:</label>
                                    <input type="checkbox" name="activar_portal_<?php echo $entidad['cod_entidad_crediticia']; ?>" value="1" style="accent-color: #8b5cf6; width: 16px; height: 16px; cursor: pointer;">
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #8b5cf6; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Selecciona las lineas de credito disponibles para este aliado e ingresa el porcentaje de interés correspondiente.
                        </div>
                    </div>
                </div>

                <!-- Parametrización de Bancos -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin-bottom: 0.75rem; display: block;">
                        <i class="fa-solid fa-university"></i> Cuentas Bancarias
                    </label>
                    <div id="contenedor_bancos" style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 0.75rem; max-height: 350px; overflow-y: auto;">
                        <?php 
                        if ($res_bancos && mysqli_num_rows($res_bancos) > 0) {
                            mysqli_data_seek($res_bancos, 0);
                            while ($banco = mysqli_fetch_assoc($res_bancos)): 
                        ?>
                        <div style="margin-bottom: 0.5rem; padding: 0.6rem 0.75rem; background: rgba(139, 92, 246, 0.08); border: 1px solid rgba(139, 92, 246, 0.15); border-radius: 10px;">
                            <div style="display: grid; grid-template-columns: auto 1fr auto auto; align-items: center; gap: 0.75rem;">
                                <input type="checkbox" name="bancos[]" value="<?php echo $banco['cod_banco']; ?>" id="banco_<?php echo $banco['cod_banco']; ?>" style="accent-color: #8b5cf6; width: 18px; height: 18px; cursor: pointer; margin: 0;" onchange="toggleBancoInputs(<?php echo $banco['cod_banco']; ?>)">
                                <label for="banco_<?php echo $banco['cod_banco']; ?>" style="color: rgba(255,255,255,0.95); font-size: 0.9rem; font-weight: 600; cursor: pointer; margin: 0;">
                                    <?php echo $banco['nombre_banco']; ?>
                                </label>
                                <div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">
                                    <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">Número:</label>
                                    <input type="number" class="form-input banco-input" name="numero_cuenta_<?php echo $banco['cod_banco']; ?>" id="numero_cuenta_<?php echo $banco['cod_banco']; ?>" placeholder="123456789" style="width: 120px; padding: 0.3rem 0.4rem; font-size: 0.8rem;" disabled>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">
                                    <label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">Tipo:</label>
                                    <select class="form-select banco-input" name="tipo_cuenta_<?php echo $banco['cod_banco']; ?>" id="tipo_cuenta_<?php echo $banco['cod_banco']; ?>" style="width: 110px; padding: 0.3rem 0.4rem; font-size: 0.8rem; background-color: rgba(139, 92, 246, 0.1);" disabled>
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
                                    <input type="file" class="banco-input" name="certificado_banco_<?php echo $banco['cod_banco']; ?>" id="certificado_banco_<?php echo $banco['cod_banco']; ?>" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx" style="flex: 1; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.3rem; border-radius: 6px; font-size: 0.7rem;" disabled>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endwhile;
                        }
                        ?>
                    </div>
                    <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #8b5cf6; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Selecciona los bancos e ingresa el número de cuenta y tipo de cuenta para este aliado.
                        </div>
                    </div>
                </div>

                <!-- Documentación Legal -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin-bottom: 0.75rem; display: block;">
                        <i class="fa-solid fa-file-contract"></i> Documentación Legal
                    </label>
                    <div style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 0.75rem;">

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-id-card"></i> Cédula
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_cedula_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-pdf"></i> RUT (Registro Único Tributario)
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_rut_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-building"></i> Cámara de Comercio
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_camaracomercio_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <!--
                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-signature"></i> Contrato Firmado
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_contratofirma_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-alt"></i> Documento Extra 1 (Opcional)
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_extra1_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-alt"></i> Documento Extra 2 (Opcional)
                            </label>
                            <input type="file" class="form-input" name="url_documentacion_extra2_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>
                        -->

                    </div>
                    <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #8b5cf6; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Adjunta la documentación legal requerida para el aliado estratégico.
                        </div>
                    </div>
                </div>

                <div class="form-group" style="background: rgba(139, 92, 246, 0.08); border: 1px solid rgba(139, 92, 246, 0.25); border-radius: 12px; padding: 0.75rem 1rem;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; margin: 0;">
                        <input type="checkbox" id="crear_tienda_al_guardar" name="crear_tienda_al_guardar" value="1" checked style="accent-color: #8b5cf6; width: 20px; height: 20px; cursor: pointer;">
                        <span style="color: rgba(255,255,255,0.95); font-size: 0.95rem; font-weight: 600;"><i class="fa-solid fa-store" style="color: #8b5cf6; margin-right: 0.35rem;"></i> Crear Tienda al guardar</span>
                    </label>
                    <small style="display: block; color: rgba(255,255,255,0.5); font-size: 0.7rem; margin-top: 0.4rem; margin-left: 2.75rem;">Se creará automáticamente una tienda con los datos del aliado</small>
                </div>
                
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
                        <select class="form-select" id="edit_nombre_tipo_cliente" name="nombre_tipo_cliente" required onchange="cambiarTipoClienteEdit()">
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
                        <input type="text" class="form-input" name="nombres_apellidos_tercero" id="edit_nombres_apellidos_tercero" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Identificación *</label>
                        <input type="number" class="form-input" name="identificacion_tercero" id="edit_identificacion" required>
                    </div>
                </div>

                <div class="form-row" id="edit_row_razon_social" style="display:none;">
                    <div class="form-group" id="edit_container_nit_razon_social">
                        <label class="form-label">NIT Razón Social *</label>
                        <input type="text" class="form-input" id="edit_nit_razon_social" name="nit_razon_social">
                    </div>

                    <div class="form-group" id="edit_container_nombre_razon_social">
                        <label class="form-label">Razón Social *</label>
                        <input type="text" class="form-input" id="edit_nombre_razon_social" name="nombre_razon_social">
                    </div>
                </div>

                <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin-top: 1rem; margin-bottom: 0.75rem; display: block;">
                    <i class="fa-solid fa-building-columns"></i> Datos del Representante Legal
                </label>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-input" name="nombre1_tercero" id="edit_nombre" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellido *</label>
                        <input type="text" class="form-input" name="apellido1_tercero" id="edit_apellido" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" name="telefono1_tercero" id="edit_telefono" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo *</label>
                        <input type="email" class="form-input" name="correo_tercero" id="edit_correo" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Departamento</label>
                        <select class="form-select" id="edit_cod_departamento" name="cod_departamento" onchange="cargarMunicipiosEdicion(this.value)">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Municipio</label>
                        <select class="form-select" id="edit_cod_municipio" name="cod_municipio">
                            <option value="">Primero seleccione departamento</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-input" id="edit_direccion_tercero" name="direccion_tercero" placeholder="Ej: Cra 10 #20-30">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Barrio</label>
                        <input type="text" class="form-input" id="edit_barrio_tercero" name="barrio_tercero" placeholder="Ej: Centro, Santa Isabel...">
                    </div>
                </div>

                <label class="form-label" style="color: #8b5cf6; font-weight: 700; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.75rem; display: block;"><i class="fa-solid fa-sitemap"></i> Asignación de Jerarquía</label>
                <div style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Líder *</label>
                            <select class="form-select" id="edit_cod_lider" name="cod_lider" required>
                                <option value="">Seleccione</option>
                                <?php mysqli_data_seek($res_lider, 0);
                                while ($r = mysqli_fetch_assoc($res_lider)): ?>
                                <option value="<?php echo $r['cod_administrador']; ?>"><?php echo $r['nombres_apellidos_tercero']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Coordinador *</label>
                            <select class="form-select" id="edit_cod_coordinador" name="cod_coordinador" required>
                                <option value="">Seleccione</option>
                                <?php mysqli_data_seek($res_coord, 0);
                                while ($r = mysqli_fetch_assoc($res_coord)): ?>
                                <option value="<?php echo $r['cod_administrador']; ?>"><?php echo $r['nombres_apellidos_tercero']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row" style="margin-top: 0.5rem;">
                        <div class="form-group">
                            <label class="form-label">Asesor *</label>
                            <select class="form-select" id="edit_cod_asesor" name="cod_asesor" required>
                                <option value="">Seleccione</option>
                                <?php mysqli_data_seek($res_asesor, 0);
                                while ($r = mysqli_fetch_assoc($res_asesor)): ?>
                                <option value="<?php echo $r['cod_administrador']; ?>"><?php echo $r['nombres_apellidos_tercero']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group" style="visibility: hidden;"></div>
                    </div>
                </div>


                <!-- Sección de Credenciales de Acceso -->
                <div class="form-group">
                    <div style="border-top: 1px solid rgba(255,255,255,0.1); margin: 1rem 0; padding-top: 1rem;">
                        <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin-bottom: 0.75rem; display: block;">
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

                <div class="form-row" style="margin-top: 0.5rem;">
                    <div class="form-group">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="cod_estado_activacion_usuario" id="edit_estado" disabled style="background: rgba(100, 116, 139, 0.2); cursor: not-allowed; opacity: 0.7;"><option value="1">Activo</option><option value="2">En Espera para Activación</option><option value="3">Inactivo</option></select>
                        <input type="hidden" name="cod_estado_activacion_usuario" id="edit_estado_hidden">
                    </div>
                    <div class="form-group" style="visibility: hidden;"></div>
                </div>
                
                <div style="background: rgba(100, 116, 139, 0.1); border: 1px solid rgba(100, 116, 139, 0.3); border-radius: 8px; padding: 0.5rem; margin-top: -0.5rem; margin-bottom: 1rem;">
                    <div style="color: rgba(255,255,255,0.7); font-size: 0.75rem;">
                        <i class="fa-solid fa-info-circle" style="color: #94a3b8; margin-right: 0.35rem;"></i>
                        El estado no se puede modificar desde aquí.
                    </div>
                </div>

                <!-- Parametrización de Lineas de Credito -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                        <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin: 0;"><i class="fa-solid fa-building-columns"></i> Lineas de Credito</label>
                        <button type="button" onclick="abrirModalAgregarEntidad()" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.75rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; transition: all 0.3s ease; white-space: nowrap;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-plus-circle"></i> Agregar
                        </button>
                    </div>
                    <div id="contenedor_entidades_editar" style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 0.5rem; max-height: 300px; overflow-y: auto;">
                        <div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                            <p style="margin: 0; font-size: 0.85rem;">Cargando entidades...</p>
                        </div>
                    </div>
                    <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; padding: 0.5rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.3;">
                            <i class="fa-solid fa-info-circle" style="color: #8b5cf6; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Aquí se muestran las lineas de credito asignadas a este aliado.
                        </div>
                    </div>
                </div>

                <!-- Parametrización de Bancos -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                        <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin: 0;">
                            <i class="fa-solid fa-university"></i> Cuentas Bancarias
                        </label>
                        <button type="button" onclick="abrirModalAgregarBanco(document.getElementById('edit_cod_administrador').value)" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.75rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; transition: all 0.3s ease; white-space: nowrap;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-plus-circle"></i> Agregar
                        </button>
                    </div>
                    <div id="contenedor_bancos_editar" style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 0.75rem; max-height: 350px; overflow-y: auto;">
                        <div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                            <p style="margin: 0; font-size: 0.85rem;">Cargando bancos...</p>
                        </div>
                    </div>
                    <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #8b5cf6; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Aquí se muestran las cuentas bancarias asignadas a este aliado.
                        </div>
                    </div>
                </div>

                <!-- Parametrización de Tiendas -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                        <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin: 0;">
                            <i class="fa-solid fa-store"></i> Tiendas Asociadas
                        </label>
                        <button type="button" onclick="abrirModalAgregarTienda()" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.75rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; transition: all 0.3s ease; white-space: nowrap;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-plus-circle"></i> Agregar
                        </button>
                    </div>
                    <div id="contenedor_tiendas_editar" style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 0.75rem; max-height: 350px; overflow-y: auto;">
                        <div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                            <p style="margin: 0; font-size: 0.85rem;">Cargando tiendas...</p>
                        </div>
                    </div>
                    <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #8b5cf6; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Aquí se muestran las tiendas asociadas a este aliado.
                        </div>
                    </div>
                </div>

                <!-- Documentación Legal -->
                <div class="form-group" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem; padding-top: 0.75rem; margin-bottom: 0.5rem;">
                    <label class="form-label" style="color: #8b5cf6; font-weight: 700; margin-bottom: 0.75rem; display: block;">
                        <i class="fa-solid fa-file-contract"></i> Documentación Legal
                    </label>
                    <div style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 0.75rem;">

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);"><i class="fa-solid fa-id-card"></i> Cédula</label>
                            <!-- Documento existente -->
                            <div id="edit_cedula_actual" style="display: none; padding: 0.75rem; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; text-align: center;">
                                <a href="#" target="_blank" style="color: #8b5cf6; text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 600;">
                                    <i class="fa-solid fa-file-check" style="font-size: 1.2rem;"></i>Ver Cédula Cargada</a>
                            </div>
                            <!-- Input para cargar nuevo documento -->
                            <div id="edit_cedula_input" style="display: none;">
                                <input type="file" class="form-input" name="url_documentacion_cedula_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                                <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);"><i class="fa-solid fa-file-pdf"></i> RUT (Registro Único Tributario)</label>
                            <!-- Documento existente -->
                            <div id="edit_rut_actual" style="display: none; padding: 0.75rem; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; text-align: center;">
                                <a href="#" target="_blank" style="color: #8b5cf6; text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 600;">
                                    <i class="fa-solid fa-file-check" style="font-size: 1.2rem;"></i>Ver Documento RUT Cargado</a>
                            </div>
                            <!-- Input para cargar nuevo documento -->
                            <div id="edit_rut_input" style="display: none;">
                                <input type="file" class="form-input" name="url_documentacion_rut_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                                <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);"><i class="fa-solid fa-building"></i> Cámara de Comercio</label>
                            <!-- Documento existente -->
                            <div id="edit_camara_actual" style="display: none; padding: 0.75rem; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; text-align: center;">
                                <a href="#" target="_blank" style="color: #8b5cf6; text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 600;">
                                    <i class="fa-solid fa-file-check" style="font-size: 1.2rem;"></i>Ver Cámara de Comercio Cargada</a>
                            </div>
                            <!-- Input para cargar nuevo documento -->
                            <div id="edit_camara_input" style="display: none;">
                                <input type="file" class="form-input" name="url_documentacion_camaracomercio_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                                <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                            </div>
                        </div>

                        <!--
                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-signature"></i> Contrato Firmado
                            </label>
                            <div id="edit_contrato_actual" style="display: none; margin-bottom: 0.5rem; padding: 0.5rem; background: rgba(139, 92, 246, 0.1); border-radius: 6px;">
                                <a href="#" target="_blank" style="color: #8b5cf6; text-decoration: none; font-size: 0.75rem;">
                                    <i class="fa-solid fa-file-check"></i> Ver documento actual
                                </a>
                            </div>
                            <input type="file" class="form-input" name="url_documentacion_contratofirma_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-alt"></i> Documento Extra 1 (Opcional)
                            </label>
                            <div id="edit_extra1_actual" style="display: none; margin-bottom: 0.5rem; padding: 0.5rem; background: rgba(139, 92, 246, 0.1); border-radius: 6px;">
                                <a href="#" target="_blank" style="color: #8b5cf6; text-decoration: none; font-size: 0.75rem;">
                                    <i class="fa-solid fa-file-check"></i> Ver documento actual
                                </a>
                            </div>
                            <input type="file" class="form-input" name="url_documentacion_extra1_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="font-size: 0.85rem; color: rgba(255,255,255,0.9);">
                                <i class="fa-solid fa-file-alt"></i> Documento Extra 2 (Opcional)
                            </label>
                            <div id="edit_extra2_actual" style="display: none; margin-bottom: 0.5rem; padding: 0.5rem; background: rgba(139, 92, 246, 0.1); border-radius: 6px;">
                                <a href="#" target="_blank" style="color: #8b5cf6; text-decoration: none; font-size: 0.75rem;">
                                    <i class="fa-solid fa-file-check"></i> Ver documento actual
                                </a>
                            </div>
                            <input type="file" class="form-input" name="url_documentacion_extra2_aliado" accept=".jpg,.jpeg,.png,.pdf" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.6rem; border-radius: 8px; font-size: 0.8rem;">
                            <small style="color: rgba(255,255,255,0.6); font-size: 0.7rem;">Formatos permitidos: JPG, PNG, PDF</small>
                        </div>
                        -->

                    </div>
                    <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 8px; padding: 0.6rem; margin-top: 0.5rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.7rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #8b5cf6; margin-right: 0.35rem;"></i>
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
                <div style="width: 80px; height: 80px; background: rgba(139, 92, 246, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="fa-solid fa-user" style="font-size: 2.5rem; color: #8b5cf6;"></i>
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
            <div class="detail-row">
                <span class="detail-label-modal">Fecha Registro</span>
                <span class="detail-value-modal" id="detFecha"></span>
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
                        <input type="checkbox" id="agregar_cod_estado_entrar_portal" name="cod_estado_entrar_portal" value="1" style="accent-color: #8b5cf6; width: 18px; height: 18px; cursor: pointer;">
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
                    <button type="submit" style="flex: 1; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
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

                <div class="form-group">
                    <label class="form-label">Banco *</label>
                    <select class="form-select" id="agregar_banco" name="cod_banco" required><option value="">Cargando...</option></select>
                </div>

                <div class="form-group">
                    <label class="form-label">Número de Cuenta *</label>
                    <input type="text" class="form-input" id="agregar_numero_cuenta" name="numero_banco_cuenta" placeholder="Ej: 1234567890" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo de Cuenta *</label>
                    <select class="form-select" id="agregar_tipo_cuenta" name="cod_tipo_cuenta_banco" required><option value="1">Ahorros</option><option value="2">Corriente</option></select>
                </div>

                <div class="form-group">
                    <label class="form-label">Estado *</label>
                    <select class="form-select" id="agregar_estado_cuenta" name="cod_estado" required><option value="1">Activo</option><option value="0">Inactivo</option></select>
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
                    <div style="background: rgba(139, 92, 246, 0.05); border: 2px dashed rgba(139, 92, 246, 0.3); border-radius: 10px; padding: 1rem; text-align: center; cursor: pointer; transition: all 0.3s ease;" onclick="document.getElementById('agregar_certificado_banco').click()" onmouseover="this.style.borderColor='rgba(139, 92, 246, 0.6)'" onmouseout="this.style.borderColor='rgba(139, 92, 246, 0.3)'">
                        <input type="file" id="agregar_certificado_banco" name="certificado_banco" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx" style="display: none;" onchange="mostrarNombreArchivoCertificado(this, 'preview_certificado_agregar')">
                        <div id="preview_certificado_agregar">
                            <i class="fa-solid fa-cloud-upload-alt" style="font-size: 2rem; color: rgba(139, 92, 246, 0.6); margin-bottom: 0.5rem;"></i>
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
                <div style="background: rgba(139, 92, 246, 0.1); padding: 0.5rem 0.75rem; border-radius: 8px; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-info-circle" style="color: #8b5cf6;"></i>
                    <span style="color: #8b5cf6; font-weight: 600; font-size: 0.85rem;">Información Básica</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre de la Tienda *</label>
                    <input type="text" class="form-input" name="nombre1_tercero" id="tienda_nombre" placeholder="Ej: Tienda El Éxito" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">NIT / Documento *</label>
                        <input type="number" class="form-input" name="identificacion_tercero" id="tienda_nit" required>
                    </div>
                     <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" name="telefono1_tercero" id="tienda_telefono" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" class="form-input" name="correo_tercero" id="tienda_correo" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Dirección</label>
                    <input type="text" class="form-input" name="direccion_tercero" id="tienda_direccion">
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

                <!-- Sección 2: Representante Legal -->
                <div style="background: rgba(59, 130, 246, 0.1); padding: 0.5rem 0.75rem; border-radius: 8px; margin: 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-user-tie" style="color: #3b82f6;"></i>
                    <span style="color: #3b82f6; font-weight: 600; font-size: 0.85rem;">Representante Legal</span>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" class="form-input" name="nombre_representante" id="tienda_nombre_rep">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">CC</label>
                        <input type="number" class="form-input" name="documento_representante" id="tienda_doc_rep">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-input" name="correo_representante" id="tienda_correo_rep">
                    </div>
                </div>

                <!-- Sección 3: Información del Negocio -->
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
                    <div style="background: rgba(139, 92, 246, 0.05); border: 2px dashed rgba(139, 92, 246, 0.3); border-radius: 10px; padding: 0.75rem; text-align: center; cursor: pointer;" onclick="document.getElementById('tienda_logo').click()">
                        <input type="file" id="tienda_logo" name="imagen_tienda" accept="image/*" style="display: none;" onchange="mostrarImagenPreviewTienda(this, 'preview_logo_tienda')">
                        <div id="preview_logo_tienda">
                            <i class="fa-solid fa-image" style="font-size: 1.5rem; color: rgba(139, 92, 246, 0.6);"></i>
                            <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.6); font-size: 0.75rem;">Clic para seleccionar</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Fachada</label>
                        <div style="background: rgba(139, 92, 246, 0.05); border: 2px dashed rgba(139, 92, 246, 0.3); border-radius: 10px; padding: 0.5rem; text-align: center; cursor: pointer;" onclick="document.getElementById('tienda_fachada').click()">
                            <input type="file" id="tienda_fachada" name="url_img_fachada_tienda" accept="image/*" style="display: none;" onchange="mostrarImagenPreviewTienda(this, 'preview_fachada_tienda')">
                            <div id="preview_fachada_tienda">
                                <i class="fa-solid fa-store" style="font-size: 1.2rem; color: rgba(139, 92, 246, 0.6);"></i>
                                <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.65rem;">Fachada</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Interna</label>
                        <div style="background: rgba(139, 92, 246, 0.05); border: 2px dashed rgba(139, 92, 246, 0.3); border-radius: 10px; padding: 0.5rem; text-align: center; cursor: pointer;" onclick="document.getElementById('tienda_interna').click()">
                            <input type="file" id="tienda_interna" name="url_img_interna_tienda" accept="image/*" style="display: none;" onchange="mostrarImagenPreviewTienda(this, 'preview_interna_tienda')">
                            <div id="preview_interna_tienda">
                                <i class="fa-solid fa-person-shelter" style="font-size: 1.2rem; color: rgba(139, 92, 246, 0.6);"></i>
                                <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.65rem;">Interna</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Selfie con Admin</label>
                    <div style="background: rgba(139, 92, 246, 0.05); border: 2px dashed rgba(139, 92, 246, 0.3); border-radius: 10px; padding: 0.75rem; text-align: center; cursor: pointer;" onclick="document.getElementById('tienda_selfie').click()">
                        <input type="file" id="tienda_selfie" name="url_img_selfieadmin_tienda" accept="image/*" style="display: none;" onchange="mostrarImagenPreviewTienda(this, 'preview_selfie_tienda')">
                        <div id="preview_selfie_tienda">
                            <i class="fa-solid fa-camera-retro" style="font-size: 1.5rem; color: rgba(139, 92, 246, 0.6);"></i>
                            <p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.6); font-size: 0.75rem;">Clic para seleccionar</p>
                        </div>
                    </div>
                </div>

                <div class="form-row" style="gap: 0.5rem; margin-top: 1rem;">
                    <button type="button" onclick="cerrarModalAgregarTienda()" style="flex: 1; background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                        <i class="fa-solid fa-times"></i> Cancelar
                    </button>
                    <button type="submit" style="flex: 1; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 0.85rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
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
        <div class="modal-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
            <h2><i class="fa-solid fa-circle-check"></i> ¡Aliado Registrado!</h2>
            <button class="modal-close" onclick="cerrarModalConfirmacionRegistro()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="confirm_cod_aliado" value="">
            <input type="hidden" id="confirm_cod_aliado_cryp" value="">
            <input type="hidden" id="confirm_nombre_aliado" value="">
            <input type="hidden" id="confirm_telefono_aliado" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="width: 80px; height: 80px; margin: 0 auto 1rem; background: rgba(139, 92, 246, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-circle-check" style="font-size: 3rem; color: #8b5cf6;"></i>
                </div>
                <h3 style="color: white; margin-bottom: 0.5rem;" id="confirm_nombre_display"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">El aliado ha sido registrado exitosamente.</p>
            </div>
            
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                <h4 style="color: #8b5cf6; margin: 0 0 0.75rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-tasks"></i> ¿Qué deseas hacer ahora?
                </h4>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin: 0;">Selecciona una de las siguientes opciones:</p>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1rem;">
                <button onclick="registrarOtroAliado()" style="width: 100%; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-user-plus"></i>
                    Registrar Otro Aliado
                </button>

                <button onclick="abrirDocumentacionDesdeConfirmacion()" style="width: 100%; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-file-contract"></i>
                    Compartir Enlace de Documentación
                </button>
                
                <button onclick="abrirRegistroTiendaDesdeConfirmacion()" style="width: 100%; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-store"></i>
                    Registrar Nueva Tienda
                </button>
            </div>
            
            <button onclick="cerrarModalConfirmacionRegistro()" style="width: 100%; background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.85rem; border-radius: 12px; cursor: pointer; font-weight: 600;">
                <i class="fa-solid fa-check"></i> Finalizar
            </button>
        </div>
    </div>
</div>

<!-- Modal Confirmación Tienda Registrada -->
<div class="modal-overlay" id="modalConfirmacionTienda" style="z-index: 4500; align-items: center;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
            <h2><i class="fa-solid fa-store"></i> ¡Tienda Registrada!</h2>
            <button class="modal-close" onclick="cerrarModalConfirmacionTienda()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="confirm_tienda_cod" value="">
            <input type="hidden" id="confirm_tienda_nombre" value="">
            <input type="hidden" id="confirm_tienda_cod_aliado" value="">
            
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="width: 80px; height: 80px; margin: 0 auto 1rem; background: rgba(139, 92, 246, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-store" style="font-size: 3rem; color: #8b5cf6;"></i>
                </div>
                <h3 style="color: white; margin-bottom: 0.5rem;" id="confirm_tienda_nombre_display"></h3>
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">La tienda ha sido registrada exitosamente.</p>
            </div>
            
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                <h4 style="color: #8b5cf6; margin: 0 0 0.75rem 0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-tasks"></i> ¿Qué deseas hacer ahora?
                </h4>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin: 0;">Gestiona los detalles de la nueva tienda:</p>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1rem;">
                <button onclick="abrirRegistroVendedorDesdeTienda()" style="width: 100%; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-user-plus"></i>
                    Registrar Vendedor de la Tienda
                </button>

                <button onclick="abrirRegistroProductoDesdeTienda()" style="width: 100%; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-box-open"></i>
                    Registrar Producto de la Tienda
                </button>
                
                <button onclick="irATiendaRegistrada()" style="width: 100%; background: rgba(139, 92, 246, 0.2); color: #8b5cf6; border: 1px solid rgba(139, 92, 246, 0.3); padding: 1rem; border-radius: 12px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-arrow-right"></i>
                    Ir a Mis Tiendas
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
                <i class="fa-solid fa-spinner fa-spin" style="font-size: 3rem; color: #8b5cf6;"></i>
                <p style="margin-top: 20px; color: rgba(255,255,255,0.7);">Generando archivo ZIP...</p>
            </div>
            
            <div id="contenidoCompartir" style="display: none;">
                <!-- Información del aliado -->
                <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 15px; margin-bottom: 20px;">
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
                    <button onclick="mostrarFormularioEmail()" style="width: 100%; background: linear-gradient(135deg, #a78bfa 0%, #8b5cf6 100%); color: white; border: none; padding: 15px; border-radius: 12px; font-size: 0.95rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: transform 0.2s;">
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
                <div id="formularioEmail" style="display: none; margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(139, 92, 246, 0.3);">
                    <h4 style="color: white; font-size: 0.9rem; margin-bottom: 15px;">
                        <i class="fa-solid fa-paper-plane"></i> Enviar por correo electrónico
                    </h4>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 5px;">Email destino *</label>
                        <input type="email" id="email_destino" placeholder="ejemplo@correo.com" style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 12px; border-radius: 8px; font-size: 0.9rem;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 5px;">Mensaje adicional (opcional)</label>
                        <textarea id="mensaje_email" rows="3" placeholder="Escribe un mensaje..." style="width: 100%; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 12px; border-radius: 8px; font-size: 0.9rem; resize: vertical;"></textarea>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button onclick="ocultarFormularioEmail()" style="flex: 1; background: rgba(255,255,255,0.1); color: white; border: none; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                            <i class="fa-solid fa-times"></i> Cancelar
                        </button>
                        <button onclick="enviarEmail()" style="flex: 1; background: linear-gradient(135deg, #a78bfa 0%, #8b5cf6 100%); color: white; border: none; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                            <i class="fa-solid fa-paper-plane"></i> Enviar
                        </button>
                    </div>
                </div>
                
                <!-- Enlace generado (inicialmente oculto) -->
                <div id="enlaceGenerado" style="display: none; margin-top: 20px; padding: 15px; background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px;">
                    <h4 style="color: white; font-size: 0.9rem; margin-bottom: 10px;">
                        <i class="fa-solid fa-link"></i> Enlace generado
                    </h4>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="text" id="input_enlace" readonly style="flex: 1; background: rgba(255,255,255,0.05); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 10px; border-radius: 8px; font-size: 0.85rem;">
                        <button onclick="copiarEnlace()" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; white-space: nowrap;">
                            <i class="fa-solid fa-copy"></i> Copiar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

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

function initSelect2Registro() {
    setTimeout(function() {
        ['#cod_lider', '#cod_coordinador', '#cod_asesor'].forEach(function(id) {
            $(id).select2({
                dropdownParent: $('#modalRegistro'),
                width: '100%',
                language: {
                    noResults: function() { return "No se encontraron resultados"; },
                    searching: function() { return "Buscando..."; }
                }
            });
        });
    }, 100);
}

// JS Modals
function abrirModal() { 
    document.getElementById('modalRegistro').classList.add('show'); 
    // Marcar todas las entidades crediticias por defecto
    setTimeout(function() {
        $('input[name="entidades[]"]').prop('checked', true);
    }, 100);
    // Cargar departamentos en el select del modal de registro
    cargarDepartamentosRegistro();
    
    // Inicializar Select2
    initSelect2Registro();
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

function abrirModalEditar(data) {
    // Guardar el cod_administrador en la variable global para uso posterior
    currentCodAdministradorTienda = data.cod_administrador;
    
    document.getElementById('edit_cod_administrador').value = data.cod_administrador;
    document.getElementById('edit_nombres_apellidos_tercero').value = data.nombres_apellidos_tercero || '';
    document.getElementById('edit_identificacion').value = data.cedula;
    document.getElementById('edit_nombre').value = data.nombres;
    document.getElementById('edit_apellido').value = data.apellidos;
    document.getElementById('edit_telefono').value = data.telefono || '';
    document.getElementById('edit_correo').value = data.correo || '';
    $('#edit_cod_asesor').val(data.cod_asesor || '').trigger('change');
    $('#edit_cod_lider').val(data.cod_lider || '').trigger('change');
    $('#edit_cod_coordinador').val(data.cod_coordinador || '').trigger('change');
    document.getElementById('edit_estado').value = data.cod_estado_activacion_usuario;
    document.getElementById('edit_estado_hidden').value = data.cod_estado_activacion_usuario;
    
    // Cargar nombre de usuario (el campo cuenta contiene el nombre de usuario)
    document.getElementById('edit_usuario').value = data.cuenta || data.cedula || '';

    // Cargar nuevos campos: Tipo Cliente, Sector, Nit Razón Social
    if(document.getElementById('edit_nombre_tipo_cliente')) {
        document.getElementById('edit_nombre_tipo_cliente').value = data.nombre_tipo_cliente || '';
    }
    if(document.getElementById('edit_cod_tipo_sector')) {
        document.getElementById('edit_cod_tipo_sector').value = data.cod_tipo_sector || '';
    }
    if(document.getElementById('edit_nit_razon_social')) {
        document.getElementById('edit_nit_razon_social').value = data.nit_razon_social || '';
    }
    // Cargar Razón Social
    if(document.getElementById('edit_nombre_razon_social')) {
        document.getElementById('edit_nombre_razon_social').value = data.nombre_razon_social || '';
    }
    
    // Mostrar/Ocultar Nit Razón Social al cargar (sin limpiar el valor)
    cambiarTipoClienteEdit(false);
    
    // Cargar Dirección y Barrio
    if(document.getElementById('edit_direccion_tercero')) {
        document.getElementById('edit_direccion_tercero').value = data.direccion_tercero || '';
    }
    if(document.getElementById('edit_barrio_tercero')) {
        document.getElementById('edit_barrio_tercero').value = data.barrio_tercero || '';
    }
    // Cargar departamentos y preseleccionar departamento/municipio
    cargarDepartamentosEdicion(data.cod_departamento || '', data.cod_municipio || '');
    
    // Cargar documentación legal si existe
    var editRutActual = document.getElementById('edit_rut_actual');
    var editRutInput = document.getElementById('edit_rut_input');
    var editCamaraActual = document.getElementById('edit_camara_actual');
    var editCamaraInput = document.getElementById('edit_camara_input');
    
    // Manejar RUT
    if (data.url_documentacion_rut_aliado && data.url_documentacion_rut_aliado.trim() !== '') {
        editRutActual.style.display = 'block';
        editRutActual.querySelector('a').href = data.url_documentacion_rut_aliado;
        editRutInput.style.display = 'none'; // Ocultar input si ya existe documento
    } else {
        editRutActual.style.display = 'none';
        editRutInput.style.display = 'block'; // Mostrar input si no existe documento
    }
    
    // Manejar Cámara de Comercio
    if (data.url_documentacion_camaracomercio_aliado && data.url_documentacion_camaracomercio_aliado.trim() !== '') {
        editCamaraActual.style.display = 'block';
        editCamaraActual.querySelector('a').href = data.url_documentacion_camaracomercio_aliado;
        editCamaraInput.style.display = 'none'; // Ocultar input si ya existe documento
    } else {
        editCamaraActual.style.display = 'none';
        editCamaraInput.style.display = 'block'; // Mostrar input si no existe documento
    }
    
    // Manejar Cédula
    var editCedulaActual = document.getElementById('edit_cedula_actual');
    var editCedulaInput = document.getElementById('edit_cedula_input');
    if (editCedulaActual && editCedulaInput) {
        if (data.url_documentacion_cedula_aliado && data.url_documentacion_cedula_aliado.trim() !== '') {
            editCedulaActual.style.display = 'block';
            editCedulaActual.querySelector('a').href = data.url_documentacion_cedula_aliado;
            editCedulaInput.style.display = 'none'; // Ocultar input si ya existe documento
        } else {
            editCedulaActual.style.display = 'none';
            editCedulaInput.style.display = 'block'; // Mostrar input si no existe documento
        }
    }
    
    // Limpiar el contenedor de entidades y mostrar loading
    $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Cargando entidades...</p></div>');
    
    // Cargar entidades crediticias asignadas al aliado
    $.ajax({
        url: '../admin/obtener_entidades_aliado_ajax.php',
        type: 'POST',
        data: { cod_administrador: data.cod_administrador },
        dataType: 'json',
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
                    var bgColor = estado == '1' ? 'rgba(139, 92, 246, 0.08)' : 'rgba(239, 68, 68, 0.08)';
                    var borderColor = estado == '1' ? 'rgba(139, 92, 246, 0.15)' : 'rgba(239, 68, 68, 0.15)';
                    
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
                    html += '<input type="checkbox" id="edit_portal_' + entidad.cod_parametrizacion_entidad_crediticia_aliado + '" ' + portal_checked + ' style="accent-color: #8b5cf6; width: 18px; height: 18px; cursor: pointer;">';
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
                    html += '<button type="button" onclick="guardarEntidadEditada(' + entidad.cod_parametrizacion_entidad_crediticia_aliado + ')" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 0.5rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; height: fit-content; align-self: end;" title="Guardar cambios"><i class="fa-solid fa-save"></i></button>';
                    html += '</div>';
                    
                    html += '</div>';
                });
                $('#contenedor_entidades_editar').html(html);
            } else {
                console.log('No hay entidades o error:', response);
                $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-info-circle" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: rgba(139, 92, 246, 0.4);"></i><p style="margin: 0; font-size: 0.85rem;">No hay entidades asignadas a este aliado.</p></div>');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error en AJAX:', status, error);
            console.log('Respuesta del servidor:', xhr.responseText);
            $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(239, 68, 68, 0.8);"><i class="fa-solid fa-exclamation-triangle" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Error al cargar entidades. Intente nuevamente.</p></div>');
        }
    });
    
    // Cargar bancos del aliado
    cargarBancosAliado(data.cod_administrador);
    
    // Cargar tiendas del aliado
    cargarTiendasAliado(data.cod_administrador);
    
    document.getElementById('modalEditar').classList.add('show');
    
    // Inicializar o refrescar Select2 cuando el modal se muestra
    setTimeout(function() {
        ['#edit_cod_lider', '#edit_cod_coordinador', '#edit_cod_asesor'].forEach(function(id) {
            $(id).select2({
                dropdownParent: $('#modalEditar'),
                width: '100%',
                language: {
                    noResults: function() { return "No se encontraron resultados"; },
                    searching: function() { return "Buscando..."; }
                }
            });
        });
    }, 100);
}

// Función para cargar bancos del aliado en modal editar
function cargarBancosAliado(codAdministrador) {
    $('#contenedor_bancos_editar').html('<div style="text-align: center; padding: 1rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.85rem;">Cargando bancos...</p></div>');
    
    $.ajax({
        url: '../admin/obtener_bancos_aliado_ajax.php',
        type: 'POST',
        data: { cod_administrador: codAdministrador },
        dataType: 'json',
        success: function(response) {
            if (response.success && response.bancos && response.bancos.length > 0) {
                var html = '';
                response.bancos.forEach(function(banco) {
                    // Colores según estado
                    var isActive = banco.cod_estado == '1';
                    var statusColor = isActive ? '#8b5cf6' : '#ef4444';
                    var statusBg = isActive ? 'rgba(139, 92, 246, 0.1)' : 'rgba(239, 68, 68, 0.1)';
                    var cardBorder = isActive ? 'rgba(139, 92, 246, 0.2)' : 'rgba(239, 68, 68, 0.2)';
                    
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
                        html += '<a href="' + banco.url_certificado_banco_cuenta + '" target="_blank" class="btn-check-cert" style="background: rgba(139, 92, 246, 0.2); color: #8b5cf6; border: 1px solid rgba(139, 92, 246, 0.3); padding: 0 0.8rem; border-radius: 6px; display: flex; align-items: center; justify-content: center; text-decoration: none;" title="Ver certificado actual"><i class="fa-solid fa-eye"></i></a>';
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
                $('#contenedor_bancos_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-info-circle" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: rgba(139, 92, 246, 0.4);"></i><p style="margin: 0; font-size: 0.85rem;">No hay cuentas bancarias asignadas.</p></div>');
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
        Swal.fire({ 
            icon: 'warning', 
            title: 'Campo requerido', 
            text: 'El número de cuenta no puede estar vacío', 
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
    
    $.ajax({
        url: '../admin/actualizar_banco_aliado_ajax.php',
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
                    title: '¡Actualizado!', 
                    text: 'Cuenta bancaria actualizada correctamente', 
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
                    text: response.mensaje || 'No se pudo actualizar la cuenta', 
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

// Función para eliminar banco del aliado
function eliminarBancoAliado(codBancoCuenta, nombreBanco) {
    Swal.fire({
        title: '¿Eliminar cuenta bancaria?',
        html: '<div style="text-align: left; padding: 1rem;"><p style="margin-bottom: 0.5rem;">Se eliminará la cuenta de:</p><strong style="color: #8b5cf6;">' + nombreBanco + '</strong><p style="margin-top: 0.5rem; color: #ef4444; font-size: 0.85rem;">Esta acción no se puede deshacer.</p></div>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fa-solid fa-trash"></i> Sí, eliminar',
        cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        background: '#1a1f2e',
        color: 'white',
        customClass: {
            container: 'swal-high-zindex'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/eliminar_banco_aliado_ajax.php',
                type: 'POST',
                data: { cod_banco_cuenta: codBancoCuenta },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ 
                            icon: 'success', 
                            title: '¡Eliminado!', 
                            text: 'Cuenta bancaria eliminada correctamente', 
                            background: '#1a1f2e', 
                            color: 'white', 
                            timer: 2000,
                            customClass: {
                                container: 'swal-high-zindex'
                            }
                        });
                        var codAdmin = $('#edit_cod_administrador').val();
                        cargarBancosAliado(codAdmin);
                    } else {
                        Swal.fire({ 
                            icon: 'error', 
                            title: 'Error', 
                            text: response.mensaje || 'No se pudo eliminar la cuenta', 
                            background: '#1a1f2e', 
                            color: 'white',
                            customClass: {
                                container: 'swal-high-zindex'
                            }
                        });
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
                    var bgColor = estado == '1' ? 'rgba(139, 92, 246, 0.08)' : 'rgba(239, 68, 68, 0.08)';
                    var borderColor = estado == '1' ? 'rgba(139, 92, 246, 0.15)' : 'rgba(239, 68, 68, 0.15)';
                    
                    html += '<div id="tienda_item_' + tienda.cod_tienda + '" style="padding: 0.75rem; background: ' + bgColor + '; border: 1px solid ' + borderColor + '; border-radius: 10px; margin-bottom: 0.5rem;">';
                    
                    // Grid de campos editables
                    html += '<div style="display: grid; grid-template-columns: 1fr auto; gap: 0.5rem; align-items: start;">';
                    html += '<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.5rem;">';
                    
                    // Nombre de la tienda
                    html += '<div style="grid-column: 1 / -1;"><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;"><i class="fa-solid fa-store"></i> Nombre de la Tienda</label>';
                    html += '<input type="text" id="edit_nombre_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.nombre_tienda) + '" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // NIT/CC
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">NIT/CC</label>';
                    html += '<input type="text" id="edit_nit_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.identificacion_tercero || '') + '" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // Teléfono
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Teléfono</label>';
                    html += '<input type="text" id="edit_telefono_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.telefono1_tercero || '') + '" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // Correo
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Correo</label>';
                    html += '<input type="email" id="edit_correo_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.correo_tercero || '') + '" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // Dirección
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Dirección</label>';
                    html += '<input type="text" id="edit_direccion_tienda_' + tienda.cod_tienda + '" value="' + escapeHtmlMovil(tienda.direccion_tercero || '') + '" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"></div>';
                    
                    // Departamento
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Departamento</label>';
                    html += '<select id="edit_departamento_tienda_' + tienda.cod_tienda + '" onchange="cargarMunicipiosEditar(' + tienda.cod_tienda + ', this.value)" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"><option value="">Cargando...</option></select></div>';
                    
                    // Municipio
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Municipio</label>';
                    html += '<select id="edit_municipio_tienda_' + tienda.cod_tienda + '" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;"><option value="">Cargando...</option></select></div>';
                    
                    html += '</div>';
                    
                    // Columna derecha: Estado y botón guardar
                    html += '<div style="display: flex; flex-direction: column; gap: 0.5rem;">';
                    html += '<div><label style="color: rgba(255,255,255,0.6); font-size: 0.7rem; margin-bottom: 0.25rem; display: block;">Estado</label>';
                    html += '<select id="edit_estado_tienda_' + tienda.cod_tienda + '" style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); color: white; padding: 0.4rem 0.5rem; border-radius: 6px; font-size: 0.8rem; width: 100%;">';
                    html += '<option value="1" style="background: #1a1f2e; color: white;"' + (estado == '1' ? ' selected' : '') + '>Activo</option>';
                    html += '<option value="0" style="background: #1a1f2e; color: white;"' + (estado == '0' ? ' selected' : '') + '>Inactivo</option>';
                    html += '</select></div>';
                    html += '<button type="button" onclick="guardarTiendaEditada(' + tienda.cod_tienda + ')" style="background: #3b82f6; color: white; border: none; padding: 0.5rem 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.75rem; white-space: nowrap;" title="Guardar cambios"><i class="fa-solid fa-save"></i> Guardar</button>';
                    html += '</div>';
                    
                    html += '</div>';
                    
                    // Botón ver detalle
                    html += '<div style="margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px solid rgba(255,255,255,0.1);">';
                    html += '<a href="../admin/ver_detalle_tienda_lider_movil.php?cod_tienda=' + tienda.cod_tienda + '" target="_blank" style="display: inline-block; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; cursor: pointer; text-decoration: none;"><i class="fa-solid fa-eye"></i> Ver Detalle Completo</a>';
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
                $('#contenedor_tiendas_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-store" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: rgba(139, 92, 246, 0.4);"></i><p style="margin: 0; font-size: 0.85rem;">No hay tiendas asociadas a este aliado.</p></div>');
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
    document.getElementById('preview_logo_tienda').innerHTML = '<i class="fa-solid fa-image" style="font-size: 1.5rem; color: rgba(139, 92, 246, 0.6);"></i><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.6); font-size: 0.75rem;">Clic para seleccionar</p>';
    document.getElementById('preview_fachada_tienda').innerHTML = '<i class="fa-solid fa-store" style="font-size: 1.2rem; color: rgba(139, 92, 246, 0.6);"></i><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.65rem;">Fachada</p>';
    document.getElementById('preview_interna_tienda').innerHTML = '<i class="fa-solid fa-person-shelter" style="font-size: 1.2rem; color: rgba(139, 92, 246, 0.6);"></i><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.65rem;">Interna</p>';
    document.getElementById('preview_selfie_tienda').innerHTML = '<i class="fa-solid fa-camera-retro" style="font-size: 1.5rem; color: rgba(139, 92, 246, 0.6);"></i><p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.6); font-size: 0.75rem;">Clic para seleccionar</p>';
}

// Función para mostrar nombre de archivo
function mostrarNombreArchivoTienda(input, previewId) {
    var preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        var fileName = input.files[0].name;
        if (fileName.length > 20) {
            fileName = fileName.substring(0, 17) + '...';
        }
        preview.innerHTML = '<i class="fa-solid fa-check-circle" style="font-size: 1.5rem; color: #8b5cf6;"></i><p style="margin: 0.25rem 0 0 0; color: #8b5cf6; font-size: 0.75rem;">' + fileName + '</p>';
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
        url: '../admin/reg_edit_tienda_modal_lider_movil_ajax_reg.php',
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
        html: '<div style="text-align: left; padding: 1rem;"><p style="margin-bottom: 0.5rem;">Se eliminará la parametrización de:</p><strong style="color: #8b5cf6;">' + nombre_entidad + '</strong><p style="margin-top: 0.5rem; color: #ef4444; font-size: 0.85rem;">Esta acción no se puede deshacer.</p></div>',
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
                            confirmButtonColor: '#8b5cf6',
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
        html: '<div style="text-align: left; padding: 1rem;"><p style="margin-bottom: 0.5rem;">Se generará una nueva contraseña temporal para:</p><strong style="color: #8b5cf6;">' + nombreAliado + '</strong><p style="margin-top: 0.5rem;">Se enviará al correo: <strong style="color: #f59e0b;">' + correo + '</strong></p><p style="margin-top: 0.5rem; color: #ef4444; font-size: 0.85rem;">La contraseña actual quedará inhabilitada.</p></div>',
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
                            html: '<p>' + response.mensaje + '</p><p style="margin-top: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.7);">Nueva contraseña temporal: <strong style="color: #8b5cf6;">' + response.password_temporal + '</strong></p>',
                            confirmButtonColor: '#8b5cf6',
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
    document.getElementById('detFecha').textContent = data.fecha ? new Date(data.fecha).toLocaleDateString('es-ES') : 'No registrada';
    
    var badge = document.getElementById('detEstado');
    if(data.cod_estado_activacion_usuario == '1') {
        badge.textContent = 'ACTIVO';
        badge.style.background = 'rgba(139, 92, 246, 0.2)';
        badge.style.color = '#8b5cf6';
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
    
    // Inicializar Select2
    initSelect2Registro();
}

function cerrarModalConfirmacionTienda() {
    document.getElementById('modalConfirmacionTienda').classList.remove('show');
    location.reload();
}

// ===== FUNCIONES PARA REGISTRO DE VENDEDOR Y PRODUCTO DESDE CONFIRMACIÓN =====
function abrirRegistroVendedorDesdeTienda() {
    var codTienda = document.getElementById('confirm_tienda_cod').value;
    var nombreTienda = document.getElementById('confirm_tienda_nombre').value;
    
    // Poblar modal de vendedor
    document.getElementById('vendedor_cod_tienda').value = codTienda;
    document.getElementById('vendedor_nombre_tienda').textContent = nombreTienda;
    
    // Abrir modal
    document.getElementById('modalAgregarVendedor').classList.add('show');
}

function cerrarModalAgregarVendedor() {
    document.getElementById('modalAgregarVendedor').classList.remove('show');
}

function abrirRegistroProductoDesdeTienda() {
    var codTienda = document.getElementById('confirm_tienda_cod').value;
    var nombreTienda = document.getElementById('confirm_tienda_nombre').value;
    
    // Poblar modal de producto
    document.getElementById('producto_cod_tienda').value = codTienda;
    document.getElementById('productoNombreTienda').textContent = nombreTienda;
    
    // Resetear form de producto
    document.getElementById('formRegistroProducto').reset();
    document.getElementById('producto_cod_tienda').value = codTienda;
    
    // Abrir modal
    document.getElementById('modalRegistroProducto').classList.add('show');
}

function cerrarModalProducto() {
    document.getElementById('modalRegistroProducto').classList.remove('show');
}

function formatearPrecio(input) {
    var valor = input.value.replace(/[^\d]/g, '');
    if (valor === '') { input.value = ''; return; }
    var numero = parseInt(valor, 10);
    input.value = '$ ' + numero.toLocaleString('es-CO');
}

function previewImageProducto(input) {
    var preview = document.getElementById('preview_producto_img');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { 
            preview.src = e.target.result; 
            preview.style.display = 'block'; 
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Envío del formulario de Vendedor
$(document).on('submit', '#formAgregarVendedor', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    Swal.fire({
        title: 'Registrando vendedor...',
        didOpen: () => { Swal.showLoading(); },
        allowOutsideClick: false,
        background: '#1a1f2e',
        color: 'white',
        customClass: { container: 'swal-high-zindex' }
    });
    
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
                Swal.fire({
                    icon: 'success',
                    title: '¡Vendedor Registrado!',
                    text: response.message || 'El vendedor ha sido registrado exitosamente',
                    background: '#1a1f2e',
                    color: 'white',
                    confirmButtonColor: '#8b5cf6',
                    customClass: { container: 'swal-high-zindex' }
                }).then(() => {
                    document.getElementById('formAgregarVendedor').reset();
                    cerrarModalAgregarVendedor();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'No se pudo registrar el vendedor',
                    background: '#1a1f2e',
                    color: 'white',
                    confirmButtonColor: '#ef4444',
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
});

// Envío del formulario de Producto
$(document).on('submit', '#formRegistroProducto', function(e) {
    e.preventDefault();
    
    // Limpiar precios
    var precioCompraRaw = document.getElementById('producto_precio_compra').value.replace(/[^\d]/g, '') || '0';
    var precioVentaRaw = document.getElementById('producto_precio_venta').value.replace(/[^\d]/g, '') || '0';
    
    document.getElementById('precio_compra_producto_hidden').value = precioCompraRaw;
    document.getElementById('precio_venta_producto_hidden').value = precioVentaRaw;
    
    var formData = new FormData(this);
    
    Swal.fire({
        title: 'Registrando producto...',
        didOpen: () => { Swal.showLoading(); },
        allowOutsideClick: false,
        background: '#1a1f2e',
        color: 'white',
        customClass: { container: 'swal-high-zindex' }
    });
    
    $.ajax({
        url: 'reg_producto_tienda_aliado_ajax.php',
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
                    title: '¡Producto Registrado!',
                    text: response.message || 'El producto se registró correctamente.',
                    background: '#1a1f2e',
                    color: 'white',
                    confirmButtonColor: '#8b5cf6',
                    customClass: { container: 'swal-high-zindex' }
                }).then(() => {
                    document.getElementById('formRegistroProducto').reset();
                    document.getElementById('preview_producto_img').style.display = 'none';
                    cerrarModalProducto();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'No se pudo registrar el producto.',
                    background: '#1a1f2e',
                    color: 'white',
                    confirmButtonColor: '#ef4444',
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
});


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
        window.location.href = 'lista_tienda_lider_movil.php?cod_tienda=' + codTienda;
    } else {
        window.location.href = 'lista_tienda_lider_movil.php';
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
            Swal.fire({
                icon: 'success',
                title: '¡Copiado!',
                text: 'El enlace ha sido copiado al portapapeles',
                timer: 2000,
                showConfirmButton: false,
                background: '#1a1f2e',
                color: 'white',
                customClass: { container: 'swal-high-zindex' }
            });
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
        Swal.fire({
            icon: 'success', title: '¡Copiado!', text: 'El enlace ha sido copiado al portapapeles', timer: 2000,  showConfirmButton: false, background: '#1a1f2e', color: 'white',
            customClass: { container: 'swal-high-zindex' }
        });
    } catch (err) {
        Swal.fire({
            icon: 'error', title: 'Error', text: 'No se pudo copiar el enlace. Por favor cópialo manualmente: ' + enlace, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }
        });
    }
    
    document.body.removeChild(textArea);
}

// Cerrar modales al hacer clic fuera
document.getElementById('modalConfirmacionRegistro').addEventListener('click', function(e) { 
    if (e.target === this) { 
        cerrarModalConfirmacionRegistro(); 
    } 
});

document.getElementById('modalDocumentacionAliado').addEventListener('click', function(e) { 
    if (e.target === this) { 
        cerrarModalDocumentacionAliado(); 
    } 
});
// ===== FIN FUNCIONES PARA MODAL DE CONFIRMACIÓN Y DOCUMENTACIÓN =====

// Funciones para agregar nueva entidad
var codAdministradorActual = null;

function abrirModalAgregarEntidad() {
    codAdministradorActual = document.getElementById('edit_cod_administrador').value;
    document.getElementById('agregar_cod_administrador').value = codAdministradorActual;
    
    // Cargar entidades disponibles
    $('#agregar_cod_entidad').html('<option value="">Cargando...</option>');
    
    $.ajax({
        url: '../admin/obtener_entidades_disponibles_ajax.php',
        type: 'POST',
        data: { cod_administrador: codAdministradorActual },
        dataType: 'json',
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
                Swal.fire({
                    icon: 'info',
                    title: 'Sin entidades disponibles',
                    text: 'Todas las entidades ya han sido asignadas a este aliado',
                    background: '#1a1f2e',
                    color: 'white',
                    customClass: {
                        container: 'swal-high-zindex'
                    }
                });
            }
        },
        error: function() {
            $('#agregar_cod_entidad').html('<option value="">Error al cargar</option>');
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudieron cargar las entidades disponibles',
                background: '#1a1f2e',
                color: 'white',
                customClass: {
                    container: 'swal-high-zindex'
                }
            });
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
        url: '../admin/obtener_bancos_disponibles_ajax.php',
        type: 'GET',
        dataType: 'json',
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
    console.log('Modal Agregar Banco - Código Aliado:', codAliadoEstrategico);
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
        preview.innerHTML = '<i class="fa-solid fa-file-check" style="font-size: 2rem; color: #8b5cf6; margin-bottom: 0.5rem;"></i>' +
            '<p style="margin: 0; color: #8b5cf6; font-size: 0.85rem; font-weight: 600;">' + fileName + '</p>' +
            '<p style="margin: 0.25rem 0 0 0; color: rgba(255,255,255,0.5); font-size: 0.7rem;">' + fileSize + ' MB</p>';
    } else {
        preview.innerHTML = '<i class="fa-solid fa-cloud-upload-alt" style="font-size: 2rem; color: rgba(139, 92, 246, 0.6); margin-bottom: 0.5rem;"></i>' +
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
    
    if (url && url !== '') {
        $('#agregar_url').val(url);
    }
    
    // Auto-rellenar el campo de interés con el valor por defecto
    if (interesDefault && interesDefault !== '') {
        $('#agregar_interes').val(interesDefault);
    }
});

// Guardar nueva entidad
$('#formAgregarEntidad').on('submit', function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    Swal.fire({ title: 'Guardando...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/agregar_entidad_aliado_ajax.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                cerrarModalAgregarEntidad();
                Swal.fire({
                    icon: 'success', title: '¡Éxito!', text: 'Entidad agregada correctamente', confirmButtonColor: '#8b5cf6', background: '#1a1f2e',
                    color: 'white', timer: 2000, timerProgressBar: true, customClass: { container: 'swal-high-zindex' }
                }).then(() => {
                    // Recargar las entidades en el modal de edición
                    var codAdmin = $('#edit_cod_administrador').val();
                    recargarEntidadesEditar(codAdmin);
                });
            } else {
                Swal.fire({
                    icon: 'error', title: 'Error', text: response.mensaje || 'No se pudo agregar la entidad', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }
                });
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
        url: '../admin/obtener_entidades_aliado_ajax.php',
        type: 'POST',
        data: { cod_administrador: codAdministrador },
        dataType: 'json',
        success: function(response) {
            if (response.success && response.entidades && response.entidades.length > 0) {
                var html = '';
                response.entidades.forEach(function(entidad) {
                    var checked = 'checked';
                    var interes = entidad.interes_ptj || '';
                    var portal_checked = entidad.cod_estado_entrar_portal == '1' ? 'checked' : '';
                    var url = entidad.url_pagina_web_consulta || '';
                    
                    html += '<div style="display: grid; grid-template-columns: auto 1fr auto auto auto; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem; padding: 0.6rem 0.75rem; background: rgba(139, 92, 246, 0.08); border: 1px solid rgba(139, 92, 246, 0.15); border-radius: 10px;">';
                    html += '<input type="checkbox" name="entidades[]" value="' + entidad.cod_entidad_crediticia + '" id="edit_ent_' + entidad.cod_entidad_crediticia + '" ' + checked + ' style="accent-color: #8b5cf6; width: 18px; height: 18px; cursor: pointer; margin: 0;">';
                    html += '<label for="edit_ent_' + entidad.cod_entidad_crediticia + '" style="color: rgba(255,255,255,0.95); font-size: 0.9rem; font-weight: 600; cursor: pointer; margin: 0;">' + escapeHtmlMovil(entidad.nombre_entidad_crediticia) + '</label>';
                    html += '<div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">';
                    html += '<label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">% Adtvo:</label>';
                    html += '<input type="number" step="0.01" min="0" max="100" class="form-input" name="interes_' + entidad.cod_entidad_crediticia + '" id="edit_interes_' + entidad.cod_entidad_crediticia + '" value="' + interes + '" placeholder="0.00" style="width: 70px; padding: 0.3rem 0.4rem; font-size: 0.8rem; text-align: center;">';
                    html += '</div>';
                    html += '<div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(0,0,0,0.2); padding: 0.4rem 0.6rem; border-radius: 6px;">';
                    html += '<label style="color: rgba(255,255,255,0.7); font-size: 0.75rem; margin: 0; white-space: nowrap;">Portal:</label>';
                    html += '<input type="checkbox" name="cod_estado_entrar_portal_' + entidad.cod_entidad_crediticia + '" id="edit_cod_estado_entrar_portal_' + entidad.cod_entidad_crediticia + '" value="1" ' + portal_checked + ' style="accent-color: #8b5cf6; width: 16px; height: 16px; cursor: pointer; margin: 0;" title="Acceso al portal">';
                    html += '</div>';
                    html += '<button type="button" id="btn_eliminar_' + entidad.cod_entidad_crediticia + '" data-cod-parametrizacion="' + entidad.cod_parametrizacion_entidad_crediticia_aliado + '" data-nombre-entidad="' + escapeHtmlMovil(entidad.nombre_entidad_crediticia) + '" onclick="eliminarEntidadAliado(' + entidad.cod_entidad_crediticia + ')" style="background: #ef4444; color: white; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; display: flex; align-items: center; gap: 0.25rem;" title="Eliminar parametrización">';
                    html += '<i class="fa-solid fa-trash"></i>';
                    html += '</button>';
                    html += '</div>';
                });
                $('#contenedor_entidades_editar').html(html);
            } else {
                $('#contenedor_entidades_editar').html('<div style="text-align: center; padding: 1.5rem; color: rgba(255,255,255,0.5);"><i class="fa-solid fa-info-circle" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: rgba(139, 92, 246, 0.4);"></i><p style="margin: 0; font-size: 0.85rem;">No hay entidades asignadas a este aliado.</p></div>');
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
    window.searchTimeout = setTimeout(function() { 
        const urlParams = new URLSearchParams(window.location.search);
        const cod_coordinador = urlParams.get('cod_coordinador') || '';
        const cod_administrador_get = urlParams.get('cod_administrador') || '';

        window.location.href = 'lista_aliado_lider_movil.php?busqueda=' + encodeURIComponent(busqueda) + 
                            '&filtro_doc=' + encodeURIComponent(filtro_doc) + 
                            '&cod_coordinador=' + encodeURIComponent(cod_coordinador) +
                            '&cod_administrador=' + encodeURIComponent(cod_administrador_get); 
    }, 500); 
}

// Variable para controlar si la identificación es válida
var identificacionValida = false;

// Verificar identificación en tiempo real
$(document).on('blur', '#identificacion_tercero', function() {
    var identificacion = $(this).val().trim();
    var inputField = $(this);
    var mensajeDiv = $('#mensaje_identificacion');
    var btnGuardar = $('#btnGuardar');
    
    if(identificacion === '') {
        inputField.css('border-color', '');
        mensajeDiv.hide();
        identificacionValida = false;
        btnGuardar.prop('disabled', false);
        btnGuardar.css('opacity', '1');
        btnGuardar.css('cursor', 'pointer');
        return;
    }
    
    $.ajax({
        url: '../admin/verificar_identificacion_aliado.php', type: 'POST', data: { identificacion: identificacion }, dataType: 'json',
        success: function(response) {
            if(response.existe) {
                inputField.css('border-color', '#ef4444');
                mensajeDiv.text('⚠️ Esta identificación ya está registrada a nombre de un aliado estratégico').show();
                identificacionValida = false;
                btnGuardar.prop('disabled', true);
                btnGuardar.css('opacity', '0.5');
                btnGuardar.css('cursor', 'not-allowed');
            } else {
                inputField.css('border-color', '#8b5cf6');
                mensajeDiv.hide();
                identificacionValida = true;
                btnGuardar.prop('disabled', false);
                btnGuardar.css('opacity', '1');
                btnGuardar.css('cursor', 'pointer');
            }
        },
        error: function() {
            mensajeDiv.text('Error al verificar la identificación').show();
            identificacionValida = false;
            btnGuardar.prop('disabled', true);
            btnGuardar.css('opacity', '0.5');
            btnGuardar.css('cursor', 'not-allowed');
        }
    });
});

// Guardar Aliado (Nuevo)
$('#formRegistro').on('submit', function(e) {
    e.preventDefault();
    // Verificar si la identificación es válida
    var identificacion = $('#identificacion_tercero').val().trim();
    if(identificacion === '') {
        Swal.fire({ icon: 'warning', title: 'Campo requerido', text: 'Debe ingresar una identificación', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        return false;
    }
    // Si la identificación no ha sido validada, verificarla primero
    if(!identificacionValida) {
        Swal.fire({ title: 'Verificando identificación...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        
        $.ajax({
            url: '../ajax/verificar_identificacion_aliado.php', type: 'POST', data: { identificacion: identificacion }, dataType: 'json',
            success: function(response) {
                Swal.close();
                if(response.existe) {
                    Swal.fire({ icon: 'error', title: 'Identificación duplicada', text: 'Esta identificación ya está registrada en el sistema', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                    $('#identificacion_tercero').css('border-color', '#ef4444');
                    $('#mensaje_identificacion').text('⚠️ Esta identificación ya está registrada').show();
                    $('#btnGuardar').prop('disabled', true).css({'opacity': '0.5', 'cursor': 'not-allowed'});
                } else {
                    identificacionValida = true;
                    $('#btnGuardar').prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
                    $('#formRegistro').trigger('submit');
                }
            },
            error: function() {
                Swal.close();
                Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo verificar la identificación. Intente nuevamente.', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        });
        return false;
    }
    
    var formData = new FormData(this);
    
    Swal.fire({ title: 'Guardando...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: '../admin/reg_aliado_modal_lider_ajax_reg.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(resp) {
            Swal.close();
            //console.log('Respuesta del servidor:', resp); // Debug
            
            if(resp.afectado === 'SI') {
                cerrarModal();
                // Guardar datos en el modal de confirmación
                document.getElementById('confirm_cod_aliado').value = resp.cod_administrador;
                document.getElementById('confirm_cod_aliado_cryp').value = resp.cod_aliado_cryp;
                document.getElementById('confirm_nombre_aliado').value = resp.nombre_completo;
                document.getElementById('confirm_telefono_aliado').value = resp.telefono;
                document.getElementById('confirm_nombre_display').textContent = resp.nombre_completo;
                
                // Si se creó una tienda automáticamente
                if (resp.cod_tienda) {
                    document.getElementById('confirm_tienda_cod').value = resp.cod_tienda;
                    document.getElementById('confirm_tienda_nombre').value = resp.nombre_completo;
                    document.getElementById('confirm_tienda_cod_aliado').value = resp.cod_administrador;
                    document.getElementById('confirm_tienda_nombre_display').textContent = resp.nombre_completo;
                    document.getElementById('modalConfirmacionTienda').classList.add('show');
                } else {
                    // Abrir modal de confirmación de aliado
                    document.getElementById('modalConfirmacionRegistro').classList.add('show');
                }
            } else if(resp.afectado === 'EXISTE') {
                Swal.fire({ 
                    icon: 'warning', title: 'Aliado Existente', text: resp.mensaje || 'Este aliado ya está registrado en el sistema', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }
                });
            } else {
                var errorMsg = resp.mensaje || 'Error al registrar el aliado';
                if(resp.error) { errorMsg += '\n\nDetalle: ' + resp.error; }
                Swal.fire({ icon: 'error', title: 'Error', text: errorMsg, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.log('Error AJAX:', xhr.responseText); // Debug
            Swal.fire({ 
                icon: 'error',  title: 'Error',  text: 'Error de conexión. Intenta nuevamente.',  background: '#1a1f2e',  color: 'white', customClass: { container: 'swal-high-zindex' }
            });
        }
    });
});

// Guardar Aliado (Editar)
$('#formEditar').on('submit', function(e) {
    e.preventDefault();
    
    // Usar FormData para soportar archivos
    var formData = new FormData(this);
    
    Swal.fire({
        title: 'Actualizando...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e',  color: 'white', customClass: { container: 'swal-high-zindex' }
    });
    
    $.ajax({
        url: '../admin/act_aliado_modal_lider_ajax_reg.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(resp) {
            Swal.close();
            
            if(resp.afectado === 'SI') {
                cerrarModalEditar(); 
                Swal.fire({ icon: 'success',  title: '¡Actualizado!',  text: resp.mensaje || 'Datos del aliado actualizados correctamente',  confirmButtonColor: '#8b5cf6',  background: '#1a1f2e',  color: 'white', timer: 2000, timerProgressBar: true, customClass: { container: 'swal-high-zindex' } }).then(() => { location.reload(); });
            } else {
                Swal.fire({ icon: 'error',  title: 'Error',  text: resp.mensaje || 'No se pudo actualizar el aliado',  background: '#1a1f2e',  color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.log('Error AJAX:', xhr.responseText);
            Swal.fire({ icon: 'error',  title: 'Error',  text: 'Error de conexión. Intenta nuevamente.',  background: '#1a1f2e',  color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});

// Cerrar modales al hacer clic fuera
$('.modal-overlay').on('click', function(e) {
    if (e.target === this) {
        $(this).removeClass('show');
    }
});

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
        url: 'generar_zip_documentacion.php', type: 'POST', data: { cod_aliado: cod_aliado }, dataType: 'json',
        success: function(response) {
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
            listaHTML += '<div style="padding: 8px; border-bottom: 1px solid rgba(139, 92, 246, 0.2); display: flex; justify-content: space-between; align-items: center;">';
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
    
    Swal.fire({ title: 'Enviando email...', didOpen: () => { Swal.showLoading() }, allowOutsideClick: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: 'enviar_email_documentacion.php', type: 'POST', data: { zip_path: datosZipActual.zip_path, email_destino: email, mensaje: mensaje, aliado_nombre: datosZipActual.aliado_nombre }, dataType: 'json', timeout: 60000,
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({ icon: 'success', title: '¡Email enviado!', text: response.message, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
                ocultarFormularioEmail();
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message, background: '#1a1f2e', color: 'white',  customClass: { container: 'swal-high-zindex' } });
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



// Función para manejar el cambio en el select tipo_cliente (Registro)
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

// Función para manejar el cambio en el select tipo_cliente (Editar)
function cambiarTipoClienteEdit(limpiarNit) {
    var tipoCliente = document.getElementById('edit_nombre_tipo_cliente');
    var rowRazonSocial = document.getElementById('edit_row_razon_social');
    var inputNit = document.getElementById('edit_nit_razon_social');
    var inputRazonSocial = document.getElementById('edit_nombre_razon_social');
    
    if (tipoCliente.value == 'PERSONA_JURIDICA' || tipoCliente.value == '2') {
        if (rowRazonSocial) rowRazonSocial.style.display = 'grid';
        if (inputNit) inputNit.required = true;
        if (inputRazonSocial) inputRazonSocial.required = true;
    } else {
        if (rowRazonSocial) rowRazonSocial.style.display = 'none';
        if (inputNit) {
            inputNit.required = false;
            if (limpiarNit !== false) inputNit.value = '';
        }
        if (inputRazonSocial) {
            inputRazonSocial.required = false;
            if (limpiarNit !== false) inputRazonSocial.value = '';
        }
    }
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

function descargarZip() {
    if (!datosZipActual) { Swal.fire({ icon: 'error', title: 'Error', text: 'No hay un archivo ZIP generado', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } }); return; }
    
    // Crear un enlace temporal y hacer clic en él para descargar
    var link = document.createElement('a');
    link.href = '../' + datosZipActual.zip_path;
    link.download = datosZipActual.zip_name;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    Swal.fire({
        icon: 'success', title: 'Descargando...', text: 'El archivo se está descargando', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }
    });
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
        Swal.fire({
            icon: 'success', title: '¡Copiado!', text: 'El enlace se ha copiado al portapapeles', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' }
        });
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

.notification-bell-movil:hover { transform: scale(1.1); box-shadow: 0 6px 30px rgba(139, 92, 246, 0.7); }
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
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.notification-panel-movil.show { display: block; animation: slideUpMovil 0.3s ease; }
@keyframes slideUpMovil { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

.notification-header-movil { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 15px 18px; display: flex; align-items: center; justify-content: space-between; }
.notification-header-movil h4 { margin: 0; font-size: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
.notification-header-actions-movil { display: flex; gap: 8px; }
.notification-header-actions-movil button { background: rgba(255, 255, 255, 0.2); border: none; color: white; padding: 6px 10px; border-radius: 8px; font-size: 11px; cursor: pointer; }
.notification-list-movil { max-height: 320px; overflow-y: auto; }
.notification-item-movil { padding: 14px 18px; border-bottom: 1px solid rgba(139, 92, 246, 0.15); cursor: pointer; transition: background 0.2s ease; display: flex; gap: 12px; align-items: flex-start; }
.notification-item-movil:hover { background: rgba(139, 92, 246, 0.1); }
.notification-item-movil:last-child { border-bottom: none; }
.notification-icon-movil { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 14px; }
.notification-icon-movil.type-1 { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; }
.notification-icon-movil.type-2 { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; }
.notification-icon-movil.type-3 { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; }
.notification-content-movil { flex: 1; min-width: 0; }
.notification-title-movil { font-size: 13px; font-weight: 600; color: white; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.notification-desc-movil { font-size: 12px; color: rgba(255,255,255,0.6); line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.notification-time-movil { font-size: 10px; color: rgba(139, 92, 246, 0.8); margin-top: 5px; }
.notification-empty-movil { padding: 40px 20px; text-align: center; color: rgba(255,255,255,0.5); }
.notification-empty-movil i { font-size: 40px; margin-bottom: 12px; display: block; color: rgba(139, 92, 246, 0.4); }
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
        url: '../admin/obtener_notificaciones_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) actualizarUINotificacionesMovil(response.notificaciones, response.count);
        }
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

$(document).on('click', function(e) {
    if (!$(e.target).closest('#notificationPanelMovil, #notificationBellMovil').length) $('#notificationPanelMovil').removeClass('show');
});

function marcarNotificacionLeidaMovil(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php',
        type: 'POST',
        data: { cod_notificacion: codNotificacion },
        dataType: 'json',
        success: function(response) {
            if (response.success) $(element).fadeOut(300, function() { $(this).remove(); cargarNotificacionesMovil(); });
        }
    });
}

function marcarTodasLeidasMovil() {
    Swal.fire({
        title: '¿Marcar todas como leídas?',
        text: 'Se marcarán todas las notificaciones pendientes como leídas',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#8b5cf6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, marcar todas',
        cancelButtonText: 'Cancelar',
        background: '#1a1f2e',
        color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/marcar_notificacion_leida_ajax.php',
                type: 'POST',
                data: { marcar_todas: 'si' },
                dataType: 'json',
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
</script>


<script>
    // Ocultar loader cuando la página haya cargado completamente
    window.addEventListener('load', function() {
        const loader = document.getElementById('loader-wrapper');
        if (loader) {
            // Pequeño retraso para asegurar que el usuario vea el loader
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                    // Animar elementos de la página
                    document.querySelectorAll('.animate-in').forEach((el, index) => {
                        setTimeout(() => {
                            el.style.opacity = '1';
                            el.style.transform = 'translateY(0)';
                        }, index * 50);
                    });
                }, 600);
            }, 300);
        }
    });

    // Mostrar el loader cuando se recargue la página
    window.addEventListener('beforeunload', function() {
        const loader = document.getElementById('loader-wrapper');
        if (loader) {
            loader.style.display = 'flex';
            loader.style.opacity = '1';
        }
    });

    // Ocultar el loader si tarda más de 10 segundos (fallback)
    setTimeout(function() {
        const loader = document.getElementById('loader-wrapper');
        if (loader && loader.style.display !== 'none') {
            console.warn('Loader forzado a ocultar después de 10 segundos');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 600);
        }
    }, 10000);
</script>

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
                    <button type="submit" class="submit-btn" style="flex: 1; margin-top: 0; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                        <i class="fa-solid fa-save"></i> Guardar Vendedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Registro Producto -->
<div class="modal-overlay" id="modalRegistroProducto" style="z-index: 5000; align-items: center; padding: 20px;">
    <div class="modal-content" style="max-width: 650px;">
        <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <h2><i class="fa-solid fa-box-open"></i> Registrar Producto</h2>
            <button class="modal-close" onclick="cerrarModalProducto()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 8px; padding: 0.75rem; margin-bottom: 1rem;">
                <strong style="color: #f59e0b;">Tienda:</strong> <span id="productoNombreTienda" style="color: white;"></span>
            </div>
            <form id="formRegistroProducto" enctype="multipart/form-data">
                <input type="hidden" id="producto_cod_tienda" name="cod_tienda" value="">
                <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                <input type="hidden" name="cod_estado" value="1">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Código de Barras *</label>
                        <input type="text" class="form-input" name="cod_producto_barra" placeholder="Ej: 7701234567890" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" name="cod_categoria">
                            <option value="0">Sin categoría</option>
                            <?php
                            $sql_cat_prod = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE cod_estado = '1' ORDER BY nombre_categoria ASC";
                            $res_cat_prod = mysqli_query($conectar, $sql_cat_prod);
                            if ($res_cat_prod) { while ($cat = mysqli_fetch_assoc($res_cat_prod)) { echo '<option value="'.$cat['cod_categoria'].'">'.ucwords(strtolower($cat['nombre_categoria'])).'</option>'; } }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre del Producto *</label>
                    <input type="text" class="form-input" name="nombre_producto" placeholder="Ej: Arroz Diana x 500g" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Precio Compra ($)</label>
                        <input type="text" class="form-input" inputmode="numeric" id="producto_precio_compra" placeholder="$ 0" value="0" oninput="formatearPrecio(this)">
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
                        <label class="form-label">IVA (%)</label>
                        <select class="form-select" name="iva_ptj">
                            <option value="0">0%</option>
                            <option value="5">5%</option>
                            <option value="19">19%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Imagen</label>
                        <div class="file-input-wrapper" style="padding: 0.75rem;">
                            <input type="file" name="imagen_producto" accept="image/*" onchange="previewImageProducto(this)">
                            <div class="file-input-icon" style="font-size: 1.2rem; margin-bottom: 0.2rem;"><i class="fa-solid fa-camera"></i></div>
                            <div class="file-input-text" style="font-size: 0.75rem;">Foto producto</div>
                        </div>
                    </div>
                </div>

                <img id="preview_producto_img" class="image-preview" alt="Vista previa" style="display:none; max-height:100px; margin-top:0.5rem;">

                <div class="form-group">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-input" name="descripcion_producto" rows="2" placeholder="Descripción del producto (opcional)" style="resize: vertical; min-height: 60px;"></textarea>
                </div>

                <button type="submit" class="submit-btn" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="fa-solid fa-box-open"></i> Registrar Producto
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

