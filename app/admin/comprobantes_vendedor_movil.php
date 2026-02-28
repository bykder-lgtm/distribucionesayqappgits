<?php 
$nombre_pagina          = "Comprobantes de Pago";
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
<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style>
.nav-buttons-container { display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 1rem; }
.btn-nav-filtro { flex: 1; min-width: 70px; padding: 0.5rem 0.6rem; border: none; border-radius: 10px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-decoration: none; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 0.3rem; }
.btn-nav-todos { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3); }
.btn-nav-abierta { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); }
.btn-nav-cerrada { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); }
.btn-nav-comprobantes { background: linear-gradient(135deg, #9333ea 0%, #7c3aed 100%); color: white; box-shadow: 0 4px 15px rgba(147, 51, 234, 0.3); }
.btn-nav-filtro:hover { transform: translateY(-2px); color: white; text-decoration: none; }

.modal-comprobante-body { text-align: center; padding: 1rem; }
.modal-comprobante-body img { max-width: 100%; max-height: 70vh; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.3); }
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

    <section class="search_bar_app_movil_enrollment">
        <div class="container py-3">
            <?php include_once("../admin/menu_creditos_vendedor_movil.php"); ?>
            <div class="input-group">
                <input type="search" class="form-control" id="busqueda_ajax" onkeyup='load(1);' placeholder="Buscar por nombre o cédula...">
                <button class="btn btn-outline-secondary">✖</button>
                <button class="btn btn-outline-secondary">⟳</button>
            </div>
        </div>
        <input type="hidden" id="cod_administrador" Value="<?php echo $cod_administrador ?>">
        <input type="hidden" id="cod_seguridad" Value="25">
        <input type="hidden" id="tabla" Value="tbl15_tercero">
    </section>

    <main class="container py-3 mb-5">
        <div id="outer_div"></div>
    </main>

<!-- Modal Ver Comprobante -->
<div class="modal fade" id="modalVerComprobante" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%); border: 1px solid rgba(147, 51, 234, 0.3); border-radius: 20px;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(147, 51, 234, 0.2); padding: 1rem 1.5rem;">
                <h5 class="modal-title" style="color: white; font-weight: 700;"><i class="fa fa-file-image-o" style="color: #9333ea; margin-right: 0.5rem;"></i>Comprobante de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true" style="color: white; font-size: 1.5rem;">×</span></button>
            </div>
            <div class="modal-body modal-comprobante-body">
                <div id="comprobante-loading" style="display:none; color: #9333ea; font-size: 2rem; padding: 3rem;"><i class="fa fa-spinner fa-spin"></i></div>
                <img id="imgComprobantePago" src="" alt="Comprobante de pago" style="display:none;">
            </div>
        </div>
    </div>
</div>

<?php include_once("../menu/05_modulo_menu_vendedor_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>

<script>
$(document).ready(function(){ load(1); });

function load(page){
    var busqueda_ajax = $("#busqueda_ajax").val();
    var cod_administrador = $("#cod_administrador").val();
    var cod_seguridad = $("#cod_seguridad").val();
    var tabla = $("#tabla").val();
    $.ajax({
        url:'../admin/comprobantes_vendedor_movil_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por=nombre1_tercero_identificacion_tercero&numero_registro_por_pagina=9999999&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla+'&pagina='+encodeURIComponent('<?php echo $pagina_local ?>'),
        beforeSend: function(){ $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...'); },
        success:function(data){ $("#outer_div").html(data).fadeIn('slow'); $('#loader').html(''); }
    })
}

function abrirModalComprobantePago(cod_info_factura_venta, url_img) {
    $('#comprobante-loading').show();
    $('#imgComprobantePago').hide();
    $('#modalVerComprobante').modal('show');
    var img = document.getElementById('imgComprobantePago');
    img.onload = function(){ $('#comprobante-loading').hide(); $(this).fadeIn(); };
    img.onerror = function(){ $('#comprobante-loading').hide(); $(this).attr('src', '../imagenes/no-image.png').fadeIn(); };
    img.src = url_img;
}
</script>
