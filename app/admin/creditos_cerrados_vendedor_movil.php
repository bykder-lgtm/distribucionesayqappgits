<?php 
$nombre_pagina          = "Créditos Cerrados";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="<?php echo $keywords ?>">
<meta name="description" content="<?php echo $nombre_pagina ?>">
<meta name="author" content="<?php echo $author ?>">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style>
.nav-buttons-container { display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 1rem; }
.btn-nav-filtro { flex: 1; min-width: 70px; padding: 0.5rem 0.6rem; border: none; border-radius: 10px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-decoration: none; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 0.3rem; }
.btn-nav-todos { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3); }
.btn-nav-todos:hover { transform: translateY(-2px); color: white; text-decoration: none; }
.btn-nav-abierta { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); }
.btn-nav-abierta:hover { transform: translateY(-2px); color: white; text-decoration: none; }
.btn-nav-cerrada { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); }
.btn-nav-cerrada:hover { transform: translateY(-2px); color: white; text-decoration: none; }
.btn-nav-comprobantes { background: linear-gradient(135deg, #9333ea 0%, #7c3aed 100%); color: white; box-shadow: 0 4px 15px rgba(147, 51, 234, 0.3); }
.btn-nav-comprobantes:hover { transform: translateY(-2px); color: white; text-decoration: none; }
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>
<?php 
$cod_seguridad = '2';
$buscar_por = "nombre1_tercero_identificacion_tercero";
$nombre_estado_factura = "CERRADA";
if (isset($_GET['desplegar_modal_id'])) { $desplegar_modal_id = addslashes($_GET['desplegar_modal_id']); } else { $desplegar_modal_id = ''; }
if (isset($_GET['cod_info_factura_venta'])) { $cod_info_factura_venta = intval($_GET['cod_info_factura_venta']); } else { $cod_info_factura_venta = ''; }
if (isset($_GET['cod_tercero'])) { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = ''; }
?>
    <section class="search_bar_app_movil_enrollment">
        <div class="container py-3">
            <?php include_once("../admin/menu_creditos_vendedor_movil.php"); ?>
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

    <main class="container py-3 mb-5">
        <div id="outer_div"></div>
    </main>

<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
<?php include_once("../menu/05_modulo_menu_vendedor_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>

<script>
$(document).ready(function(){
    load(1);
    var desplegar_modal_id = "<?php echo $desplegar_modal_id; ?>";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta; ?>";
    var cod_tercero = "<?php echo $cod_tercero; ?>";
    if (desplegar_modal_id === "modalEstudioCredito") {
        setTimeout(function() { if (cod_info_factura_venta && cod_tercero) { procesarSolicitudCredito(cod_info_factura_venta, cod_tercero); } }, 1500);
    } else if (desplegar_modal_id === "modalListaCapturaImagenes") {
        setTimeout(function() { if (cod_info_factura_venta && cod_tercero) { $('#modalListaCapturaImagenes').modal('show'); $('#cod_info_factura_venta_modal_lista_captura_imagenes').val(cod_info_factura_venta); $('#cod_tercero_modal_lista_captura_imagenes').val(cod_tercero); $('#cod_tipo_metodo_aprobacion_modal_lista_captura_imagenes').val('1'); } }, 1500);
    }
    setInterval(function() { var hayModalAbierto = $('.modal').hasClass('show') || $('.modal.in').length > 0 || $('body').hasClass('modal-open'); if (!hayModalAbierto) { load(1); } }, 30000);
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
        url:'../admin/creditos_cerrados_vendedor_movil_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla+'&nombre_estado_factura='+nombre_estado_factura+'&pagina='+pagina, 
        beforeSend: function(objeto){ $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...'); },
        success:function(data){ $("#outer_div").html(data).fadeIn('slow'); $('#loader').html(''); if (typeof window.configurarModalEventos === 'function') { setTimeout(function() { window.configurarModalEventos(); }, 100); } }
    })
}
</script>
