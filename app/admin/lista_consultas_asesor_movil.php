<?php 
$nombre_pagina          = "Consultas y Recursos";
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
<meta name="description" content="<?php echo $nombre_pagina ?>">
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />

<style>
/* ============================================ */
/* CONSULTAS ASESOR - TEMA VERDE ESMERALDA */
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
    max-width: 1200px;
    margin: 0 auto;
}

/* Header */
.page-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3);
    text-align: center;
}

.page-header h1 {
    color: white;
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.page-header p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.9rem;
}

/* Cards Grid */
.consultas-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

@media (min-width: 600px) {
    .consultas-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.consulta-card {
    background: linear-gradient(145deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95));
    border-radius: 16px;
    padding: 1.25rem;
    border: 1px solid rgba(16, 185, 129, 0.2);
    position: relative;
    overflow: hidden;
}

.consulta-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #10b981, #059669);
}

.consulta-badge {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 0.5rem 0.85rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.consulta-badge i {
    font-size: 0.85rem;
}

.logos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
    gap: 0.5rem;
}

.logo-item {
    background: rgba(255, 255, 255, 0.05);
    padding: 0.5rem;
    border-radius: 10px;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(16, 185, 129, 0.1);
}

.logo-item:hover {
    background: rgba(16, 185, 129, 0.1);
    border-color: rgba(16, 185, 129, 0.3);
    transform: scale(1.05);
}

.logo-item a {
    display: block;
}

.logo-item img {
    max-width: 100%;
    height: auto;
    max-height: 40px;
    object-fit: contain;
    filter: brightness(1.1);
}

.logo-item span {
    display: block;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.65rem;
    margin-top: 0.25rem;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}

/* Videos Section */
.videos-section {
    background: linear-gradient(145deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95));
    border-radius: 16px;
    padding: 1.25rem;
    border: 1px solid rgba(16, 185, 129, 0.2);
    margin-bottom: 1.5rem;
}

.videos-header {
    text-align: center;
    margin-bottom: 1.25rem;
}

.videos-header h3 {
    color: white;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 0.35rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.videos-header h3 i {
    color: #10b981;
}

.videos-header p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.8rem;
    margin-bottom: 1rem;
}

.btn-agregar-video {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    padding: 0.6rem 1.25rem;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-agregar-video:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.videos-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.85rem;
}

@media (max-width: 450px) {
    .videos-grid {
        grid-template-columns: 1fr;
    }
}

.video-card {
    background: rgba(255, 255, 255, 0.03);
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid rgba(16, 185, 129, 0.1);
}

.video-card:hover {
    transform: translateY(-3px);
    border-color: #10b981;
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.2);
}

.video-thumbnail {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    overflow: hidden;
    background: rgba(0,0,0,0.3);
}

.video-thumbnail img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.video-card:hover .video-thumbnail img {
    transform: scale(1.05);
}

.play-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.play-overlay i {
    font-size: 2.5rem;
    color: rgba(255, 255, 255, 0.9);
    transition: all 0.3s ease;
}

.video-card:hover .play-overlay {
    background: rgba(16, 185, 129, 0.3);
}

.video-card:hover .play-overlay i {
    transform: scale(1.2);
    color: #10b981;
}

.video-info {
    padding: 0.75rem;
}

.video-info h4 {
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
    margin: 0 0 0.25rem 0;
    line-height: 1.3;
}

.video-info p {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.7rem;
    margin: 0;
    line-height: 1.4;
}

.no-videos {
    grid-column: 1 / -1;
    text-align: center;
    padding: 2rem;
    color: rgba(255, 255, 255, 0.5);
}

.no-videos i {
    font-size: 2.5rem;
    margin-bottom: 0.75rem;
    display: block;
}

/* Modal */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    overflow-y: auto;
}

.modal-overlay.show {
    display: flex;
}

.modal-content {
    background: linear-gradient(145deg, #1e293b, #0f172a);
    border-radius: 20px;
    width: 100%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    border: 1px solid rgba(16, 185, 129, 0.3);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from { transform: translateY(30px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.modal-header {
    padding: 1.25rem;
    border-bottom: 1px solid rgba(16, 185, 129, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    color: white;
    font-size: 1.1rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modal-header h2 i {
    color: #10b981;
}

.modal-close {
    background: rgba(239, 68, 68, 0.2);
    border: none;
    color: #ef4444;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    background: #ef4444;
    color: white;
}

.modal-body {
    padding: 1.25rem;
}

/* Video Container in Modal */
.video-container {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
}

.video-container iframe,
.video-container video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

/* Form Styles for Add Video */
.video-tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.25rem;
    background: rgba(0, 0, 0, 0.2);
    padding: 0.35rem;
    border-radius: 12px;
}

.video-tab {
    flex: 1;
    padding: 0.7rem;
    background: transparent;
    border: none;
    border-radius: 10px;
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
}

.video-tab:hover {
    color: white;
    background: rgba(255, 255, 255, 0.1);
}

.video-tab.active {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    color: #10b981;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 0.4rem;
}

.form-group label i {
    margin-right: 0.3rem;
}

.form-input, .form-textarea {
    width: 100%;
    padding: 0.8rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 10px;
    color: white;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.form-input:focus, .form-textarea:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
}

.form-input::placeholder, .form-textarea::placeholder {
    color: rgba(255, 255, 255, 0.3);
}

.form-hint {
    display: block;
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.7rem;
    margin-top: 0.3rem;
}

.video-section { display: none; }
.video-section.active { display: block; }

.file-upload-box {
    border: 2px dashed rgba(16, 185, 129, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: rgba(0, 0, 0, 0.2);
}

.file-upload-box:hover {
    border-color: #10b981;
    background: rgba(16, 185, 129, 0.05);
}

.file-upload-box i {
    font-size: 2rem;
    color: #10b981;
    margin-bottom: 0.5rem;
    display: block;
}

.file-upload-box p {
    color: white;
    font-weight: 600;
    margin: 0 0 0.25rem 0;
    font-size: 0.9rem;
}

.file-upload-box small {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.7rem;
}

.file-selected {
    display: none;
    align-items: center;
    gap: 0.75rem;
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 10px;
    padding: 0.75rem 1rem;
}

.file-selected.show {
    display: flex;
}

.file-selected i {
    font-size: 1.5rem;
    color: #10b981;
}

.file-selected span {
    flex: 1;
    color: white;
    font-size: 0.85rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.file-selected button {
    background: rgba(239, 68, 68, 0.2);
    border: none;
    color: #ef4444;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    cursor: pointer;
}

.preview-container {
    margin-top: 1rem;
    border-radius: 10px;
    overflow: hidden;
    display: none;
}

.preview-container.show {
    display: block;
}

.preview-container img {
    width: 100%;
    height: auto;
    display: block;
}

.btn-group {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.25rem;
}

.btn-primary, .btn-secondary {
    flex: 1;
    padding: 0.85rem 1rem;
    border: none;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-primary {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.btn-primary:disabled {
    background: rgba(255, 255, 255, 0.2);
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
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

/* Toast Notifications */
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 99999;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.toast-notification {
    min-width: 280px;
    max-width: 350px;
    padding: 14px 18px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    animation: toastSlideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    position: relative;
}

.toast-notification.toast-exit {
    animation: toastSlideOut 0.3s ease-in forwards;
}

@keyframes toastSlideIn {
    from { transform: translateX(120%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes toastSlideOut {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(120%); opacity: 0; }
}

.toast-notification.success {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.95), rgba(5, 150, 105, 0.95));
    border-left: 4px solid #34d399;
}

.toast-notification.error {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.95), rgba(185, 28, 28, 0.95));
    border-left: 4px solid #f87171;
}

.toast-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.2);
}

.toast-icon i {
    font-size: 1rem;
    color: white;
}

.toast-content {
    flex: 1;
}

.toast-title {
    color: white;
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 2px;
}

.toast-message {
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.8rem;
}

.toast-close {
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.7);
    cursor: pointer;
    padding: 4px;
    border-radius: 50%;
}

.toast-close:hover {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.toast-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    background: rgba(255, 255, 255, 0.4);
    border-radius: 0 0 0 12px;
    animation: toastProgress 4s linear forwards;
}

@keyframes toastProgress {
    from { width: 100%; }
    to { width: 0%; }
}

@media (max-width: 480px) {
    .toast-container {
        left: 10px;
        right: 10px;
        top: 10px;
    }
    .toast-notification {
        min-width: auto;
        max-width: none;
    }
}

/* Animations */
.animate-in {
    animation: fadeSlideIn 0.4s ease-out forwards;
    opacity: 0;
}

@keyframes fadeSlideIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Obtener entidades crediticias
$sql_entidades = "SELECT * FROM tbl15_entidad_crediticia WHERE cod_estado = '1' ORDER BY cod_posicion ASC";
$resultado_entidades = mysqli_query($conectar, $sql_entidades);

// Obtener videos tutoriales
$sql_videos = "SELECT * FROM tbl15_videotutorial WHERE cod_estado = '1' ORDER BY fecha_reg_time DESC";
$resultado_videos = mysqli_query($conectar, $sql_videos);
$total_videos = ($resultado_videos) ? mysqli_num_rows($resultado_videos) : 0;
?>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-compass"></i> Consultas y Recursos</h1>
        <p>Accede a herramientas y tutoriales</p>
    </div>

    <!-- Consultas Grid -->
    <div class="consultas-grid">
        <!-- Tarjeta 1: Consulta de Cupo -->
        <div class="consulta-card animate-in delay-1">
            <div class="consulta-badge"><i class="fa-solid fa-star"></i> Consulta de Cupo</div>
            <div class="logos-grid">
                <?php 
                mysqli_data_seek($resultado_entidades, 0);
                while ($entidad = mysqli_fetch_assoc($resultado_entidades)): 
                    $url_cupo = isset($entidad['url_pagina_web_consultar_cupo']) ? $entidad['url_pagina_web_consultar_cupo'] : '#';
                ?>
                <div class="logo-item">
                    <a href="<?php echo $url_cupo; ?>" target="_blank">
                        <img src="<?php echo $entidad['url_entidad_crediticia_imag_orig']; ?>" alt="<?php echo $entidad['nombre_entidad_crediticia']; ?>">
                        <span><?php echo $entidad['nombre_entidad_crediticia']; ?></span>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Tarjeta 2: Valor a Pagar -->
        <div class="consulta-card animate-in delay-2">
            <div class="consulta-badge"><i class="fa-solid fa-money-bill-wave"></i> Valor a Pagar</div>
            <div class="logos-grid">
                <?php 
                mysqli_data_seek($resultado_entidades, 0);
                while ($entidad = mysqli_fetch_assoc($resultado_entidades)): 
                    $url_pago = isset($entidad['url_pagina_web_valor_pagar']) ? $entidad['url_pagina_web_valor_pagar'] : '#';
                ?>
                <div class="logo-item">
                    <a href="<?php echo $url_pago; ?>" target="_blank">
                        <img src="<?php echo $entidad['url_entidad_crediticia_imag_orig']; ?>" alt="<?php echo $entidad['nombre_entidad_crediticia']; ?>">
                        <span><?php echo $entidad['nombre_entidad_crediticia']; ?></span>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <!-- Sección de Videos -->
    <div class="videos-section animate-in delay-2">
        <div class="videos-header">
            <h3><i class="fa-solid fa-play-circle"></i> Video Tutoriales</h3>
            <p>Aprende a usar nuestra plataforma</p>
            <button type="button" class="btn-agregar-video" onclick="abrirModalAgregarVideo()">
                <i class="fa-solid fa-plus"></i> Agregar Video
            </button>
        </div>

        <div class="videos-grid">
            <?php if ($total_videos > 0): ?>
                <?php while ($video = mysqli_fetch_assoc($resultado_videos)): 
                    $url_video = $video['url_videotutorial'];
                    $es_local = (strpos($url_video, '../') === 0 || strpos($url_video, './') === 0 || strpos($url_video, 'archivador/') !== false);
                    $youtube_id = '';
                    
                    if (!$es_local && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url_video, $match)) {
                        $youtube_id = $match[1];
                    }
                    
                    if (!empty($youtube_id)) {
                        $thumbnail = "https://img.youtube.com/vi/{$youtube_id}/hqdefault.jpg";
                        $tipo_video = 'youtube';
                    } else {
                        $thumbnail = "../imagenes/iconos/video_local_thumb.png";
                        $tipo_video = 'local';
                    }
                ?>
                <div class="video-card" onclick="abrirModalVideo('<?php echo $url_video; ?>', '<?php echo addslashes($video['nombre_videotutorial']); ?>', '<?php echo $tipo_video; ?>')">
                    <div class="video-thumbnail">
                        <img src="<?php echo $thumbnail; ?>" alt="<?php echo $video['nombre_videotutorial']; ?>">
                        <div class="play-overlay"><i class="fa-solid fa-play-circle"></i></div>
                    </div>
                    <div class="video-info">
                        <h4><?php echo $video['nombre_videotutorial']; ?></h4>
                        <?php if (!empty($video['descripcion_videotutorial'])): ?>
                        <p><?php echo substr($video['descripcion_videotutorial'], 0, 60); ?><?php echo strlen($video['descripcion_videotutorial']) > 60 ? '...' : ''; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-videos">
                    <i class="fa-solid fa-video-slash"></i>
                    <p>No hay videos disponibles</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- Modal Ver Video -->
<div class="modal-overlay" id="modalVideo">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-play"></i> <span id="modalVideoTitulo">Video Tutorial</span></h2>
            <button class="modal-close" onclick="cerrarModalVideo()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body" style="padding: 0;">
            <div class="video-container" id="videoContainer"></div>
        </div>
    </div>
</div>

<!-- Modal Agregar Video -->
<div class="modal-overlay" id="modalAgregarVideo">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa-solid fa-plus-circle"></i> Agregar Video</h2>
            <button class="modal-close" onclick="cerrarModalAgregarVideo()"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="modal-body">
            <!-- Tabs -->
            <div class="video-tabs">
                <button type="button" class="video-tab active" id="tabYoutube" onclick="cambiarTab('youtube')"><i class="fa-brands fa-youtube"></i> YouTube</button>
                <button type="button" class="video-tab" id="tabArchivo" onclick="cambiarTab('archivo')"><i class="fa-solid fa-upload"></i> Subir</button>
            </div>

            <form id="formAgregarVideo" enctype="multipart/form-data">
                <input type="hidden" id="tipo_video" name="tipo_video" value="youtube">

                <div class="form-group">
                    <label><i class="fa-solid fa-tag"></i> Nombre del Video *</label>
                    <input type="text" class="form-input" id="nombre_videotutorial" name="nombre_videotutorial" placeholder="Ej: Cómo simular un crédito" required>
                </div>

                <!-- Sección YouTube -->
                <div class="video-section active" id="seccionYoutube">
                    <div class="form-group">
                        <label><i class="fa-solid fa-link"></i> URL de YouTube *</label>
                        <input type="url" class="form-input" id="url_videotutorial" name="url_videotutorial" placeholder="https://www.youtube.com/watch?v=XXXX">
                        <span class="form-hint">Pega el enlace del video de YouTube</span>
                    </div>
                    <div class="preview-container" id="previewContainer">
                        <img id="previewImg" src="" alt="Vista previa">
                    </div>
                </div>

                <!-- Sección Subir Archivo -->
                <div class="video-section" id="seccionArchivo">
                    <div class="form-group">
                        <label><i class="fa-solid fa-file-video"></i> Seleccionar Video *</label>
                        <input type="file" id="archivo_video" name="archivo_video" accept="video/mp4,video/webm,video/ogg" style="display: none;">
                        <div class="file-upload-box" id="fileUploadBox" onclick="document.getElementById('archivo_video').click();">
                            <i class="fa-solid fa-cloud-upload-alt"></i>
                            <p>Haz clic para seleccionar</p>
                            <small>Formatos: MP4, WebM, OGG (Máx: 100MB)</small>
                        </div>
                        <div class="file-selected" id="fileSelected">
                            <i class="fa-solid fa-file-video"></i>
                            <span id="fileName"></span>
                            <button type="button" onclick="removerArchivo()"><i class="fa-solid fa-times"></i></button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-image"></i> Miniatura (Opcional)</label>
                        <input type="file" class="form-input" id="miniatura_video" name="miniatura_video" accept="image/jpeg,image/png,image/webp" style="padding: 0.5rem;">
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-align-left"></i> Descripción (Opcional)</label>
                    <textarea class="form-textarea" id="descripcion_videotutorial" name="descripcion_videotutorial" rows="3" placeholder="Breve descripción del video..."></textarea>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn-secondary" onclick="cerrarModalAgregarVideo()"><i class="fa-solid fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn-primary" id="btnGuardarVideo"><i class="fa-solid fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// ===================== FUNCIONES DE VIDEO =====================
function abrirModalVideo(url, titulo, tipo) {
    document.getElementById('modalVideoTitulo').textContent = titulo;
    var container = document.getElementById('videoContainer');
    var html = '';

    if (tipo === 'local') {
        html = '<video controls autoplay playsinline controlsList="nodownload">' +
               '<source src="' + url + '" type="video/mp4">' +
               'Tu navegador no soporta la reproducción de video.</video>';
    } else {
        var youtubeMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
        var embedUrl = youtubeMatch ? 'https://www.youtube.com/embed/' + youtubeMatch[1] + '?autoplay=1&rel=0' : url;
        html = '<iframe src="' + embedUrl + '" allowfullscreen allow="autoplay; encrypted-media"></iframe>';
    }

    container.innerHTML = html;
    document.getElementById('modalVideo').classList.add('show');
}

function cerrarModalVideo() {
    document.getElementById('videoContainer').innerHTML = '';
    document.getElementById('modalVideo').classList.remove('show');
}

// ===================== FUNCIONES AGREGAR VIDEO =====================
function abrirModalAgregarVideo() {
    document.getElementById('formAgregarVideo').reset();
    document.getElementById('previewContainer').classList.remove('show');
    removerArchivo();
    cambiarTab('youtube');
    document.getElementById('modalAgregarVideo').classList.add('show');
}

function cerrarModalAgregarVideo() {
    document.getElementById('modalAgregarVideo').classList.remove('show');
}

function cambiarTab(tipo) {
    document.getElementById('tipo_video').value = tipo;
    document.getElementById('tabYoutube').classList.toggle('active', tipo === 'youtube');
    document.getElementById('tabArchivo').classList.toggle('active', tipo === 'archivo');
    document.getElementById('seccionYoutube').classList.toggle('active', tipo === 'youtube');
    document.getElementById('seccionArchivo').classList.toggle('active', tipo === 'archivo');

    if (tipo === 'youtube') {
        document.getElementById('archivo_video').value = '';
        removerArchivo();
    } else {
        document.getElementById('url_videotutorial').value = '';
        document.getElementById('previewContainer').classList.remove('show');
    }
}

// Vista previa de YouTube
document.getElementById('url_videotutorial').addEventListener('input', function(e) {
    var url = e.target.value;
    var youtubeMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
    
    if (youtubeMatch) {
        document.getElementById('previewImg').src = 'https://img.youtube.com/vi/' + youtubeMatch[1] + '/hqdefault.jpg';
        document.getElementById('previewContainer').classList.add('show');
    } else {
        document.getElementById('previewContainer').classList.remove('show');
    }
});

// Manejo de archivo
document.getElementById('archivo_video').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        if (file.size > 100 * 1024 * 1024) {
            mostrarNotificacion('error', 'Archivo muy grande', 'El máximo es 100MB');
            e.target.value = '';
            return;
        }
        document.getElementById('fileUploadBox').style.display = 'none';
        document.getElementById('fileSelected').classList.add('show');
        document.getElementById('fileName').textContent = file.name;
    }
});

function removerArchivo() {
    document.getElementById('archivo_video').value = '';
    document.getElementById('fileUploadBox').style.display = 'block';
    document.getElementById('fileSelected').classList.remove('show');
}

// Enviar formulario
document.getElementById('formAgregarVideo').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var tipo = document.getElementById('tipo_video').value;
    
    if (tipo === 'youtube') {
        if (!document.getElementById('url_videotutorial').value) {
            mostrarNotificacion('error', 'Error', 'Ingresa la URL de YouTube');
            return;
        }
    } else {
        if (!document.getElementById('archivo_video').files[0]) {
            mostrarNotificacion('error', 'Error', 'Selecciona un archivo');
            return;
        }
    }

    var btn = document.getElementById('btnGuardarVideo');
    var originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';

    var formData = new FormData(this);

    $.ajax({
        url: 'registrar_video_tutorial_ajax.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                mostrarNotificacion('success', '¡Éxito!', 'Video registrado correctamente');
                cerrarModalAgregarVideo();
                setTimeout(function() { location.reload(); }, 1500);
            } else {
                mostrarNotificacion('error', 'Error', response.message);
            }
        },
        error: function() {
            mostrarNotificacion('error', 'Error', 'No se pudo conectar con el servidor');
        },
        complete: function() {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    });
});

// ===================== NOTIFICACIONES TOAST =====================
function mostrarNotificacion(tipo, titulo, mensaje) {
    var container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    var iconos = { 'success': 'fa-check', 'error': 'fa-times' };

    var toast = document.createElement('div');
    toast.className = 'toast-notification ' + tipo;
    toast.innerHTML = '<div class="toast-icon"><i class="fa-solid ' + iconos[tipo] + '"></i></div>' +
        '<div class="toast-content"><div class="toast-title">' + titulo + '</div><div class="toast-message">' + mensaje + '</div></div>' +
        '<button class="toast-close" onclick="cerrarNotificacion(this)"><i class="fa-solid fa-times"></i></button>' +
        '<div class="toast-progress"></div>';
    container.appendChild(toast);

    setTimeout(function() { cerrarNotificacion(toast.querySelector('.toast-close')); }, 4000);
}

function cerrarNotificacion(btn) {
    var toast = btn.closest('.toast-notification');
    if (toast) {
        toast.classList.add('toast-exit');
        setTimeout(function() { toast.remove(); }, 300);
    }
}

// Cerrar modales al hacer clic fuera
document.getElementById('modalVideo').addEventListener('click', function(e) { if (e.target === this) cerrarModalVideo(); });
document.getElementById('modalAgregarVideo').addEventListener('click', function(e) { if (e.target === this) cerrarModalAgregarVideo(); });
</script>

</body>
</html>
