<?php
// Evitar errores si no hay sesión iniciada
if (isset($nombres_usuario)) {
    // Obtener iniciales del usuario
    $primer_nombre = explode(' ', trim($nombres_usuario))[0];
    $iniciales_top = '';
    if (!empty($nombres_usuario)) { $iniciales_top = strtoupper(substr($nombres_usuario, 0, 1)); }
    if (!empty($apellidos_usuario)) { $iniciales_top .= strtoupper(substr($apellidos_usuario, 0, 1)); }
    if (empty($iniciales_top)) { $iniciales_top = 'US'; }

    // Color principal según el módulo
    $color_top_header = '#8b5cf6'; // Violeta (Líder / Genérico)
    $pagina_ref = stripos($_SERVER['PHP_SELF'], 'vendedor') !== false ? 'vendedor' : 
    (stripos($_SERVER['PHP_SELF'], 'asesor') !== false ? 'asesor' : 
    (stripos($_SERVER['PHP_SELF'], 'coordinador') !== false ? 'coordinador' : 
    (stripos($_SERVER['PHP_SELF'], 'aliado') !== false ? 'aliado' : 'lider')));

    switch($pagina_ref) {
        case 'vendedor': $color_top_header = '#f59e0b'; break; // Naranja
        case 'asesor': $color_top_header = '#10b981'; break; // Verde
        case 'coordinador': $color_top_header = '#3b82f6'; break; // Azul
        case 'aliado': $color_top_header = '#ec4899'; break; // Rosa
        default: $color_top_header = '#8b5cf6'; break;
    }
    $es_placeholder = stripos($url_img_foto_prof_min_usuario, 'perfil-avatar') !== false || empty($url_img_foto_prof_min_usuario);
?>

<div class="user-pill-floating">
    <div class="user-pill-content">
        <div class="user-pill-avatar" style="background: <?php echo $color_top_header; ?>;"><?php if (!$es_placeholder): ?><img src="<?php echo $url_img_foto_prof_min_usuario; ?>" alt="U"><?php else: ?><span><?php echo $iniciales_top; ?></span><?php endif; ?></div>
        <div class="user-pill-info"><span class="pill-welcome">Hola,</span><span class="pill-name"><?php echo ucwords(strtolower($primer_nombre)); ?></span></div>
    </div>
</div>

<style>
.user-pill-floating {
    position: fixed;
    top: 12px;
    left: 12px;
    right: auto;
    z-index: 10001; /* Asegurar que esté sobre todo */
    pointer-events: none; /* Dejar pasar clics si es necesario, pero el contenido los recupera */
}

.user-pill-content {
    background: rgba(15, 20, 25, 0.4);
    backdrop-filter: blur(12px) saturate(180%);
    -webkit-backdrop-filter: blur(12px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 40px;
    padding: 4px 12px 4px 4px;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    pointer-events: auto;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.user-pill-content:active {
    transform: scale(0.95);
    background: rgba(15, 20, 25, 0.6);
}

.user-pill-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Alineado a la izquierda */
}

.pill-welcome {
    font-size: 0.55rem;
    color: rgba(255, 255, 255, 0.5);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1;
}

.pill-name {
    font-size: 0.8rem;
    font-weight: 700;
    color: white;
    line-height: 1.2;
}

.user-pill-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(255, 255, 255, 0.2);
    overflow: hidden;
    color: white;
    font-weight: 800;
    font-size: 0.7rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.user-pill-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Evitar que oculte contenido bajo el sticky */
/* Ajuste de márgenes para que los títulos respiren */
@media (max-width: 500px) {
    .dashboard-header h1, .page-header h1 {
        padding-right: 80px; /* Dejar espacio para la burbuja */
    }
}
</style>
<?php } ?>
