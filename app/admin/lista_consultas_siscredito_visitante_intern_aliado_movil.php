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

<style><?php include_once("../estilo_css/estilo_lista_consultas_aliado.css"); ?></style>

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
            <!--<div class="entidad-nombre"><?php echo $nombre_entidad_crediticia; ?></div>-->
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
        url: 'registrar_video_tutorial_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(response) {
            if (response.success) {
                mostrarNotificacion('success', '¡Éxito!', 'Video tutorial registrado correctamente');
                $('#modalAgregarVideo').modal('hide');
                setTimeout(function() { location.reload(); }, 1500);
            } else {
                mostrarNotificacion('error', 'Error', response.message);
            }
        }, error: function() { mostrarNotificacion('error', 'Error de conexión', 'No se pudo conectar con el servidor'); },
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
    var iconos = { 'success': 'fa-check', 'error': 'fa-times', 'warning': 'fa-exclamation-triangle', 'info': 'fa-info' };
    
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
