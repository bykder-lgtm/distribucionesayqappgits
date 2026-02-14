<?php 
$nombre_pagina          = "Mis Tiendas";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style>
/* Estilos adicionales para la cuadrícula de tiendas */
.tiendas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1rem;
    padding: 0;
}

.tienda-card {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(65, 105, 225, 0.2);
}

.tienda-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 212, 255, 0.3);
    border-color: rgba(0, 212, 255, 0.5);
}

.tienda-card-header {
    position: relative;
    height: 120px;
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.tienda-card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, rgba(0, 212, 255, 0.3) 0%, transparent 70%);
    border-radius: 50%;
}

.tienda-logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    z-index: 1;
}

.tienda-logo-placeholder {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    border: 3px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    z-index: 1;
}

.tienda-card-body {
    padding: 1.25rem;
}

.tienda-nombre {
    color: #00d4ff;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 212, 255, 0.3);
}

.tienda-info {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.85rem;
    margin-bottom: 0.25rem;
}

.tienda-info i {
    width: 20px;
    color: #5b7ce6;
    margin-right: 0.5rem;
}

.tienda-estado {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0.75rem;
}

.tienda-estado.activo {
    background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(0, 212, 255, 0.5);
}

.tienda-estado.inactivo {
    background: linear-gradient(135deg, #ff6f00 0%, #ff9800 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(255, 111, 0, 0.5);
}

.tienda-card-footer {
    padding: 1rem 1.25rem;
    border-top: 1px solid rgba(65, 105, 225, 0.2);
    display: flex;
    gap: 0.5rem;
}

.btn-tienda {
    flex: 1;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    text-align: center;
}

.btn-tienda-primary {
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    color: white;
}

.btn-tienda-primary:hover {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.4);
    color: white;
    text-decoration: none;
}

.btn-tienda-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-tienda-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    text-decoration: none;
}

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: rgba(255, 255, 255, 0.7);
}

.empty-state i {
    font-size: 4rem;
    color: #5b7ce6;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state h4 {
    color: #00d4ff;
    margin-bottom: 0.5rem;
}

.page-header {
    margin-bottom: 1.5rem;
}

.page-title {
    color: #00d4ff;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    text-shadow: 0 2px 8px rgba(0, 212, 255, 0.3);
}

.page-subtitle {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    margin-top: 0.25rem;
}

/* Estilos para estadísticas de productos */
.tienda-stats {
    display: flex;
    justify-content: space-between;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid rgba(65, 105, 225, 0.2);
}

.stat-item {
    flex: 1;
    text-align: center;
    padding: 0.5rem 0.25rem;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
}

.stat-number {
    display: block;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 0.15rem;
}

.stat-label {
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.8;
}

.stat-total {
    color: #00d4ff;
}

.stat-activos {
    color: #48bb78;
}

.stat-inactivos {
    color: #ff9800;
}

/* Botón flotante para agregar tienda */
.btn-add-tienda {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
    border: none;
    padding: 0.6rem 1.2rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.4);
    text-decoration: none;
}

.btn-add-tienda:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 212, 255, 0.5);
    color: white;
    text-decoration: none;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.page-header-left {
    flex: 1;
}

/* Modal de nueva tienda */
.modal-tienda {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
    overflow-y: auto;
    padding: 1rem;
}

.modal-tienda-content {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    margin: 2% auto;
    padding: 0;
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 16px;
    width: 100%;
    max-width: 800px;
    box-shadow: 0 10px 40px rgba(0, 212, 255, 0.3);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-tienda-header {
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    color: white;
    padding: 1.25rem;
    border-radius: 16px 16px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-tienda-header h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.modal-close {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.modal-tienda-body {
    padding: 1.5rem;
}

/* Grid de dos columnas para los campos del formulario */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.form-group-tienda {
    margin-bottom: 0;
}

/* Campos que ocupan ancho completo */
.form-group-tienda.full-width {
    grid-column: 1 / -1;
}

.form-group-tienda label {
    display: block;
    color: #00d4ff;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-group-tienda input,
.form-group-tienda select {
    width: 100%;
    padding: 0.75rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 8px;
    color: white;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.form-group-tienda select {
    background: rgba(0, 212, 255, 0.1);
    color: white;
    cursor: pointer;
}

.form-group-tienda select option {
    background: #1a1d3a;
    color: white;
    padding: 0.5rem;
}

.form-group-tienda input:focus,
.form-group-tienda select:focus {
    outline: none;
    border-color: #00d4ff;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
}

.form-group-tienda input::placeholder {
    color: rgba(255, 255, 255, 0.4);
}

/* Estilos para secciones del formulario - ancho completo */
.form-section-title {
    grid-column: 1 / -1;
    color: #00d4ff;
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0.5rem 0 0.25rem 0;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid rgba(65, 105, 225, 0.3);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-section-title:first-child {
    margin-top: 0;
}

.form-section-title i {
    color: #5b7ce6;
}

/* Responsive: Una columna en móviles */
@media (max-width: 600px) {
    .modal-tienda-content {
        margin: 0 auto;
        border-radius: 12px;
        max-width: 100%;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .modal-tienda-body {
        padding: 1rem;
    }
    
    .modal-tienda-header {
        padding: 1rem;
        border-radius: 12px 12px 0 0;
    }
    
    .modal-tienda-header h3 {
        font-size: 1rem;
    }
}

.modal-tienda-footer {
    padding: 1rem 1.5rem 1.5rem;
    display: flex;
    gap: 0.75rem;
}

.btn-modal {
    flex: 1;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-modal-primary {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
}

.btn-modal-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.4);
}

.btn-modal-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.btn-modal-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
}

.alert-success {
    background: rgba(72, 187, 120, 0.2);
    border: 1px solid #48bb78;
    color: #48bb78;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    display: none;
    grid-column: 1 / -1;
}

.alert-error {
    background: rgba(255, 111, 0, 0.2);
    border: 1px solid #ff6f00;
    color: #ff6f00;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    display: none;
    grid-column: 1 / -1;
}

/* Estilos para campo de imagen */
.form-group-tienda .input-file-wrapper {
    position: relative;
}

.form-group-tienda input[type="file"] {
    padding: 0.5rem;
    background: rgba(255, 255, 255, 0.05);
}

.form-group-tienda input[type="file"]::file-selector-button {
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    margin-right: 0.75rem;
    transition: all 0.3s ease;
}

.form-group-tienda input[type="file"]::file-selector-button:hover {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
}

.preview-img-tienda {
    margin-top: 0.75rem;
    max-width: 150px;
    max-height: 150px;
    border-radius: 10px;
    display: none;
    border: 2px solid rgba(0, 212, 255, 0.3);
}

/* Estilos para campos de archivo con preview */
.file-preview-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.file-preview-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(0, 212, 255, 0.1);
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    font-size: 0.8rem;
    color: #00d4ff;
}

.file-preview-item i {
    color: #5b7ce6;
}

.required-star {
    color: #ff6b6b;
    margin-left: 2px;
}

/* Modal scrollable body */
.modal-tienda-body {
    padding: 1.5rem;
    max-height: 60vh;
    overflow-y: auto;
}

.modal-tienda-body::-webkit-scrollbar {
    width: 6px;
}

.modal-tienda-body::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 3px;
}

.modal-tienda-body::-webkit-scrollbar-thumb {
    background: rgba(0, 212, 255, 0.3);
    border-radius: 3px;
}

.modal-tienda-body::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 212, 255, 0.5);
}

/* Estilos para campo GPS */
.gps-input-wrapper {
    display: flex;
    gap: 0.5rem;
}

.gps-input-wrapper input {
    flex: 1;
}

.btn-gps {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    white-space: nowrap;
}

.btn-gps:hover {
    background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.4);
}

.btn-gps:disabled {
    background: rgba(255, 255, 255, 0.2);
    cursor: not-allowed;
    transform: none;
}

.btn-gps i {
    font-size: 1rem;
}

.gps-status {
    font-size: 0.75rem;
    margin-top: 0.5rem;
    padding: 0.4rem 0.75rem;
    border-radius: 6px;
    display: none;
}

.gps-status.success {
    background: rgba(72, 187, 120, 0.2);
    color: #48bb78;
    display: block;
}

.gps-status.error {
    background: rgba(255, 111, 0, 0.2);
    color: #ff6f00;
    display: block;
}

.gps-status.loading {
    background: rgba(0, 212, 255, 0.2);
    color: #00d4ff;
    display: block;
}

/* Sección de compartir URL de tienda */
.tienda-share-section {
    padding: 0.75rem 1.25rem;
    border-top: 1px solid rgba(65, 105, 225, 0.2);
    background: rgba(0, 212, 255, 0.05);
}

.share-title {
    font-size: 0.75rem;
    color: #00d4ff;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.share-buttons {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.5rem;
}

.btn-share {
    padding: 0.5rem 0.75rem;
    border: none;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
}

.btn-share i {
    font-size: 0.9rem;
}

.btn-share-whatsapp {
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
    color: white;
}

.btn-share-whatsapp:hover {
    background: linear-gradient(135deg, #128C7E 0%, #25D366 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
    color: white;
}

.btn-share-email {
    background: linear-gradient(135deg, #EA4335 0%, #D93025 100%);
    color: white;
}

.btn-share-email:hover {
    background: linear-gradient(135deg, #D93025 0%, #EA4335 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(234, 67, 53, 0.4);
    color: white;
}

.btn-share-copy {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: white;
}

.btn-share-copy:hover {
    background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    color: white;
}

/* Responsive: En móviles mostrar íconos más grandes */
@media (max-width: 400px) {
    .btn-share span {
        display: none;
    }
    .btn-share i {
        font-size: 1.1rem;
    }
    .btn-share {
        padding: 0.6rem;
    }
}

/* MODAL DE NOTIFICACIÓN */
.modal-notificacion {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(8px);
    align-items: center;
    justify-content: center;
}

.modal-notificacion.show {
    display: flex;
}

.modal-notificacion-content {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    padding: 0;
    border: 2px solid rgba(65, 105, 225, 0.4);
    border-radius: 20px;
    width: 90%;
    max-width: 450px;
    box-shadow: 0 20px 60px rgba(0, 212, 255, 0.4);
    animation: notifSlideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    overflow: hidden;
}

@keyframes notifSlideIn {
    from {
        opacity: 0;
        transform: scale(0.7) translateY(-50px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.modal-notificacion-header {
    padding: 2rem 1.5rem 1.5rem;
    text-align: center;
}

.modal-notificacion-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin: 0 auto 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    animation: iconBounce 0.6s ease;
}

@keyframes iconBounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.modal-notificacion-icon.success {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    box-shadow: 0 8px 30px rgba(72, 187, 120, 0.5);
}

.modal-notificacion-icon.error {
    background: linear-gradient(135deg, #ff6f00 0%, #e65100 100%);
    color: white;
    box-shadow: 0 8px 30px rgba(255, 111, 0, 0.5);
}

.modal-notificacion-body {
    padding: 0 1.5rem 2rem;
    text-align: center;
}

.modal-notificacion-title {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: #00d4ff;
    text-shadow: 0 2px 8px rgba(0, 212, 255, 0.3);
}

.modal-notificacion-message {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.modal-notificacion-footer {
    padding: 0 1.5rem 2rem;
    text-align: center;
}

.btn-notificacion {
    padding: 0.85rem 2.5rem;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 140px;
}

.btn-notificacion.success {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.4);
}

.btn-notificacion.success:hover {
    background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(72, 187, 120, 0.5);
}

.btn-notificacion.error {
    background: linear-gradient(135deg, #ff6f00 0%, #e65100 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(255, 111, 0, 0.4);
}

.btn-notificacion.error:hover {
    background: linear-gradient(135deg, #e65100 0%, #ff6f00 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 111, 0, 0.5);
}

@media (max-width: 500px) {
    .modal-notificacion-content {
        width: 95%;
        max-width: 350px;
    }
    .modal-notificacion-icon {
        width: 70px;
        height: 70px;
        font-size: 2rem;
    }
    .modal-notificacion-title {
        font-size: 1.2rem;
    }
    .modal-notificacion-message {
        font-size: 0.9rem;
    }
}
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<?php
// Verificar cantidad de tiendas del aliado
$sql_count_tiendas = "SELECT COUNT(*) as total_tiendas FROM tbl15_tienda WHERE (cod_aliado_estrategico = '$cod_administrador')";
$consulta_count = mysqli_query($conectar, $sql_count_tiendas);
$datos_count = mysqli_fetch_assoc($consulta_count);
$total_tiendas_aliado = $datos_count['total_tiendas'];
?>

<main class="container py-4 mb-5">
    <!-- Encabezado de la página -->
    <div class="page-header">
        <div class="page-header-left">
            <h1 class="page-title"><i class="fa fa-store"></i> Mis Tiendas</h1>
            <p class="page-subtitle">Gestiona las tiendas asociadas a tu cuenta</p>
        </div>
        <?php if ($total_tiendas_aliado == 0) { ?>
        <button class="btn-add-tienda" onclick="abrirModalTienda()"><i class="fa fa-plus"></i> Nueva Tienda</button>
        <?php } ?>
    </div>

    <!-- Contenedor de tarjetas -->
    <div class="tiendas-grid">
        <?php
        // Obtener las tiendas del aliado logueado
        $sql_tiendas = "SELECT * FROM tbl15_tienda WHERE (cod_aliado_estrategico = '$cod_administrador') ORDER BY nombre_tienda ASC";
        $consulta_tiendas = mysqli_query($conectar, $sql_tiendas);
        if (mysqli_num_rows($consulta_tiendas) > 0) {
            while ($tienda = mysqli_fetch_assoc($consulta_tiendas)) {
                $cod_tienda_item = $tienda['cod_tienda'];
                $nombre_tienda = $tienda['nombre_tienda'];
                $abrev_tienda = $tienda['abrev_tienda'];
                $direccion_tienda = isset($tienda['direccion_tienda']) ? $tienda['direccion_tienda'] : '';
                $telefono_tienda = isset($tienda['telefono_tienda']) ? $tienda['telefono_tienda'] : '';
                $url_img_tienda = isset($tienda['url_img_orig_tienda']) ? $tienda['url_img_orig_tienda'] : '';
                $cod_estado_tienda = isset($tienda['cod_estado']) ? $tienda['cod_estado'] : '1';
                
                $estado_class = ($cod_estado_tienda == '1') ? 'activo' : 'inactivo';
                $estado_text = ($cod_estado_tienda == '1') ? 'Activa' : 'Inactiva';
                
                // Contar productos de esta tienda
                $sql_total_prod = "SELECT COUNT(*) as total FROM tbl15_producto WHERE cod_tienda = '$cod_tienda_item'";
                $consulta_total = mysqli_query($conectar, $sql_total_prod);
                $datos_total = mysqli_fetch_assoc($consulta_total);
                $total_productos = $datos_total['total'];
                
                $sql_activos = "SELECT COUNT(*) as total FROM tbl15_producto WHERE cod_tienda = '$cod_tienda_item' AND nombre_estado = 'HABILITADO'";
                $consulta_activos = mysqli_query($conectar, $sql_activos);
                $datos_activos = mysqli_fetch_assoc($consulta_activos);
                $productos_activos = $datos_activos['total'];
                
                $productos_inactivos = $total_productos - $productos_activos;
        ?>
        <div class="tienda-card">
            <div class="tienda-card-header">
                <?php if (!empty($url_img_tienda) && file_exists($url_img_tienda)) { ?>
                    <img src="<?php echo $url_img_tienda; ?>" alt="<?php echo $nombre_tienda; ?>" class="tienda-logo">
                <?php } else { ?>
                    <div class="tienda-logo-placeholder"><i class="fa fa-store"></i></div>
                <?php } ?>
            </div>
            <div class="tienda-card-body">
                <h3 class="tienda-nombre"><?php echo ucwords(strtolower($nombre_tienda)); ?></h3>
                <?php if (!empty($abrev_tienda)) { ?>
                    <p class="tienda-info"><i class="fa fa-tag"></i><?php echo $abrev_tienda; ?></p>
                <?php } ?>
                <?php if (!empty($direccion_tienda)) { ?>
                    <p class="tienda-info"><i class="fa fa-map-marker"></i><?php echo $direccion_tienda; ?></p>
                <?php } ?>
                <?php if (!empty($telefono_tienda)) { ?>
                    <p class="tienda-info"><i class="fa fa-phone"></i><?php echo $telefono_tienda; ?></p>
                <?php } ?>
                <span class="tienda-estado <?php echo $estado_class; ?>"><?php echo $estado_text; ?></span>
                
                <!-- Estadísticas de productos -->
                <div class="tienda-stats">
                    <div class="stat-item stat-total">
                        <span class="stat-number"><?php echo $total_productos; ?></span>
                        <span class="stat-label">Total</span>
                    </div>
                    <div class="stat-item stat-activos">
                        <span class="stat-number"><?php echo $productos_activos; ?></span>
                        <span class="stat-label">Activos</span>
                    </div>
                    <div class="stat-item stat-inactivos">
                        <span class="stat-number"><?php echo $productos_inactivos; ?></span>
                        <span class="stat-label">Inactivos</span>
                    </div>
                </div>
            </div>
            <div class="tienda-card-footer">
                <!--<a href="ver_catalogo_producto_visitante_intern.php?cod_tienda=<?php echo $cod_tienda_item; ?>" class="btn-tienda btn-tienda-primary"><i class="fa fa-eye"></i> Ver Catálogo</a>-->
                <a href="../admin/lista_catalogo_tienda_productos_aliado_movil.php?cod_tienda=<?php echo $cod_tienda_item; ?>" class="btn-tienda btn-tienda-primary"><i class="fa fa-eye"></i> Ver Catálogo</a>
                <a href="../admin/ver_detalle_tienda_aliado_movil.php?cod_tienda=<?php echo $cod_tienda_item; ?>" class="btn-tienda btn-tienda-secondary"><i class="fa fa-info-circle"></i> Ver Detalle</a>
                <button type="button" class="btn-tienda btn-tienda-secondary" onclick="abrirModalEditarTienda(<?php echo $cod_tienda_item; ?>)"><i class="fa fa-edit"></i> Editar</button>
            </div>
            <!-- Sección de Compartir URL de la Tienda -->
            <div class="tienda-share-section">
                <div class="share-title">
                    <i class="fa fa-share-alt"></i> Compartir Enlace de la Tienda
                </div>
                <div class="share-buttons">
                    <button type="button" class="btn-share btn-share-whatsapp" onclick="compartirTiendaWhatsApp('<?php echo $cod_tienda_item; ?>', '<?php echo addslashes($nombre_tienda); ?>')">
                        <i class="fa-brands fa-whatsapp"></i> <span>WhatsApp</span>
                    </button>
                    <button type="button" class="btn-share btn-share-email" onclick="compartirTiendaEmail('<?php echo $cod_tienda_item; ?>', '<?php echo addslashes($nombre_tienda); ?>')">
                        <i class="fa fa-envelope"></i> <span>Email</span>
                    </button>
                    <button type="button" class="btn-share btn-share-copy" onclick="copiarEnlaceTienda('<?php echo $cod_tienda_item; ?>', '<?php echo addslashes($nombre_tienda); ?>')">
                        <i class="fa fa-copy"></i> <span>Copiar</span>
                    </button>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
        ?>
        <div class="empty-state" style="grid-column: 1 / -1;">
            <i class="fa fa-store"></i>
            <h4>No tienes tiendas asignadas</h4>
            <p>Contacta al administrador para asignar tiendas a tu cuenta.</p>
        </div>
        <?php } ?>
    </div>
</main>

<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>

<!-- Modal para registrar nueva tienda -->
<div id="modalNuevaTienda" class="modal-tienda">
    <div class="modal-tienda-content">

        <div class="modal-tienda-header">
            <h3><i class="fa fa-store"></i> Registrar Nueva Tienda</h3>
            <button class="modal-close" onclick="cerrarModalTienda()">&times;</button>
        </div>

        <form id="formNuevaTienda" onsubmit="return registrarTienda(event)" enctype="multipart/form-data">
            <div class="modal-tienda-body form-grid">
                <div id="alertSuccess" class="alert-success">
                    <i class="fa fa-check-circle"></i> <span id="alertSuccessText">Tienda registrada exitosamente</span>
                </div>
                <div id="alertError" class="alert-error">
                    <i class="fa fa-exclamation-circle"></i> <span id="alertErrorText">Error al registrar la tienda</span>
                </div>
                
                <!-- SECCIÓN: Información Básica -->
                <div class="form-section-title"><i class="fa fa-info-circle"></i> Información Básica</div>
                
                <div class="form-group-tienda">
                    <label for="nombre_tienda"><i class="fa fa-building"></i> Nombre de la Tienda <span class="required-star">*</span></label>
                    <input type="text" id="nombre_tienda" name="nombre_tienda" placeholder="Ej: Mi Tienda Principal" required>
                </div>
                
                <div class="form-group-tienda">
                    <label for="identificacion_tercero"><i class="fa fa-id-card"></i> NIT de la Tienda</label>
                    <input type="text" id="identificacion_tercero" name="identificacion_tercero" placeholder="Ej: 900123456-7">
                </div>

                
                <div class="form-group-tienda">
                    <label for="direccion_tienda"><i class="fa fa-map-marker"></i> Dirección</label>
                    <input type="text" id="direccion_tienda" name="direccion_tienda" placeholder="Ej: Calle 123 #45-67">
                </div>
                
                <div class="form-group-tienda">
                    <label for="telefono_tienda"><i class="fa fa-phone"></i> Teléfono</label>
                    <input type="text" id="telefono_tienda" name="telefono_tienda" placeholder="Ej: 3001234567">
                </div>
                
                <div class="form-group-tienda">
                    <label for="correo_tercero"><i class="fa fa-envelope"></i> Correo Electrónico</label>
                    <input type="email" id="correo_tercero" name="correo_tercero" placeholder="Ej: tienda@ejemplo.com">
                </div>
                
                <div class="form-group-tienda">
                    <label for="ubicacion_gps_tienda"><i class="fa fa-map-marker-alt"></i> Ubicación GPS</label>
                    <div class="gps-input-wrapper">
                        <input type="text" id="ubicacion_gps_tienda" name="ubicacion_gps_tienda" placeholder="Ej: 4.7110,-74.0721" readonly>
                        <button type="button" class="btn-gps" onclick="obtenerUbicacionGPS('ubicacion_gps_tienda', 'gps_status_nueva')">
                            <i class="fa fa-crosshairs"></i> Obtener
                        </button>
                    </div>
                    <div id="gps_status_nueva" class="gps-status"></div>
                </div>

                <div class="form-group-tienda">
                    <label for="cod_departamento"><i class="fa fa-map"></i> Departamento <span class="required-star">*</span></label>
                    <select id="cod_departamento" name="cod_departamento" onchange="cargarMunicipiosNuevaTienda()" required>
                        <option value="">Seleccione un departamento</option>
                    </select>
                </div>
                
                <div class="form-group-tienda">
                    <label for="cod_municipio"><i class="fa fa-map-pin"></i> Municipio <span class="required-star">*</span></label>
                    <select id="cod_municipio" name="cod_municipio" required>
                        <option value="">Seleccione primero un departamento</option>
                    </select>
                </div>
                
                <!-- SECCIÓN: Documentación Legal -->
                <div class="form-section-title"><i class="fa fa-folder-open"></i> Documentación Legal</div>
                
                <div class="form-group-tienda">
                    <label for="rut_tienda"><i class="fa fa-file-pdf"></i> RUT de la Tienda <span class="required-star">*</span></label>
                    <input type="file" id="rut_tienda" name="url_documentacion_rut_tienda" accept=".pdf,.jpg,.jpeg,.png" required>
                    <div id="preview_rut_tienda" class="file-preview-container"></div>
                </div>
                
                <div class="form-group-tienda">
                    <label for="camaracomercio_tienda"><i class="fa fa-file-pdf"></i> Cámara de Comercio <span class="required-star">*</span></label>
                    <input type="file" id="camaracomercio_tienda" name="url_documentacion_camaracomercio_tienda" accept=".pdf,.jpg,.jpeg,.png" required>
                    <div id="preview_camaracomercio_tienda" class="file-preview-container"></div>
                </div>
<!--
                <div class="form-group-tienda">
                    <label for="contratofirma_tienda"><i class="fa fa-file-signature"></i> Contrato Firmado <span class="required-star">*</span></label>
                    <input type="file" id="contratofirma_tienda" name="url_documentacion_contratofirma_tienda" accept=".pdf,.jpg,.jpeg,.png" required>
                    <div id="preview_contratofirma_tienda" class="file-preview-container"></div>
                </div>
-->
                <div class="form-group-tienda">
                    <label for="extra1_tienda"><i class="fa fa-file-alt"></i> Documentación Extra (Opcional)</label>
                    <input type="file" id="extra1_tienda" name="url_documentacion_extra1_tienda" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="preview_extra1_tienda" class="file-preview-container"></div>
                </div>
                
                <!-- SECCIÓN: Imágenes del Establecimiento -->
                <div class="form-section-title"><i class="fa fa-camera"></i> Imágenes del Establecimiento</div>

                <div class="form-group-tienda">
                    <label for="imagen_tienda"><i class="fa fa-image"></i> Imagen / Logo de la Tienda</label>
                    <input type="file" id="imagen_tienda" name="imagen_tienda" accept="image/*">
                    <img id="preview_img_tienda" src="" class="preview-img-tienda" alt="Vista previa">
                </div>

                <div class="form-group-tienda">
                    <label for="img_fachada_tienda"><i class="fa fa-store-alt"></i> Imagen de la Fachada <span class="required-star">*</span></label>
                    <input type="file" id="img_fachada_tienda" name="url_img_fachada_tienda" accept="image/*" required>
                    <img id="preview_img_fachada" src="" class="preview-img-tienda" alt="Vista previa fachada">
                </div>
                
                <div class="form-group-tienda">
                    <label for="img_interna_tienda"><i class="fa fa-door-open"></i> Imagen Interna de la Tienda <span class="required-star">*</span></label>
                    <input type="file" id="img_interna_tienda" name="url_img_interna_tienda" accept="image/*" required>
                    <img id="preview_img_interna" src="" class="preview-img-tienda" alt="Vista previa interna">
                </div>
                
                <div class="form-group-tienda">
                    <label for="img_selfieadmin_tienda"><i class="fa fa-user-circle"></i> Selfie del Administrador en la Tienda <span class="required-star">*</span></label>
                    <input type="file" id="img_selfieadmin_tienda" name="url_img_selfieadmin_tienda" accept="image/*" required>
                    <img id="preview_img_selfieadmin" src="" class="preview-img-tienda" alt="Vista previa selfie">
                </div>
                
                <div class="form-group-tienda">
                    <label for="img_otraopcional_tienda"><i class="fa fa-image"></i> Otra Imagen (Opcional)</label>
                    <input type="file" id="img_otraopcional_tienda" name="url_img_otraopcional_tienda" accept="image/*">
                    <img id="preview_img_otraopcional" src="" class="preview-img-tienda" alt="Vista previa opcional">
                </div>
            </div>
            <div class="modal-tienda-footer">
                <button type="button" class="btn-modal btn-modal-secondary" onclick="cerrarModalTienda()">Cancelar</button>
                <button type="submit" class="btn-modal btn-modal-primary" id="btnRegistrar">
                    <i class="fa fa-save"></i> Registrar Tienda
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Cargar departamentos en el modal de nueva tienda
function cargarDepartamentosNuevaTienda() {
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php',
        type: 'GET',
        dataType: 'json',
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

// Cargar municipios en el modal de nueva tienda
function cargarMunicipiosNuevaTienda() {
    var codDepartamento = $('#cod_departamento').val();
    var selectMuni = $('#cod_municipio');
    selectMuni.empty();
    selectMuni.append('<option value="">Seleccione un municipio *</option>');
    
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
                    selectMuni.append('<option value="' + muni.cod_municipio + '">' +
                                    muni.nombre_municipio + '</option>');
                });
            }
        },
        error: function() {
            console.error('Error al cargar municipios');
        }
    });
}

// Cargar departamentos en el modal de edición
function cargarDepartamentosEditarTienda(selectedDept, selectedMuni) {
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var select = $('#edit_cod_departamento');
                select.empty();
                select.append('<option value="">Seleccione un departamento *</option>');
                $.each(response.departamentos, function(index, dept) {
                    var selected = (dept.cod_departamento == selectedDept) ? 'selected' : '';
                    select.append('<option value="' + dept.cod_departamento + '" ' + selected + '>' +
                                dept.nombre_departamento + '</option>');
                });
                // Si hay departamento seleccionado, cargar municipios
                if (selectedDept) {
                    cargarMunicipiosEditarTienda(selectedDept, selectedMuni);
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar departamentos editar:', status, error);
        }
    });
}

// Cargar municipios en el modal de edición
function cargarMunicipiosEditarTienda(codDepartamento, selectedMuni) {
    if (!codDepartamento) {
        codDepartamento = $('#edit_cod_departamento').val();
    }
    var selectMuni = $('#edit_cod_municipio');
    selectMuni.empty();
    selectMuni.append('<option value="">Seleccione un municipio *</option>');
    
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
            console.error('Error al cargar municipios en editar');
        }
    });
}

function abrirModalTienda() {
    document.getElementById('modalNuevaTienda').style.display = 'block';
    document.getElementById('formNuevaTienda').reset();
    document.getElementById('alertSuccess').style.display = 'none';
    document.getElementById('alertError').style.display = 'none';
    
    // Cargar departamentos
    cargarDepartamentosNuevaTienda();
    
    // Ocultar previews de imágenes
    var imagePreviews = ['preview_img_tienda', 'preview_img_fachada', 'preview_img_interna', 'preview_img_selfieadmin', 'preview_img_otraopcional'];
    imagePreviews.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) {
            el.style.display = 'none';
            el.src = '';
        }
    });
    
    // Limpiar previews de documentos
    var docPreviews = ['preview_rut_tienda', 'preview_camaracomercio_tienda', 'preview_contratofirma_tienda', 'preview_extra1_tienda'];
    docPreviews.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.innerHTML = '';
    });
}

function cerrarModalTienda() {
    document.getElementById('modalNuevaTienda').style.display = 'none';
}

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    var modal = document.getElementById('modalNuevaTienda');
    if (event.target == modal) {
        cerrarModalTienda();
    }
}

// Función para previsualizar imágenes
function setupImagePreview(inputId, previewId) {
    var input = document.getElementById(inputId);
    if (input) {
        input.addEventListener('change', function(e) {
            var preview = document.getElementById(previewId);
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.style.display = 'none';
                preview.src = '';
            }
        });
    }
}

// Función para obtener ubicación GPS
function obtenerUbicacionGPS(inputId, statusId) {
    var input = document.getElementById(inputId);
    var status = document.getElementById(statusId);
    
    if (!navigator.geolocation) {
        status.className = 'gps-status error';
        status.innerHTML = '<i class="fa fa-exclamation-triangle"></i> Tu navegador no soporta geolocalización';
        return;
    }
    
    status.className = 'gps-status loading';
    status.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Obteniendo ubicación...';
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            var lat = position.coords.latitude.toFixed(6);
            var lng = position.coords.longitude.toFixed(6);
            input.value = lat + ',' + lng;
            status.className = 'gps-status success';
            status.innerHTML = '<i class="fa fa-check-circle"></i> Ubicación obtenida: ' + lat + ', ' + lng;
        },
        function(error) {
            var mensaje = 'Error al obtener ubicación';
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    mensaje = 'Permiso denegado. Por favor habilita el GPS.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    mensaje = 'Información de ubicación no disponible.';
                    break;
                case error.TIMEOUT:
                    mensaje = 'Tiempo de espera agotado.';
                    break;
            }
            status.className = 'gps-status error';
            status.innerHTML = '<i class="fa fa-exclamation-triangle"></i> ' + mensaje;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

// Función para previsualizar documentos
function setupDocPreview(inputId, previewId) {
    var input = document.getElementById(inputId);
    if (input) {
        input.addEventListener('change', function(e) {
            var preview = document.getElementById(previewId);
            if (this.files && this.files[0]) {
                var fileName = this.files[0].name;
                var fileSize = (this.files[0].size / 1024).toFixed(1) + ' KB';
                preview.innerHTML = '<div class="file-preview-item"><i class="fa fa-file"></i> ' + fileName + ' (' + fileSize + ')</div>';
            } else {
                preview.innerHTML = '';
            }
        });
    }
}

// Configurar previsualizaciones al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // Previews de imágenes - Modal Nueva Tienda
    setupImagePreview('imagen_tienda', 'preview_img_tienda');
    setupImagePreview('img_fachada_tienda', 'preview_img_fachada');
    setupImagePreview('img_interna_tienda', 'preview_img_interna');
    setupImagePreview('img_selfieadmin_tienda', 'preview_img_selfieadmin');
    setupImagePreview('img_otraopcional_tienda', 'preview_img_otraopcional');
    
    // Previews de documentos - Modal Nueva Tienda
    setupDocPreview('rut_tienda', 'preview_rut_tienda');
    setupDocPreview('camaracomercio_tienda', 'preview_camaracomercio_tienda');
    setupDocPreview('contratofirma_tienda', 'preview_contratofirma_tienda');
    setupDocPreview('extra1_tienda', 'preview_extra1_tienda');
    
    // Previews de imágenes - Modal Editar Tienda
    setupImagePreview('edit_imagen_tienda', 'preview_img_tienda_edit');
    setupImagePreview('edit_img_fachada_tienda', 'edit_preview_img_fachada');
    setupImagePreview('edit_img_interna_tienda', 'edit_preview_img_interna');
    setupImagePreview('edit_img_selfieadmin_tienda', 'edit_preview_img_selfieadmin');
    setupImagePreview('edit_img_otraopcional_tienda', 'edit_preview_img_otraopcional');
    
    // Previews de documentos - Modal Editar Tienda
    setupDocPreview('edit_rut_tienda', 'edit_preview_rut_tienda');
    setupDocPreview('edit_camaracomercio_tienda', 'edit_preview_camaracomercio_tienda');
    setupDocPreview('edit_contratofirma_tienda', 'edit_preview_contratofirma_tienda');
    setupDocPreview('edit_extra1_tienda', 'edit_preview_extra1_tienda');
});

// =====================================================
// FUNCIONES PARA MODAL DE NOTIFICACIÓN
// =====================================================
function mostrarModalNotificacion(tipo, titulo, mensaje, recargar) {
    var modal = document.getElementById('modalNotificacion');
    var icon = document.getElementById('notifIcon');
    var iconSymbol = document.getElementById('notifIconSymbol');
    var titleEl = document.getElementById('notifTitle');
    var messageEl = document.getElementById('notifMessage');
    var button = document.getElementById('notifButton');
    
    // Remover clases previas
    icon.classList.remove('success', 'error');
    button.classList.remove('success', 'error');
    
    if (tipo === 'success') {
        icon.classList.add('success');
        button.classList.add('success');
        iconSymbol.className = 'fa fa-check-circle';
        titleEl.textContent = titulo || '¡Éxito!';
    } else {
        icon.classList.add('error');
        button.classList.add('error');
        iconSymbol.className = 'fa fa-exclamation-circle';
        titleEl.textContent = titulo || 'Error';
    }
    
    messageEl.textContent = mensaje;
    modal.classList.add('show');
    
    // Si debe recargar la página al cerrar
    if (recargar) {
        button.setAttribute('data-reload', 'true');
    } else {
        button.removeAttribute('data-reload');
    }
}

function cerrarModalNotificacion() {
    var modal = document.getElementById('modalNotificacion');
    var button = document.getElementById('notifButton');
    
    modal.classList.remove('show');
    
    // Si tiene atributo de recargar, recargar la página
    if (button.getAttribute('data-reload') === 'true') {
        setTimeout(function() {
            location.reload();
        }, 300);
    }
}

function registrarTienda(event) {
    event.preventDefault();
    
    var nombre_tienda = document.getElementById('nombre_tienda').value.trim();
    
    if (nombre_tienda === '') {
        mostrarModalNotificacion('error', 'Campo Requerido', 'El nombre de la tienda es obligatorio', false);
        return false;
    }
    
    document.getElementById('btnRegistrar').disabled = true;
    document.getElementById('btnRegistrar').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Registrando...';
    
    // Usar FormData para enviar archivos
    var formData = new FormData(document.getElementById('formNuevaTienda'));
    formData.append('cod_aliado_estrategico', '<?php echo $cod_administrador; ?>');
    
    $.ajax({
        url: 'registrar_tienda_aliado_movil_ajax.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            // Cerrar el modal de registro
            cerrarModalTienda();
            
            if (response.success) {
                mostrarModalNotificacion(
                    'success',
                    '¡Tienda Registrada!',
                    response.message || 'La tienda se registró correctamente. La página se recargará para mostrar los cambios.',
                    true // recargar al cerrar
                );
            } else {
                mostrarModalNotificacion(
                    'error',
                    'Error al Registrar',
                    response.message || 'No se pudo registrar la tienda. Por favor, verifica los datos e intenta nuevamente.',
                    false
                );
            }
        },
        error: function(xhr, status, error) {
            cerrarModalTienda();
            mostrarModalNotificacion(
                'error',
                'Error de Conexión',
                'No se pudo conectar con el servidor. Por favor, verifica tu conexión a internet e intenta nuevamente.',
                false
            );
        },
        complete: function() {
            document.getElementById('btnRegistrar').disabled = false;
            document.getElementById('btnRegistrar').innerHTML = '<i class="fa fa-save"></i> Registrar Tienda';
        }
    });
    
    return false;
}

// ===================== EDITAR TIENDA =====================
function abrirModalEditarTienda(codTienda) {
    // Limpiar modal
    document.getElementById('formEditarTienda').reset();
    document.getElementById('alertEditSuccess').style.display = 'none';
    document.getElementById('alertEditError').style.display = 'none';
    
    // Ocultar previews de imágenes
    var imagePreviews = ['preview_img_tienda_edit', 'edit_preview_img_fachada', 'edit_preview_img_interna', 'edit_preview_img_selfieadmin', 'edit_preview_img_otraopcional'];
    imagePreviews.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) {
            el.style.display = 'none';
            el.src = '';
        }
    });
    
    // Limpiar previews de documentos
    var docPreviews = ['edit_preview_rut_tienda', 'edit_preview_camaracomercio_tienda', 'edit_preview_contratofirma_tienda', 'edit_preview_extra1_tienda'];
    docPreviews.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.innerHTML = '';
    });
    
    // Mostrar loader
    document.getElementById('btnActualizar').disabled = true;
    document.getElementById('btnActualizar').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Cargando...';
    
    // Mostrar modal
    document.getElementById('modalEditarTienda').style.display = 'block';
    
    // Cargar datos de la tienda
    $.ajax({
        url: 'obtener_tienda_aliado_ajax.php',
        type: 'GET',
        data: { cod_tienda: codTienda },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var tienda = response.tienda;
                document.getElementById('edit_cod_tienda').value = tienda.cod_tienda;
                document.getElementById('edit_nombre_tienda').value = tienda.nombre_tienda;
                document.getElementById('edit_identificacion_tercero').value = tienda.identificacion_tercero || '';
                document.getElementById('edit_direccion_tienda').value = tienda.direccion_tercero || '';
                document.getElementById('edit_telefono_tienda').value = tienda.telefono1_tercero || '';
                document.getElementById('edit_correo_tercero').value = tienda.correo_tercero || '';
                document.getElementById('edit_ubicacion_gps_tienda').value = tienda.ubicacion_gps_tienda || '';
                document.getElementById('edit_cod_estado').value = tienda.cod_estado;
                
                // Cargar departamentos y municipios con valores guardados
                cargarDepartamentosEditarTienda(tienda.cod_departamento, tienda.cod_municipio);
                
                // Mostrar imagen actual si existe
                if (tienda.url_img_min_tienda || tienda.url_img_orig_tienda) {
                    document.getElementById('preview_img_tienda_edit').src = tienda.url_img_min_tienda || tienda.url_img_orig_tienda;
                    document.getElementById('preview_img_tienda_edit').style.display = 'block';
                }
                // Mostrar imágenes del establecimiento si existen
                if (tienda.url_img_fachada_tienda) {
                    document.getElementById('edit_preview_img_fachada').src = tienda.url_img_fachada_tienda;
                    document.getElementById('edit_preview_img_fachada').style.display = 'block';
                }
                if (tienda.url_img_interna_tienda) {
                    document.getElementById('edit_preview_img_interna').src = tienda.url_img_interna_tienda;
                    document.getElementById('edit_preview_img_interna').style.display = 'block';
                }
                if (tienda.url_img_selfieadmin_tienda) {
                    document.getElementById('edit_preview_img_selfieadmin').src = tienda.url_img_selfieadmin_tienda;
                    document.getElementById('edit_preview_img_selfieadmin').style.display = 'block';
                }
                if (tienda.url_img_otraopcional_tienda) {
                    document.getElementById('edit_preview_img_otraopcional').src = tienda.url_img_otraopcional_tienda;
                    document.getElementById('edit_preview_img_otraopcional').style.display = 'block';
                }
                // Mostrar indicadores de documentos existentes
                if (tienda.url_documentacion_rut_tienda) {
                    document.getElementById('edit_preview_rut_tienda').innerHTML = '<div class="file-preview-item"><i class="fa fa-check-circle"></i> Documento cargado</div>';
                }
                if (tienda.url_documentacion_camaracomercio_tienda) {
                    document.getElementById('edit_preview_camaracomercio_tienda').innerHTML = '<div class="file-preview-item"><i class="fa fa-check-circle"></i> Documento cargado</div>';
                }
                if (tienda.url_documentacion_contratofirma_tienda) {
                    document.getElementById('edit_preview_contratofirma_tienda').innerHTML = '<div class="file-preview-item"><i class="fa fa-check-circle"></i> Documento cargado</div>';
                }
                if (tienda.url_documentacion_extra1_tienda) {
                    document.getElementById('edit_preview_extra1_tienda').innerHTML = '<div class="file-preview-item"><i class="fa fa-check-circle"></i> Documento cargado</div>';
                }
            } else {
                document.getElementById('alertEditErrorText').innerText = response.message || 'Error al cargar datos';
                document.getElementById('alertEditError').style.display = 'block';
            }
        },
        error: function() {
            document.getElementById('alertEditErrorText').innerText = 'Error de conexión. Intente nuevamente.';
            document.getElementById('alertEditError').style.display = 'block';
        },
        complete: function() {
            document.getElementById('btnActualizar').disabled = false;
            document.getElementById('btnActualizar').innerHTML = '<i class="fa fa-save"></i> Guardar Cambios';
        }
    });
}

function cerrarModalEditarTienda() {
    document.getElementById('modalEditarTienda').style.display = 'none';
}
// Previsualización de imagen en edición
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('edit_imagen_tienda').addEventListener('change', function(e) {
        var input = this;
        var preview = document.getElementById('preview_img_tienda_edit');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
});

function actualizarTienda(event) {
    event.preventDefault();
    
    var nombre_tienda = document.getElementById('edit_nombre_tienda').value.trim();
    
    if (nombre_tienda === '') {
        mostrarModalNotificacion('error', 'Campo Requerido', 'El nombre de la tienda es obligatorio', false);
        return false;
    }
    
    document.getElementById('btnActualizar').disabled = true;
    document.getElementById('btnActualizar').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
    
    // Usar FormData para enviar archivos
    var formData = new FormData(document.getElementById('formEditarTienda'));
    
    $.ajax({
        url: 'editar_tienda_aliado_ajax.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            // Cerrar el modal de edición
            cerrarModalEditarTienda();
            
            if (response.success) {
                mostrarModalNotificacion(
                    'success',
                    '¡Tienda Actualizada!',
                    response.message || 'Los cambios se guardaron correctamente. La página se recargará para mostrar las actualizaciones.',
                    true // recargar al cerrar
                );
            } else {
                mostrarModalNotificacion(
                    'error',
                    'Error al Actualizar',
                    response.message || 'No se pudieron guardar los cambios. Por favor, verifica los datos e intenta nuevamente.',
                    false
                );
            }
        },
        error: function(xhr, status, error) {
            cerrarModalEditarTienda();
            mostrarModalNotificacion(
                'error',
                'Error de Conexión',
                'No se pudo conectar con el servidor. Por favor, verifica tu conexión a internet e intenta nuevamente.',
                false
            );
        },
        complete: function() {
            document.getElementById('btnActualizar').disabled = false;
            document.getElementById('btnActualizar').innerHTML = '<i class="fa fa-save"></i> Guardar Cambios';
        }
    });
    
    return false;
}

// Cerrar modales al hacer clic fuera
window.onclick = function(event) {
    var modalNueva = document.getElementById('modalNuevaTienda');
    var modalEditar = document.getElementById('modalEditarTienda');
    if (event.target == modalNueva) {
        cerrarModalTienda();
    }
    if (event.target == modalEditar) {
        cerrarModalEditarTienda();
    }
}

// =====================================================
// FUNCIONES PARA COMPARTIR URL DE TIENDA
// =====================================================

// Generar la URL del catálogo de la tienda
function generarUrlCatalogoTienda(codTienda) {
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    return window.location.origin + basePath + 'catalogo_productos_tienda_movil.php?cod_tienda=' + encodeURIComponent(codTienda);
}

// Compartir por WhatsApp
function compartirTiendaWhatsApp(codTienda, nombreTienda) {
    var urlCatalogo = generarUrlCatalogoTienda(codTienda);
    
    var mensaje = '¡Hola! 👋\n\n' +
        '✨ Te comparto el catálogo de *' + nombreTienda + '*\n\n' +
        '🛒 Visita nuestra tienda y descubre todos nuestros productos:\n\n' +
        urlCatalogo + '\n\n' +
        '¡Te esperamos! 🎉';
    
    var urlWhatsApp = 'https://wa.me/?text=' + encodeURIComponent(mensaje);
    window.open(urlWhatsApp, '_blank');
}

// Compartir por Email
function compartirTiendaEmail(codTienda, nombreTienda) {
    var urlCatalogo = generarUrlCatalogoTienda(codTienda);
    
    var asunto = 'Te invito a conocer la tienda ' + nombreTienda;
    var cuerpo = 'Hola,\n\n' +
        'Quiero compartirte el catálogo de nuestra tienda: ' + nombreTienda + '\n\n' +
        'Puedes ver todos nuestros productos en el siguiente enlace:\n\n' +
        urlCatalogo + '\n\n' +
        '¡Te esperamos!\n\n' +
        'Saludos.';
    
    var mailtoLink = 'mailto:?subject=' + encodeURIComponent(asunto) + '&body=' + encodeURIComponent(cuerpo);
    window.location.href = mailtoLink;
}

// Copiar enlace al portapapeles
function copiarEnlaceTienda(codTienda, nombreTienda) {
    var urlCatalogo = generarUrlCatalogoTienda(codTienda);
    
    // Intentar usar la API moderna de Clipboard
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(urlCatalogo).then(function() {
            mostrarNotificacionCopiado(nombreTienda);
        }).catch(function() {
            copiarEnlaceFallback(urlCatalogo, nombreTienda);
        });
    } else {
        copiarEnlaceFallback(urlCatalogo, nombreTienda);
    }
}

// Fallback para navegadores que no soportan clipboard API
function copiarEnlaceFallback(texto, nombreTienda) {
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
            mostrarNotificacionCopiado(nombreTienda);
        } else {
            alert('No se pudo copiar el enlace. Por favor copia manualmente: ' + texto);
        }
    } catch (err) {
        alert('Error al copiar: ' + err);
    }
    document.body.removeChild(tempInput);
}

// Mostrar notificación de éxito al copiar (compatible sin SweetAlert)
function mostrarNotificacionCopiado(nombreTienda) {
    // Crear notificación flotante
    var notif = document.createElement('div');
    notif.innerHTML = '<i class="fa fa-check-circle"></i> ¡Enlace de "' + nombreTienda + '" copiado!';
    notif.style.cssText = 'position: fixed; bottom: 100px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%); color: white; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 20px rgba(0, 212, 255, 0.5); z-index: 10000; animation: slideUp 0.3s ease;';
    document.body.appendChild(notif);
    
    // Agregar animación temporal
    var styleSheet = document.createElement('style');
    styleSheet.textContent = '@keyframes slideUp { from { opacity: 0; transform: translateX(-50%) translateY(20px); } to { opacity: 1; transform: translateX(-50%) translateY(0); } }';
    document.head.appendChild(styleSheet);
    
    // Remover después de 2.5 segundos
    setTimeout(function() {
        notif.style.opacity = '0';
        notif.style.transform = 'translateX(-50%) translateY(20px)';
        notif.style.transition = 'all 0.3s ease';
        setTimeout(function() {
            notif.remove();
            styleSheet.remove();
        }, 300);
    }, 2500);
}
</script>

<!-- Modal para editar tienda -->
<div id="modalEditarTienda" class="modal-tienda">
    <div class="modal-tienda-content">
        <div class="modal-tienda-header">
            <h3><i class="fa fa-edit"></i> Editar Tienda</h3>
            <button class="modal-close" onclick="cerrarModalEditarTienda()">&times;</button>
        </div>
        <form id="formEditarTienda" onsubmit="return actualizarTienda(event)" enctype="multipart/form-data">
            <input type="hidden" id="edit_cod_tienda" name="cod_tienda">
            <div class="modal-tienda-body form-grid">
                <div id="alertEditSuccess" class="alert-success">
                    <i class="fa fa-check-circle"></i> <span id="alertEditSuccessText">Tienda actualizada exitosamente</span>
                </div>
                <div id="alertEditError" class="alert-error">
                    <i class="fa fa-exclamation-circle"></i> <span id="alertEditErrorText">Error al actualizar la tienda</span>
                </div>
                
                <!-- SECCIÓN: Información Básica -->
                <div class="form-section-title"><i class="fa fa-info-circle"></i> Información Básica</div>
                
                <div class="form-group-tienda">
                    <label for="edit_nombre_tienda"><i class="fa fa-building"></i> Nombre de la Tienda <span class="required-star">*</span></label>
                    <input type="text" id="edit_nombre_tienda" name="nombre_tienda" placeholder="Ej: Mi Tienda Principal" required>
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_identificacion_tercero"><i class="fa fa-id-card"></i> NIT de la Tienda</label>
                    <input type="text" id="edit_identificacion_tercero" name="identificacion_tercero" placeholder="Ej: 900123456-7">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_direccion_tienda"><i class="fa fa-map-marker"></i> Dirección</label>
                    <input type="text" id="edit_direccion_tienda" name="direccion_tienda" placeholder="Ej: Calle 123 #45-67">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_telefono_tienda"><i class="fa fa-phone"></i> Teléfono</label>
                    <input type="text" id="edit_telefono_tienda" name="telefono_tienda" placeholder="Ej: 3001234567">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_correo_tercero"><i class="fa fa-envelope"></i> Correo Electrónico</label>
                    <input type="email" id="edit_correo_tercero" name="correo_tercero" placeholder="Ej: tienda@ejemplo.com">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_cod_departamento"><i class="fa fa-map"></i> Departamento <span class="required-star">*</span></label>
                    <select id="edit_cod_departamento" name="cod_departamento" onchange="cargarMunicipiosEditarTienda()" required>
                        <option value="">Seleccione un departamento</option>
                    </select>
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_cod_municipio"><i class="fa fa-map-pin"></i> Municipio <span class="required-star">*</span></label>
                    <select id="edit_cod_municipio" name="cod_municipio" required>
                        <option value="">Seleccione primero un departamento</option>
                    </select>
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_ubicacion_gps_tienda"><i class="fa fa-map-marker-alt"></i> Ubicación GPS</label>
                    <div class="gps-input-wrapper">
                        <input type="text" id="edit_ubicacion_gps_tienda" name="ubicacion_gps_tienda" placeholder="Ej: 4.7110,-74.0721" readonly>
                        <button type="button" class="btn-gps" onclick="obtenerUbicacionGPS('edit_ubicacion_gps_tienda', 'gps_status_editar')"><i class="fa fa-crosshairs"></i> Obtener</button>
                    </div>
                    <div id="gps_status_editar" class="gps-status"></div>
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_imagen_tienda"><i class="fa fa-image"></i> Imagen / Logo (dejar vacío para mantener)</label>
                    <input type="file" id="edit_imagen_tienda" name="imagen_tienda" accept="image/*">
                    <img id="preview_img_tienda_edit" src="" class="preview-img-tienda" alt="Vista previa">
                </div>
                
                <!-- SECCIÓN: Documentación Legal -->
                <div class="form-section-title"><i class="fa fa-folder-open"></i> Documentación Legal</div>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-bottom: 1rem;">Dejar vacío para mantener los documentos actuales</p>
                
                <div class="form-group-tienda">
                    <label for="edit_rut_tienda"><i class="fa fa-file-pdf"></i> RUT de la Tienda</label>
                    <input type="file" id="edit_rut_tienda" name="url_documentacion_rut_tienda" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="edit_preview_rut_tienda" class="file-preview-container"></div>
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_camaracomercio_tienda"><i class="fa fa-file-pdf"></i> Cámara de Comercio</label>
                    <input type="file" id="edit_camaracomercio_tienda" name="url_documentacion_camaracomercio_tienda" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="edit_preview_camaracomercio_tienda" class="file-preview-container"></div>
                </div>
<!--
                <div class="form-group-tienda">
                    <label for="edit_contratofirma_tienda"><i class="fa fa-file-signature"></i> Contrato Firmado</label>
                    <input type="file" id="edit_contratofirma_tienda" name="url_documentacion_contratofirma_tienda" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="edit_preview_contratofirma_tienda" class="file-preview-container"></div>
                </div>
                -->
                <div class="form-group-tienda">
                    <label for="edit_extra1_tienda"><i class="fa fa-file-alt"></i> Documentación Extra (Opcional)</label>
                    <input type="file" id="edit_extra1_tienda" name="url_documentacion_extra1_tienda" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="edit_preview_extra1_tienda" class="file-preview-container"></div>
                </div>
                
                <!-- SECCIÓN: Imágenes del Establecimiento -->
                <div class="form-section-title"><i class="fa fa-camera"></i> Imágenes del Establecimiento</div>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-bottom: 1rem;">Dejar vacío para mantener las imágenes actuales</p>
                
                <div class="form-group-tienda">
                    <label for="edit_img_fachada_tienda"><i class="fa fa-store-alt"></i> Imagen de la Fachada</label>
                    <input type="file" id="edit_img_fachada_tienda" name="url_img_fachada_tienda" accept="image/*">
                    <img id="edit_preview_img_fachada" src="" class="preview-img-tienda" alt="Vista previa fachada">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_img_interna_tienda"><i class="fa fa-door-open"></i> Imagen Interna de la Tienda</label>
                    <input type="file" id="edit_img_interna_tienda" name="url_img_interna_tienda" accept="image/*">
                    <img id="edit_preview_img_interna" src="" class="preview-img-tienda" alt="Vista previa interna">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_img_selfieadmin_tienda"><i class="fa fa-user-circle"></i> Selfie del Administrador en la Tienda</label>
                    <input type="file" id="edit_img_selfieadmin_tienda" name="url_img_selfieadmin_tienda" accept="image/*">
                    <img id="edit_preview_img_selfieadmin" src="" class="preview-img-tienda" alt="Vista previa selfie">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_img_otraopcional_tienda"><i class="fa fa-image"></i> Otra Imagen (Opcional)</label>
                    <input type="file" id="edit_img_otraopcional_tienda" name="url_img_otraopcional_tienda" accept="image/*">
                    <img id="edit_preview_img_otraopcional" src="" class="preview-img-tienda" alt="Vista previa opcional">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_cod_estado"><i class="fa fa-toggle-on"></i> Estado</label>
                    <select id="edit_cod_estado" name="cod_estado">
                        <option value="1">Activa</option>
                        <option value="0">Inactiva</option>
                    </select>
                </div>
            </div>
            <div class="modal-tienda-footer">
                <button type="button" class="btn-modal btn-modal-secondary" onclick="cerrarModalEditarTienda()">Cancelar</button>
                <button type="submit" class="btn-modal btn-modal-primary" id="btnActualizar">
                    <i class="fa fa-save"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Notificación -->
<div id="modalNotificacion" class="modal-notificacion">
    <div class="modal-notificacion-content">
        <div class="modal-notificacion-header">
            <div id="notifIcon" class="modal-notificacion-icon">
                <i id="notifIconSymbol" class="fa fa-check-circle"></i>
            </div>
        </div>
        <div class="modal-notificacion-body">
            <h3 id="notifTitle" class="modal-notificacion-title">¡Éxito!</h3>
            <p id="notifMessage" class="modal-notificacion-message">Operación completada correctamente</p>
        </div>
        <div class="modal-notificacion-footer">
            <button id="notifButton" class="btn-notificacion success" onclick="cerrarModalNotificacion()">Aceptar</button>
        </div>
    </div>
</div>

</body>
</html>
