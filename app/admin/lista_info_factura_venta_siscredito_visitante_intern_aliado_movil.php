<?php 
$nombre_pagina          = "Gestión de Solicitudes";
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
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style><?php include_once("../estilo_css/estilo_lista_credito_aliado.css"); ?></style>

</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>
    <!-- Start Cart -->
<?php 
$cod_seguridad                               = '25'; //CLIENTE 
$nombre_tipo_tercero_text                    = ucfirst(strtolower('CLIENTE'));
$buscar_por                                  = "nombre1_tercero_identificacion_tercero";
$nombre_estado_factura                       = "ABIERTA";

if (isset($_GET['desplegar_modal_id'])) { $desplegar_modal_id = addslashes($_GET['desplegar_modal_id']); } else { $desplegar_modal_id = ''; }
if (isset($_GET['cod_info_factura_venta'])) { $cod_info_factura_venta = intval($_GET['cod_info_factura_venta']); } else { $cod_info_factura_venta = ''; }
if (isset($_GET['cod_tercero'])) { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = ''; }
?>
    <!-- Buscador alineado con tarjetas -->
    <section class="search_bar_app_movil_enrollment">
        <div class="container py-3">
            <!-- Botones de navegación -->
             <?php include_once("../admin/menu_facturas_abiertas_cerradas_comprobante_pago.php"); ?>
            
            <div class="input-group">
                <input type="search" class="form-control" id="busqueda_ajax" onkeyup='load(1);' placeholder="Buscar por nombre, cédula o entidad...">
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
<?php //include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>

<script>
$(document).ready(function(){
    var tiempo_refresco_base = 10; //segundos
    const base_milisegundo = 1000;
    var tiempo_refresco = tiempo_refresco_base * base_milisegundo;
    
    // Verificar si se debe abrir un modal específico
    var desplegar_modal_id = "<?php echo $desplegar_modal_id; ?>";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta; ?>";
    var cod_tercero = "<?php echo $cod_tercero; ?>";
    
    // Cargar datos inicialmente
    load(1);
    
    // Si hay un modal que abrir, esperamos a que load() termine y la función esté disponible
    if (desplegar_modal_id === "modalListaCapturaImagenes" && cod_info_factura_venta && cod_tercero) {
        // Usar un intervalo para esperar a que la función esté disponible
        var intentos = 0;
        var maxIntentos = 20; // 20 intentos = 2 segundos máximo
        var intervaloEspera = setInterval(function() {
            intentos++;
            if (typeof procesarSolicitudCredito === 'function') {
                clearInterval(intervaloEspera);
                console.log('✅ Función procesarSolicitudCredito disponible, abriendo modal...');
                procesarSolicitudCredito(cod_info_factura_venta, cod_tercero);
            } else if (intentos >= maxIntentos) {
                clearInterval(intervaloEspera);
                console.error('❌ Error: La función procesarSolicitudCredito no se cargó a tiempo');
                alert('Error: No se pudo cargar el modal de estudio de crédito. Intente recargar la página.');
            }
        }, 100); // Verificar cada 100ms
    }
    
    // Configurar auto-refresco cada 10 segundos solo si no hay modales abiertos
    setInterval(function() {

        // Verificar si hay algún modal abierto INCLUYENDO el modal de cámara
        var hayModalAbierto = $('.modal').hasClass('show') || $('.modal.in').length > 0 || $('body').hasClass('modal-open') || $('#modalCapturaCamara').is(':visible') || $('#modalCapturaCamara').hasClass('show');
        // Verificar también si la cámara está activa (stream existe)
        var camaraActiva = window.stream !== null && window.stream !== undefined;
        // Verificar si hay una captura en progreso
        var capturaEnProgreso = window._isCapturing === true;
        if (!hayModalAbierto && !camaraActiva && !capturaEnProgreso) {
            //console.log('✅ Auto-refresco: No hay modales abiertos ni cámara activa, ejecutando load(1)');
            load(1);
        } else {
            //console.log('⏸️ Auto-refresco: PAUSADO - Modal abierto:', hayModalAbierto, ', Cámara activa:', camaraActiva, ', Captura en progreso:', capturaEnProgreso);
        }
    }, tiempo_refresco); // 10 segundos
});

function load(page){
    var busqueda_ajax = $("#busqueda_ajax").val();
    var buscar_por = $("#buscar_por").val();
    var numero_registro_por_pagina = 9999999;
    var cod_administrador = $("#cod_administrador").val();
    var cod_seguridad = $("#cod_seguridad").val();
    var tabla = $("#tabla").val();
    var nombre_estado_factura = "<?php echo $nombre_estado_factura ?>";
    var pagina = "<?php echo $pagina_local ?>";

    $("#loader").fadeIn('slow');
    $.ajax({
        url:'../admin/tabla_busqueda_paginacion_info_factura_venta_siscredito_visitante_intern_aliado_movil_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla+'&nombre_estado_factura='+nombre_estado_factura+'&pagina='+pagina, 
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $("#outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
            
            // IMPORTANTE: Reconfigurar event listeners después de actualizar el DOM
            //console.log('🔄 DOM actualizado por load(), reconfigurando eventos...');
            if (typeof window.configurarModalEventos === 'function') {
                // Pequeño delay para asegurar que el DOM esté completamente renderizado
                setTimeout(function() {
                    window.configurarModalEventos();
                }, 100);
            } else {
                console.warn('⚠️ configurarModalEventos no está disponible');
            }
        }
    })
}
</script>

<script>
function obtener_datos_tercero_factura_venta_modal(id){
    var pagina = "<?php echo $pagina_local;?>";
    var identificacion_tercero = "";
    var nombre1_tercero = "";
    var nombre2_tercero = "";
    var apellido1_tercero = "";
    var apellido2_tercero = "";

    $("#mod_"+"pagina").val(pagina);
    $("#mod_"+"identificacion_tercero").val(identificacion_tercero);
    $("#mod_"+"nombre1_tercero").val(nombre1_tercero);
    $("#mod_"+"nombre2_tercero").val(nombre2_tercero);
    $("#mod_"+"apellido1_tercero").val(apellido1_tercero);
    $("#mod_"+"apellido2_tercero").val(apellido2_tercero);
}
</script>