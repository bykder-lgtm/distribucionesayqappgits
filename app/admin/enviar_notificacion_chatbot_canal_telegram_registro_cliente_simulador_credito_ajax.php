<?php 
$nombre_pagina          = "Enviando";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern.php"); ?>
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

<?php include_once("../admin/03_modulo_css_visitante_intern.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php
if (isset($_GET['cod_info_factura_venta'])) {
    $cod_info_factura_venta                                     = intval($_GET['cod_info_factura_venta']);
    $pagina                                                     = intval($_GET['pagina']);
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;" id="loader">Guardando...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->
<?php } ?>
<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>

<?php
if (isset($_GET['cod_info_factura_venta'])) { ?>
    <script>
    $(document).ready(function() {

        var cod_info_factura_venta = "<?php echo $cod_info_factura_venta;?>";
        var tab = "tbl15_info_factura_venta";
        var campo = "cod_info_factura_venta";
        var tipo_ajax = "tbl15_info_factura_venta";
        var tipo_ajax2 = "tbl15_info_factura_venta_notificacion_chatbot_telegram";
        var pagina = "<?php echo $pagina;?>";
        var pagina_redirect_imprimir = '../admin/registro_cliente_y_precredito_opcion_imprimir_siscredito_visitante_intern.php'+'?'+'cod_info_factura_venta='+cod_info_factura_venta

        var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;

        $.ajax({
            type: "GET",
            url: "../admin/enviar_notificacion_chatbot_canal_telegram_registro_cliente_simulador_credito_json.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                //$('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
            },
            success:function(respuesta){
                var respuesta_ok = respuesta.ok;

                if(respuesta_ok == '1') {
                    var cod_estado_enviado = 1;
                } else {
                    var cod_estado_enviado = 0;
                }

                var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'respuesta_ok='+respuesta_ok+'&'+'cod_estado_enviado='+cod_estado_enviado+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax2+'&'+'pagina='+pagina;
                $.ajax({
                    type: "POST",
                    url: "../admin/guardar_info_factura_venta_notificacion_chatbot_telegram_registro_cliente_simulador_credito_json_ajax.php",
                    data: datos_url_ajax,
                    beforeSend: function(objeto){
                        $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                    },
                    success:function(respuesta){
                        location.href = pagina_redirect_imprimir;
                    }
                });
            }
        });
    });
    </script>
<?php } ?>
