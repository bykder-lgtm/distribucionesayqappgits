<?php 
$nombre_pagina          = "Consultas";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>

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
<meta property="og:url"                content="<?php echo $pagina_local ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_pagina ?>" />
<meta property="og:description"        content="<?php echo $nombre_pagina ?>" />
<meta property="og:image"              content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="editaxe"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<meta name="twitter:description"       content="<?php echo $descripcion_producto ?>">
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<link rel="stylesheet" href="../estilo_css/modal_solicitud_credito.css">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** INICIAR AQUI ******************************************** -->  

<style>
    .entidades-grid-simulador {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding: 1rem;
    }
    .entidad-card-simulador {
        background: white;
        border-radius: 12px;
        padding: 0.75rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .entidad-card-simulador::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .entidad-card-simulador:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }
    .entidad-logo-simulador {
        text-align: center;
        margin-bottom: 0.5rem;
        padding: 0.5rem;
        background: #f7fafc;
        border-radius: 8px;
    }
    .entidad-logo-simulador i {
        font-size: 2.5rem;
        color: #667eea;
    }
    .entidad-logo-simulador img {
        max-width: 100%;
        height: auto;
        max-height: 50px;
        object-fit: contain;
    }
    .logos-entidades-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }
    .logo-entidad-item {
        background: #f7fafc;
        padding: 0.4rem;
        border-radius: 8px;
        text-align: center;
        transition: all 0.3s ease;
    }
    .logo-entidad-item:hover {
        background: #e2e8f0;
        transform: scale(1.05);
    }
    .logo-entidad-item img {
        max-width: 100%;
        height: auto;
        max-height: 40px;
        object-fit: contain;
    }
    .descuento-badge-simulador {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
        padding: 0.5rem 0.85rem;
        border-radius: 20px;
        font-size: 0.95rem;
        font-weight: 800;
        display: inline-block;
        margin-bottom: 0.75rem;
        box-shadow: 0 4px 12px rgba(72, 187, 120, 0.4);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        animation: pulseGlow 2s ease-in-out infinite;
    }
    @keyframes pulseGlow {
        0%, 100% {
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.4);
        }
        50% {
            box-shadow: 0 6px 20px rgba(72, 187, 120, 0.6);
        }
    }
    .descuento-badge-simulador i {
        margin-right: 0.35rem;
        font-size: 0.9rem;
    }
    .valor-credito-simulador {
        font-size: 1rem;
        font-weight: 800;
        color: #667eea;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    .cuotas-selector-simulador {
        background: #f7fafc;
        padding: 0.5rem;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }
    .cuotas-selector-simulador label {
        display: block;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.35rem;
        font-size: 0.7rem;
    }
    .cuotas-selector-simulador .info-texto {
        width: 100%;
        padding: 0.5rem;
        border: 2px solid #e2e8f0;
        border-radius: 6px;
        font-size: 0.85rem;
        background: white;
        color: #2d3748;
        font-weight: 600;
    }
    .cuota-resultado-simulador {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        padding: 0.5rem;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 0.5rem;
    }
    .cuota-resultado-simulador .label {
        font-size: 0.65rem;
        color: #4a5568;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 0.15rem;
    }
    .cuota-resultado-simulador .valor {
        font-size: 1.1rem;
        font-weight: 800;
        color: #667eea;
    }
    .btn-solicitar-simulador {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.65rem 0.5rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.75rem;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(102, 126, 234, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        margin-top: auto;
    }
    .btn-solicitar-simulador:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.5);
    }
    .btn-solicitar-simulador i {
        font-size: 0.7rem;
    }
    .entidad-nombre {
        font-size: 0.8rem;
        font-weight: 700;
        color: #2d3748;
        text-align: center;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }
    .entidad-botones {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0.35rem;
        margin-top: auto;
        justify-content: center;
    }
    .btn-entidad {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        padding: 0.5rem 0.5rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        text-decoration: none;
        color: white;
        transition: all 0.25s ease;
        text-align: center;
        border: none;
        cursor: pointer;
    }
    .btn-entidad:hover {
        transform: translateY(-1px);
        text-decoration: none;
        color: white;
    }
    .btn-entidad i {
        font-size: 0.7rem;
    }
    .btn-consultar-cupo {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        box-shadow: 0 2px 8px rgba(72, 187, 120, 0.3);
    }
    .btn-consultar-cupo:hover {
        box-shadow: 0 4px 12px rgba(72, 187, 120, 0.5);
    }
    .btn-valor-pagar {
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
        box-shadow: 0 2px 8px rgba(237, 137, 54, 0.3);
    }
    .btn-valor-pagar:hover {
        box-shadow: 0 4px 12px rgba(237, 137, 54, 0.5);
    }
    .btn-plataforma {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }
    .btn-plataforma:hover {
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.5);
    }
    @media (max-width: 992px) {
        .entidades-grid-simulador {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 576px) {
        .entidades-grid-simulador {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }
        .entidad-card-simulador {
            padding: 0.6rem;
        }
    }
</style>

<main class="container pb-5 mb-5">
    <div class="entidades-grid-simulador">
        <?php
        $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_estado = '1') ORDER BY cod_posicion ASC";
        $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
        while ($datos_entidad = mysqli_fetch_assoc($consulta_entidad_crediticia)) {

            $cod_entidad_crediticia                                    = $datos_entidad['cod_entidad_crediticia'];
            $nombre_entidad_crediticia                                 = $datos_entidad['nombre_entidad_crediticia'];
            $url_entidad_crediticia_imag_orig                          = $datos_entidad['url_entidad_crediticia_imag_orig'];
            $url_pagina_web_consultar_cupo                             = $datos_entidad['url_pagina_web_consultar_cupo'];
            $url_pagina_web_valor_pagar                                = $datos_entidad['url_pagina_web_valor_pagar'];
            $url_pagina_web_consulta                                   = $datos_entidad['url_pagina_web_consulta'];
            $cod_estado_consulta_cupo_modal_enviar_whatsapp            = $datos_entidad['cod_estado_consulta_cupo_modal_enviar_whatsapp'];
            $texto_mensaje_para_url_vacia_entidad_crediticia           = $datos_entidad['texto_mensaje_para_url_vacia_entidad_crediticia'];
        ?>
        <div class="entidad-card-simulador">
            <div class="entidad-logo-simulador">
                <img src="<?php echo $url_entidad_crediticia_imag_orig; ?>" alt="<?php echo $nombre_entidad_crediticia; ?>" title="<?php echo $nombre_entidad_crediticia; ?>">
            </div>
            <div class="entidad-nombre"><?php echo $nombre_entidad_crediticia; ?></div>
            <div class="entidad-botones">
                <?php if (!empty($url_pagina_web_consultar_cupo)) { ?>
                <a href="<?php echo $url_pagina_web_consultar_cupo; ?>" target="_blank" class="btn-entidad btn-consultar-cupo"><i class="fa fa-search"></i> Consultar cupo</a>
                <?php } elseif ($cod_estado_consulta_cupo_modal_enviar_whatsapp == '1') { ?>
                <button type="button" class="btn-entidad btn-consultar-cupo" onclick="abrirModalWhatsapp('<?php echo $cod_entidad_crediticia; ?>', '<?php echo addslashes($nombre_entidad_crediticia); ?>', '<?php echo addslashes($texto_mensaje_para_url_vacia_entidad_crediticia); ?>')"><i class="fa fa-search"></i> Consultar cupo</button>
                <?php } ?>
                <a href="<?php echo $url_pagina_web_valor_pagar; ?>" target="_blank" class="btn-entidad btn-valor-pagar"><i class="fa fa-money-bill-wave"></i> Valor a pagar</a>
                <a href="<?php echo $url_pagina_web_consulta; ?>" target="_blank" class="btn-entidad btn-plataforma"><i class="fa fa-globe"></i> Plataforma</a>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- Modal WhatsApp Consulta de Cupo -->
    <div class="modal fade" id="modalWhatsappConsulta" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: 1px solid rgba(37, 211, 102, 0.3);">
                <div class="modal-header" style="border-bottom: 1px solid rgba(37, 211, 102, 0.2); padding: 1rem 1.25rem;">
                    <h5 class="modal-title" style="font-weight: 700; font-size: 1rem;"><i class="fa fa-whatsapp" style="color: #25d366; margin-right: 8px;"></i> Consultar Cupo - <span id="modalWhatsappEntidadNombre"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" style="color: white; opacity: 0.8; font-size: 1.5rem;"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="padding: 1.25rem;">
                    <div id="modalWhatsappMensaje" style="background: rgba(37, 211, 102, 0.1); border: 1px solid rgba(37, 211, 102, 0.25); border-radius: 10px; padding: 1rem; margin-bottom: 1rem; font-size: 0.85rem; color: #cbd5e0; line-height: 1.5;"></div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="color: #a0aec0; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.4rem; display: block;"><i class="fa fa-id-card" style="margin-right: 5px;"></i> Número de Cédula</label>
                        <input type="text" id="cedulaWhatsapp" class="form-control" placeholder="Ingresa tu número de cédula" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: white; border-radius: 8px; padding: 0.6rem 0.8rem; font-size: 0.9rem;">
                    </div>
                    <input type="hidden" id="modalWhatsappEntidadId">
                    <input type="hidden" id="modalWhatsappTextoMensaje">
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgba(37, 211, 102, 0.2); padding: 0.75rem 1.25rem; justify-content: center;">
                    <button type="button" class="btn" data-dismiss="modal" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.5rem 1.2rem; font-weight: 600; font-size: 0.85rem;">Cancelar</button>
                    <button type="button" class="btn" onclick="enviarWhatsappConsulta()" style="background: linear-gradient(135deg, #25d366 0%, #128c7e 100%); color: white; border-radius: 8px; padding: 0.5rem 1.2rem; font-weight: 600; font-size: 0.85rem;"><i class="fa fa-whatsapp" style="margin-right: 5px;"></i> Enviar mensaje</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== SECCIÓN GALERÍA DE VIDEOS ===================== -->
    <div class="videos-section">
        <div class="videos-header">
            <h3><i class="fa fa-play-circle"></i> Video Tutoriales</h3>
            <p>Aprende a usar nuestra plataforma con estos videos</p>
            <!--<button type="button" class="btn-agregar-video" onclick="abrirModalAgregarVideo()"><i class="fa fa-plus"></i> Agregar Video</button>-->
        </div>
        
        <div class="videos-grid">
            <?php
            $sql_videos = "SELECT * FROM tbl15_videotutorial WHERE cod_estado = '1' ORDER BY fecha_reg_time DESC";
            $consulta_videos = mysqli_query($conectar, $sql_videos);
            if ($consulta_videos && mysqli_num_rows($consulta_videos) > 0) {
                while ($video = mysqli_fetch_assoc($consulta_videos)) {
                    
                    $cod_video                           = $video['cod_videotutorial'];
                    $nombre_video                        = $video['nombre_videotutorial'];
                    $descripcion_video                   = $video['descripcion_videotutorial'];
                    $url_video                           = $video['url_videotutorial'];
                    // Detectar si es video local o YouTube
                    $es_local = (strpos($url_video, '../') === 0 || strpos($url_video, './') === 0 || strpos($url_video, 'archivador/') !== false);
                    $youtube_id = '';
                    
                    if (!$es_local && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url_video, $match)) { $youtube_id = $match[1]; }
                    // Definir thumbnail
                    if (!empty($youtube_id)) { $thumbnail = "https://img.youtube.com/vi/{$youtube_id}/hqdefault.jpg"; $tipo_video = 'youtube'; } else { $thumbnail = "../imagenes/iconos/video_local_thumb.png"; $tipo_video = 'local'; }
            ?>
            <div class="video-card" onclick="abrirModalVideo('<?php echo $url_video; ?>', '<?php echo addslashes($nombre_video); ?>', '<?php echo $tipo_video; ?>')">
                <div class="video-thumbnail">
                    <img src="<?php echo $thumbnail; ?>" alt="<?php echo $nombre_video; ?>"><div class="play-overlay"><i class="fa fa-play-circle"></i></div>
                </div>
                <div class="video-info">
                    <h4><?php echo $nombre_video; ?></h4>
                    <?php if (!empty($descripcion_video)) { ?><p><?php echo substr($descripcion_video, 0, 80); ?><?php echo strlen($descripcion_video) > 80 ? '...' : ''; ?></p><?php } ?>
                </div>
            </div>
            <?php 
                }
            } else { 
            ?>
            <div class="no-videos-message"><i class="fa fa-video-slash"></i><p>No hay videos disponibles en este momento</p></div>
            <?php } ?>
        </div>
    </div>
</main>

<!-- Modal para reproducir video -->
<div class="modal fade" id="modalVideo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-video-content">
            <div class="modal-header modal-video-header">
                <h5 class="modal-title" id="modalVideoTitulo">Video Tutorial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" onclick="cerrarModalVideo()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body modal-video-body">
                <div class="video-container" id="videoContainer"><!-- El iframe del video se insertará aquí --></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar video -->
<div class="modal fade" id="modalAgregarVideo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-video-content">
<!--
            <div class="modal-header modal-video-header">
                <h5 class="modal-title"><i class="fa fa-plus-circle"></i> Agregar Video Tutorial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
            </div>
            -->
            <div class="modal-body" style="padding: 1.5rem;">
                <!-- Tabs para elegir tipo de video -->
                <div class="video-type-tabs">
                    <button type="button" class="video-tab-btn active" onclick="cambiarTipoVideo('youtube')" id="tabYoutube"><i class="fa fa-youtube"></i> URL de YouTube</button>
                    <button type="button" class="video-tab-btn" onclick="cambiarTipoVideo('archivo')" id="tabArchivo"><i class="fa fa-upload"></i> Subir Archivo</button>
                </div>
                
                <form id="formAgregarVideo" enctype="multipart/form-data">
                    <input type="hidden" id="tipo_video" name="tipo_video" value="youtube">
                    
                    <div class="form-group-video">
                        <label for="nombre_videotutorial"><i class="fa fa-tag"></i> Nombre del Video *</label>
                        <input type="text" id="nombre_videotutorial" name="nombre_videotutorial" class="form-control-video" placeholder="Ej: Cómo simular un crédito" required>
                    </div>
                    
                    <!-- Opción YouTube -->
                    <div id="seccionYoutube" class="video-section-content">
                        <div class="form-group-video">
                            <label for="url_videotutorial"><i class="fa fa-link"></i> URL del Video (YouTube) *</label>
                            <input type="url" id="url_videotutorial" name="url_videotutorial" class="form-control-video" placeholder="https://www.youtube.com/watch?v=XXXX">
                            <small class="form-help-text">Pega el enlace de YouTube del video</small>
                        </div>
                        
                        <div class="preview-video-container" id="previewVideoContainer" style="display: none;">
                            <label><i class="fa fa-eye"></i> Vista Previa</label><div class="preview-thumbnail" id="previewThumbnail"></div>
                        </div>
                    </div>
                    
                    <!-- Opción Subir Archivo -->
                    <div id="seccionArchivo" class="video-section-content" style="display: none;">
                        <div class="form-group-video">
                            <label for="archivo_video"><i class="fa fa-file-video"></i> Seleccionar Video *</label>
                            <div class="file-upload-container">
                                <input type="file" id="archivo_video" name="archivo_video" accept="video/mp4,video/webm,video/ogg" class="file-input-video">
                                <div class="file-upload-box" id="fileUploadBox" onclick="document.getElementById('archivo_video').click();">
                                    <i class="fa fa-cloud-upload-alt"></i><p>Haz clic para seleccionar un video</p><small>Formatos: MP4, WebM, OGG (Máx: 100MB)</small>
                                </div>
                                <div class="file-selected" id="fileSelected" style="display: none;">
                                    <i class="fa fa-file-video"></i><span id="fileName"></span>
                                    <button type="button" class="btn-remove-file" onclick="removerArchivo()"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group-video">
                            <label for="miniatura_video"><i class="fa fa-image"></i> Miniatura del Video (Opcional)</label>
                            <input type="file" id="miniatura_video" name="miniatura_video" accept="image/jpeg,image/png,image/webp" class="form-control-video" style="padding: 0.5rem;">
                            <small class="form-help-text">Imagen de vista previa del video (JPG, PNG, WebP)</small>
                        </div>
                    </div>
                    
                    <div class="form-group-video">
                        <label for="descripcion_videotutorial"><i class="fa fa-align-left"></i> Descripción (Opcional)</label>
                        <textarea id="descripcion_videotutorial" name="descripcion_videotutorial" class="form-control-video" rows="3" placeholder="Breve descripción del contenido del video..."></textarea>
                    </div>
                    
                    <div class="btn-group-video">
                        <button type="button" class="btn-video-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                        <button type="submit" class="btn-video-primary" id="btnGuardarVideo"><i class="fa fa-save"></i> Guardar Video</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* ===================== ESTILOS GALERÍA DE VIDEOS ===================== */
.videos-section {
    margin-top: 2rem;
    padding: 1.5rem 1rem;
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border-radius: 16px;
    border: 1px solid rgba(65, 105, 225, 0.3);
}

.videos-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.videos-header h3 {
    color: white;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.videos-header h3 i {
    color: #00d4ff;
    font-size: 1.5rem;
}

.videos-header p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.85rem;
    margin: 0;
}

.videos-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

@media (max-width: 500px) {
    .videos-grid {
        grid-template-columns: 1fr;
    }
}

.video-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid rgba(65, 105, 225, 0.2);
}

.video-card:hover {
    transform: translateY(-3px);
    border-color: #00d4ff;
    box-shadow: 0 8px 25px rgba(0, 212, 255, 0.2);
}

.video-thumbnail {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* Aspect ratio 16:9 */
    overflow: hidden;
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
    font-size: 3rem;
    color: rgba(255, 255, 255, 0.9);
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    transition: all 0.3s ease;
}

.video-card:hover .play-overlay {
    background: rgba(0, 212, 255, 0.3);
}

.video-card:hover .play-overlay i {
    transform: scale(1.2);
    color: #00d4ff;
}

.video-info {
    padding: 0.85rem;
}

.video-info h4 {
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
    margin: 0 0 0.35rem 0;
    line-height: 1.3;
}

.video-info p {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.75rem;
    margin: 0;
    line-height: 1.4;
}

.no-videos-message {
    grid-column: 1 / -1;
    text-align: center;
    padding: 2rem;
    color: rgba(255, 255, 255, 0.5);
}

.no-videos-message i {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
}

.no-videos-message p {
    margin: 0;
    font-size: 0.9rem;
}

/* Modal de Video */
.modal-video-content {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 16px;
}

.modal-video-header {
    border-bottom: 1px solid rgba(65, 105, 225, 0.3);
    padding: 1rem 1.25rem;
}

.modal-video-header .modal-title {
    color: white;
    font-weight: 600;
}

.modal-video-header .close {
    color: white;
    opacity: 0.8;
    font-size: 1.5rem;
}

.modal-video-header .close:hover {
    color: #00d4ff;
    opacity: 1;
}

.modal-video-body {
    padding: 0;
}

.video-container {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* 16:9 */
    background: #000;
    border-radius: 0 0 16px 16px;
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
    object-fit: contain;
    background: black;
}

/* Botón agregar video */
.btn-agregar-video {
    margin-top: 1rem;
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
    border: none;
    padding: 0.65rem 1.25rem;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-agregar-video:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 212, 255, 0.4);
}

.btn-agregar-video i {
    font-size: 0.9rem;
}

/* Tabs de tipo de video */
.video-type-tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    background: rgba(0, 0, 0, 0.2);
    padding: 0.35rem;
    border-radius: 12px;
}

.video-tab-btn {
    flex: 1;
    padding: 0.75rem 1rem;
    background: transparent;
    border: none;
    border-radius: 10px;
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.video-tab-btn:hover {
    color: white;
    background: rgba(255, 255, 255, 0.1);
}

.video-tab-btn.active {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
}

.video-tab-btn i {
    font-size: 1rem;
}

/* Area de subida de archivo */
.file-upload-container {
    position: relative;
}

.file-input-video {
    display: none;
}

.file-upload-box {
    border: 2px dashed rgba(65, 105, 225, 0.4);
    border-radius: 12px;
    padding: 2rem 1rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: rgba(0, 0, 0, 0.2);
}

.file-upload-box:hover {
    border-color: #00d4ff;
    background: rgba(0, 212, 255, 0.05);
}

.file-upload-box i {
    font-size: 2.5rem;
    color: #00d4ff;
    margin-bottom: 0.75rem;
    display: block;
}

.file-upload-box p {
    color: white;
    margin: 0 0 0.35rem 0;
    font-weight: 600;
}

.file-upload-box small {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.75rem;
}

.file-selected {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: rgba(0, 212, 255, 0.1);
    border: 1px solid rgba(0, 212, 255, 0.3);
    border-radius: 10px;
    padding: 0.85rem 1rem;
}

.file-selected i {
    font-size: 1.5rem;
    color: #00d4ff;
}

.file-selected span {
    flex: 1;
    color: white;
    font-size: 0.9rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.btn-remove-file {
    background: rgba(255, 100, 100, 0.2);
    border: none;
    color: #ff6b6b;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-remove-file:hover {
    background: rgba(255, 100, 100, 0.4);
}

/* Formulario agregar video */
.form-group-video {
    margin-bottom: 1.25rem;
}

.form-group-video label {
    display: block;
    color: #00d4ff;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-group-video label i {
    margin-right: 0.35rem;
}

.form-control-video {
    width: 100%;
    padding: 0.85rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 10px;
    color: white;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control-video:focus {
    outline: none;
    border-color: #00d4ff;
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.15);
}

.form-control-video::placeholder {
    color: rgba(255, 255, 255, 0.3);
}

.form-help-text {
    display: block;
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.75rem;
    margin-top: 0.35rem;
}

.preview-video-container {
    margin-bottom: 1.25rem;
}

.preview-video-container label {
    display: block;
    color: #00d4ff;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.preview-thumbnail {
    width: 100%;
    border-radius: 10px;
    overflow: hidden;
    background: rgba(0, 0, 0, 0.3);
}

.preview-thumbnail img {
    width: 100%;
    height: auto;
    display: block;
}

.btn-group-video {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.5rem;
}

.btn-video-primary,
.btn-video-secondary {
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

.btn-video-primary {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
}

.btn-video-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 212, 255, 0.4);
}

.btn-video-primary:disabled {
    background: rgba(255, 255, 255, 0.2);
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-video-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-video-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
}

/* ===================== NOTIFICACIONES TOAST ===================== */
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
    min-width: 300px;
    max-width: 400px;
    padding: 16px 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    animation: toastSlideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    backdrop-filter: blur(10px);
}

.toast-notification.toast-exit {
    animation: toastSlideOut 0.3s ease-in forwards;
}

@keyframes toastSlideIn {
    from {
        transform: translateX(120%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes toastSlideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(120%);
        opacity: 0;
    }
}

.toast-notification.success {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.95) 0%, rgba(5, 150, 105, 0.95) 100%);
    border-left: 4px solid #34d399;
}

.toast-notification.error {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.95) 0%, rgba(185, 28, 28, 0.95) 100%);
    border-left: 4px solid #f87171;
}

.toast-notification.warning {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.95) 0%, rgba(217, 119, 6, 0.95) 100%);
    border-left: 4px solid #fbbf24;
}

.toast-notification.info {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.95) 0%, rgba(29, 78, 216, 0.95) 100%);
    border-left: 4px solid #60a5fa;
}

.toast-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.2);
    flex-shrink: 0;
}

.toast-icon i {
    font-size: 1.1rem;
    color: white;
}

.toast-content {
    flex: 1;
}

.toast-title {
    color: white;
    font-weight: 700;
    font-size: 0.95rem;
    margin-bottom: 2px;
}

.toast-message {
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.85rem;
    line-height: 1.4;
}

.toast-close {
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.7);
    cursor: pointer;
    padding: 4px;
    border-radius: 50%;
    transition: all 0.2s ease;
    flex-shrink: 0;
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
    animation: toastProgress 3s linear forwards;
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
</style>

<script>
function abrirModalVideo(url, titulo, tipo) {
    document.getElementById('modalVideoTitulo').textContent = titulo;
    
    var container = document.getElementById('videoContainer');
    var htmlContent = '';
    
    if (tipo === 'local') {
        // Video Local
        htmlContent = '<video controls autoplay playsinline controlsList="nodownload">' +
                      '<source src="' + url + '" type="video/mp4">' +
                      'Tu navegador no soporta la reproducción de video.' +
                      '</video>';
    } else {
        // YouTube o URL externa
        var embedUrl = '';
        var youtubeMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
        
        if (youtubeMatch) {
            embedUrl = 'https://www.youtube.com/embed/' + youtubeMatch[1] + '?autoplay=1&rel=0';
        } else {
            embedUrl = url;
        }
        
        htmlContent = '<iframe src="' + embedUrl + '" allowfullscreen allow="autoplay; encrypted-media"></iframe>';
    }
    
    container.innerHTML = htmlContent;
    $('#modalVideo').modal('show');
}

function cerrarModalVideo() {
    document.getElementById('videoContainer').innerHTML = '';
    $('#modalVideo').modal('hide');
}

// Limpiar video cuando se cierra el modal
$('#modalVideo').on('hidden.bs.modal', function () {
    document.getElementById('videoContainer').innerHTML = '';
});

// ===================== FUNCIONES PARA AGREGAR VIDEO =====================
var tipoVideoActual = 'youtube';

function abrirModalAgregarVideo() {
    document.getElementById('formAgregarVideo').reset();
    document.getElementById('previewVideoContainer').style.display = 'none';
    removerArchivo();
    cambiarTipoVideo('youtube');
    $('#modalAgregarVideo').modal('show');
}

// Cambiar entre tabs de YouTube y Archivo
function cambiarTipoVideo(tipo) {
    tipoVideoActual = tipo;
    document.getElementById('tipo_video').value = tipo;
    
    // Actualizar tabs
    document.getElementById('tabYoutube').classList.toggle('active', tipo === 'youtube');
    document.getElementById('tabArchivo').classList.toggle('active', tipo === 'archivo');
    
    // Mostrar/ocultar secciones
    document.getElementById('seccionYoutube').style.display = tipo === 'youtube' ? 'block' : 'none';
    document.getElementById('seccionArchivo').style.display = tipo === 'archivo' ? 'block' : 'none';
    
    // Limpiar campos de la otra sección
    if (tipo === 'youtube') {
        document.getElementById('archivo_video').value = '';
        document.getElementById('miniatura_video').value = '';
        removerArchivo();
    } else {
        document.getElementById('url_videotutorial').value = '';
        document.getElementById('previewVideoContainer').style.display = 'none';
    }
}

// Vista previa del thumbnail de YouTube
document.getElementById('url_videotutorial').addEventListener('input', function(e) {
    var url = e.target.value;
    var previewContainer = document.getElementById('previewVideoContainer');
    var previewThumbnail = document.getElementById('previewThumbnail');
    
    var youtubeMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
    
    if (youtubeMatch) {
        var thumbnailUrl = 'https://img.youtube.com/vi/' + youtubeMatch[1] + '/hqdefault.jpg';
        previewThumbnail.innerHTML = '<img src="' + thumbnailUrl + '" alt="Vista previa">';
        previewContainer.style.display = 'block';
    } else {
        previewContainer.style.display = 'none';
        previewThumbnail.innerHTML = '';
    }
});

// Manejar selección de archivo de video
document.getElementById('archivo_video').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        // Validar tamaño (máx 100MB)
        if (file.size > 100 * 1024 * 1024) {
            alert('El archivo es demasiado grande. Máximo 100MB');
            e.target.value = '';
            return;
        }
        
        document.getElementById('fileUploadBox').style.display = 'none';
        document.getElementById('fileSelected').style.display = 'flex';
        document.getElementById('fileName').textContent = file.name;
    }
});

function removerArchivo() {
    document.getElementById('archivo_video').value = '';
    document.getElementById('fileUploadBox').style.display = 'block';
    document.getElementById('fileSelected').style.display = 'none';
    document.getElementById('fileName').textContent = '';
}

// Enviar formulario de agregar video
document.getElementById('formAgregarVideo').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var tipoVideo = document.getElementById('tipo_video').value;
    
    // Validar según el tipo
    if (tipoVideo === 'youtube') {
        var url = document.getElementById('url_videotutorial').value;
        if (!url) {
            alert('Por favor ingresa la URL del video de YouTube');
            return;
        }
    } else {
        var archivo = document.getElementById('archivo_video').files[0];
        if (!archivo) {
            alert('Por favor selecciona un archivo de video');
            return;
        }
    }
    
    var btn = document.getElementById('btnGuardarVideo');
    var originalText = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
    
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
                mostrarNotificacion('success', '¡Éxito!', 'Video tutorial registrado correctamente');
                $('#modalAgregarVideo').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 1500);
            } else {
                mostrarNotificacion('error', 'Error', response.message);
            }
        },
        error: function() {
            mostrarNotificacion('error', 'Error de conexión', 'No se pudo conectar con el servidor');
        },
        complete: function() {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    });
});

// ===================== FUNCIÓN DE NOTIFICACIONES TOAST =====================
function mostrarNotificacion(tipo, titulo, mensaje) {
    // Crear contenedor si no existe
    var container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }
    
    // Determinar icono según tipo
    var iconos = {
        'success': 'fa-check',
        'error': 'fa-times',
        'warning': 'fa-exclamation-triangle',
        'info': 'fa-info'
    };
    
    // Crear notificación
    var toast = document.createElement('div');
    toast.className = 'toast-notification ' + tipo;
    toast.innerHTML = 
        '<div class="toast-icon"><i class="fa ' + iconos[tipo] + '"></i></div>' +
        '<div class="toast-content">' +
            '<div class="toast-title">' + titulo + '</div>' +
            '<div class="toast-message">' + mensaje + '</div>' +
        '</div>' +
        '<button class="toast-close" onclick="cerrarNotificacion(this)"><i class="fa fa-times"></i></button>' +
        '<div class="toast-progress"></div>';
    container.appendChild(toast);
    
    // Auto-cerrar después de 4 segundos
    setTimeout(function() {
        cerrarNotificacion(toast.querySelector('.toast-close'));
    }, 4000);
}

function cerrarNotificacion(btn) {
    var toast = btn.closest('.toast-notification');
    if (toast) {
        toast.classList.add('toast-exit');
        setTimeout(function() {
            toast.remove();
        }, 300);
    }
}
// ==================== FUNCIONES MODAL WHATSAPP ====================
function abrirModalWhatsapp(codEntidad, nombreEntidad, textoMensaje) {
    document.getElementById('modalWhatsappEntidadNombre').textContent = nombreEntidad;
    document.getElementById('modalWhatsappMensaje').textContent = textoMensaje;
    document.getElementById('modalWhatsappEntidadId').value = codEntidad;
    document.getElementById('modalWhatsappTextoMensaje').value = textoMensaje;
    document.getElementById('cedulaWhatsapp').value = '';
    $('#modalWhatsappConsulta').modal('show');
}

function enviarWhatsappConsulta() {
    var cedula = document.getElementById('cedulaWhatsapp').value.trim();
    if (!cedula) {
        alert('Por favor ingresa tu número de cédula');
        document.getElementById('cedulaWhatsapp').focus();
        return;
    }
    var nombreEntidad = document.getElementById('modalWhatsappEntidadNombre').textContent;
    var textoMensaje = document.getElementById('modalWhatsappTextoMensaje').value;
    var mensaje = textoMensaje + '\n\nCédula: ' + cedula + '\nEntidad: ' + nombreEntidad;
    var url = 'https://wa.me/573028551795?text=' + encodeURIComponent(mensaje);
    window.open(url, '_blank');
    $('#modalWhatsappConsulta').modal('hide');
}
</script>
<!-- **************************************************** FINALIZAR AQUI ******************************************** -->   
<?php //include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
