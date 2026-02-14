<?php 
$nombre_pagina          = "Créditos Cerrados";
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

<style>
/* Estilos para los botones de navegación */
.nav-buttons-container {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.btn-nav-filtro {
    flex: 1;
    min-width: 100px;
    padding: 0.6rem 1rem;
    border: none;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-nav-abierta {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-nav-abierta:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.btn-nav-cerrada {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn-nav-cerrada:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.btn-nav-comprobantes {
    background: linear-gradient(135deg, #9333ea 0%, #f97316 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(147, 51, 234, 0.3);
}

.btn-nav-comprobantes:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ea580c 100%);
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.btn-nav-filtro.active {
    transform: scale(1.02);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>
    <!-- Start Cart -->
<?php 
$cod_seguridad                               = '25'; //CLIENTE 
$nombre_tipo_tercero_text                    = ucfirst(strtolower('CLIENTE'));
$buscar_por                                  = "nombre1_tercero_identificacion_tercero";
$nombre_estado_factura                       = "CERRADA";
?>
    <!-- Buscador alineado con tarjetas -->
    <section class="search_bar_app_movil_enrollment">
        <div class="container py-3">
            <!-- Botones de navegación -->
            <div class="nav-buttons-container mb-3">
                <a href="lista_info_factura_venta_siscredito_visitante_intern_aliado_movil.php" class="btn-nav-filtro btn-nav-abierta">
                    <i class="fa fa-folder-open"></i> Abiertas
                </a>
                <a href="lista_info_factura_venta_cerrada_siscredito_visitante_intern_aliado_movil.php" class="btn-nav-filtro btn-nav-cerrada active">
                    <i class="fa fa-folder"></i> Cerradas
                </a>
                <a href="lista_comprobantes_pago_siscredito_visitante_intern_aliado_movil.php" class="btn-nav-filtro btn-nav-comprobantes">
                    <i class="fa fa-receipt"></i> Comprobantes
                </a>
            </div>
            
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
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>

<script>
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
        url:'../admin/tabla_busqueda_paginacion_info_factura_venta_cerrada_siscredito_visitante_intern_aliado_movil_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla+'&nombre_estado_factura='+nombre_estado_factura+'&pagina='+pagina, 
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $("#outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
            
            if (typeof window.configurarModalEventos === 'function') {
                setTimeout(function() {
                    window.configurarModalEventos();
                }, 100);
            }
        }
    })
}
</script>
