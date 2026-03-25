<?php 
$nombre_pagina          = "Comprobantes de Pago";
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
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style><?php include_once("../estilo_css/estilo_lista_credito_comprobante_aliado.css"); ?></style>

</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>
    <!-- Start Cart -->
<?php 
$cod_seguridad                               = '25'; //CLIENTE 
$nombre_tipo_tercero_text                    = ucfirst(strtolower('CLIENTE'));
$buscar_por                                  = "nombre1_tercero_identificacion_tercero";
?>
    <!-- Buscador alineado con tarjetas -->
    <section class="search_bar_app_movil_enrollment">
        <div class="container py-3">
            <!-- Botones de navegación -->
             <?php include_once("../admin/menu_facturas_abiertas_cerradas_comprobante_pago.php"); ?>

            <div class="input-group">
                <input type="search" class="form-control" id="busqueda_ajax" onkeyup='debouncedLoad();' placeholder="Buscar por nombre o cédula...">
                <button class="btn btn-outline-secondary">✖</button>
                <button class="btn btn-outline-secondary">⟳</button>
            </div>
        </div>
        <input type="hidden" id="cod_administrador" Value="<?php echo $cod_administrador ?>">
        <input type="hidden" id="cod_seguridad" Value="<?php echo $cod_seguridad ?>">
        <input type="hidden" id="tabla" Value="tbl15_tercero">
    </section>

      <!-- Tarjetas -->
    <main class="container py-3 mb-5">
        <div id="outer_div"></div>
    </main>
    
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>

<!-- Modal Ver Comprobante de Pago -->
<div class="modal fade" id="modalVerComprobantePago" tabindex="-1" aria-labelledby="modalVerComprobantePagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 800px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(147, 51, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalVerComprobantePagoLabel" style="color: #9333ea; font-weight: 700; margin: 0;">
                    <i class="fa fa-receipt" style="margin-right: 8px;"></i>Comprobante de Pago
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div id="comprobanteImagenContainer" style="background: rgba(255, 255, 255, 0.05); border-radius: 12px; padding: 1.5rem; text-align: center; min-height: 400px; display: flex; align-items: center; justify-content: center;">
                    <div style="text-align: center;">
                        <i class="fa fa-spinner fa-spin" style="font-size: 3rem; color: #9333ea; margin-bottom: 1rem;"></i>
                        <p style="color: #cbd5e0; margin: 0;">Cargando comprobante...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(147, 51, 234, 0.3); padding: 1rem; gap: 0.5rem; justify-content: center;">
                <a id="btnDescargarComprobante" href="" download target="_blank" class="btn" style="background: linear-gradient(135deg, #9333ea 0%, #f97316 100%); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fa fa-download"></i> Descargar
                </a>
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
var currentAjaxRequest = null; // Variable para almacenar la petición AJAX actual
var debounceTimer = null; // Timer para debounce de búsqueda

$(document).ready(function(){
    var tiempo_refresco_base = 30; //segundos
    const base_milisegundo = 1000;
    var tiempo_refresco = tiempo_refresco_base * base_milisegundo;
    
    // Cargar datos inicialmente
    load(1);
    
    // Configurar auto-refresco
    setInterval(function() {
        var hayModalAbierto = $('.modal').hasClass('show') || $('.modal.in').length > 0 || $('body').hasClass('modal-open');
        if (!hayModalAbierto) {
            load(1);
        }
    }, tiempo_refresco);
});

// Función debounce para el buscador - espera 400ms después de la última tecla
function debouncedLoad() {
    if (debounceTimer) {
        clearTimeout(debounceTimer);
    }
    debounceTimer = setTimeout(function() {
        load(1);
    }, 400);
}

function load(page){
    // Cancelar petición anterior si aún está en curso
    if (currentAjaxRequest && currentAjaxRequest.readyState !== 4) {
        currentAjaxRequest.abort();
    }

    var busqueda_ajax = $("#busqueda_ajax").val();
    var buscar_por = $("#buscar_por").val();
    var numero_registro_por_pagina = 20;
    var cod_administrador = $("#cod_administrador").val();
    var cod_seguridad = $("#cod_seguridad").val();
    var tabla = $("#tabla").val();
    var pagina = "<?php echo $pagina_local ?>";

    $("#loader").fadeIn('slow');
    currentAjaxRequest = $.ajax({
        url:'../admin/tabla_busqueda_paginacion_comprobantes_pago_siscredito_visitante_intern_aliado_movil_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla+'&pagina='+pagina, 
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $("#outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // No mostrar error si fue cancelada intencionalmente
            if (textStatus !== 'abort') {
                $('#loader').html('');
                console.error('Error en la petición AJAX:', textStatus, errorThrown);
            }
        }
    });
}
// Función para abrir modal de comprobante de pago
function abrirModalComprobantePago(codInfoFacturaVenta, urlComprobante) {
    console.log('Abriendo modal de comprobante:', codInfoFacturaVenta, urlComprobante);
    
    const container = document.getElementById('comprobanteImagenContainer');
    const btnDescargar = document.getElementById('btnDescargarComprobante');
    
    // Configurar botón de descarga
    btnDescargar.href = urlComprobante;
    btnDescargar.download = 'comprobante_' + codInfoFacturaVenta + '.jpg';
    
    // Mostrar loading
    container.innerHTML = `
        <div style="text-align: center;">
            <i class="fa fa-spinner fa-spin" style="font-size: 3rem; color: #9333ea; margin-bottom: 1rem;"></i>
            <p style="color: #cbd5e0; margin: 0;">Cargando comprobante...</p>
        </div>
    `;
    
    // Abrir modal
    $('#modalVerComprobantePago').modal('show');
    
    // Cargar imagen
    const img = new Image();
    img.onload = function() {
        container.innerHTML = `
            <div style="width: 100%;">
                <img src="${urlComprobante}" alt="Comprobante de Pago" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);">
            </div>
        `;
    };
    img.onerror = function() {
        container.innerHTML = `
            <div style="text-align: center; color: #ff5c5c;">
                <i class="fa fa-exclamation-triangle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <p style="margin: 0;">Error al cargar el comprobante</p>
            </div>
        `;
    };
    img.src = urlComprobante;
}
</script>
