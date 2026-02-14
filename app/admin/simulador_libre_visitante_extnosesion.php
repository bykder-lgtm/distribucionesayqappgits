<?php 
$nombre_pagina          = "Simulador de Credito Libre";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_extnosesion.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_extnosesion.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>
<?php //include_once("../admin/01_rastreador_geolocalizacion_gps_javacript.php"); ?>

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
<!--<meta name="description"               content="<?php echo $resena_info_empresa ?>">-->
<meta name="author"                    content="<?php echo $author ?>">
<meta property="og:url"                content="<?php echo $pagina_local ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_pagina ?>" />
<meta property="og:description"        content="<?php echo $nombre_pagina ?>" />
<meta property="og:image"              content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="<?php echo $usuario_redsocial_facebook ?>"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<!--<meta name="twitter:description"       content="<?php echo $resena_info_empresa ?>">-->
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_visitante_extnosesion.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">
<link href="../estilo_css/animate_css_slider.min.css" rel="stylesheet">
<link href="../estilo_css/main_DarkSlateBlue_css_slider.css" rel="stylesheet">
<link href="../estilo_css/formulario_registro_cliente_visitante.css" rel="stylesheet">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />
<?php //include_once("../pixel_facebook_js/pixel_facebook.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante_extnosesion.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_extnosesion.php"); ?>
    <!-- End Main Top -->
<?php //include_once("../admin/06_modulo_estamos_en_mantenimiento_head_extnosesion.php"); ?>

<?php //include_once("../admin/06_modulo_imagen_head_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/04_modulo_titulo_pagina_visitante_extnosesion.php"); ?>

<?php //include_once("../admin/05_modulo_slider_visitante_extnosesion.php"); ?>

<?php
$tab                               = "producto";
$tab_codif                         = DAXCODIFCRYPTOR::encodiftextodax($tab);
$tab_codifcryp                     = DAXCODIFCRYPTOR::encriptardax($tab_codif);

$campo                             = "cod_producto";
$campo_codif                       = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                   = DAXCODIFCRYPTOR::encriptardax($campo_codif);

$tipo                              = "carrito";
$tipo_codif                        = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                            = "registrar";
$accion_codif                      = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                            = "carrito";
$origen_codif                      = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$accion_whatapp                    = "redirecionar_whatapp";
$accion_whatapp_codif              = DAXCODIFCRYPTOR::encodiftextodax($accion_whatapp);
$accion_whatapp_codifcryp          = DAXCODIFCRYPTOR::encriptardax($accion_whatapp_codif);

$accion_telefono                   = "redirecionar_telefono";
$accion_telefono_codif             = DAXCODIFCRYPTOR::encodiftextodax($accion_telefono);
$accion_telefono_codifcryp         = DAXCODIFCRYPTOR::encriptardax($accion_telefono_codif);

$und_vendida                       = 1;
$und_vendida_codif                 = DAXCODIFCRYPTOR::encodifdax($und_vendida);
$und_vendida_codifcryp             = DAXCODIFCRYPTOR::encriptardax($und_vendida_codif);

$nombre_tipo_origen_simulacion     = "SIMULACION_VALOR_LIBRE";
?>

<?php //include_once("../admin/05_modulo_quienes_somos_y_equipo.php"); ?>

<?php //include_once("../admin/05_modulo_algunas_categorias.php"); ?>

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Simulador de Credito</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--<form name="formulario_de_actualizacion" method="POST" enctype="multipart/form-data" action="../admin/simulador_credito_visitante_intern_libre_resultado.php">-->
        <form name="formulario_de_actualizacion" method="POST" autocomplete="off" action="../admin/simulador_libre_visitante_extnosesion_resultado.php">
           
            <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-main table-responsive">

                            <div class="mb-3">
                                <label for="address">Escribe el valor del producto de contado *</label>
                                <input type="text" class="form-control" name="precio_venta_producto_formateado" id="precio_venta_producto_formateado" min='0' value="" placeholder="" required>
                                <input type="hidden" name="precio_venta_producto" id="precio_venta_producto" min='0' value="" placeholder="" required>
                                <div class="invalid-feedback">Escribe el valor del crédito </div>
                            </div>
                            <input type="hidden" name="nombre_tipo_origen_simulacion" value="<?php echo $nombre_tipo_origen_simulacion ?>">
                            <input type="hidden" name="cod_producto_codifcryp" value="">
                            <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
                            <input type="hidden" name="insertar_datos" value="formulario">
                            <div class="col-12 d-flex shopping-box"><button class="btn hvr-hover btn-lg btn-block" type="submit" class="btn hvr-hover">Simular Credito</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Cart -->

<?php //include_once("../admin/05_modulo_algunos_productos_extnosesion.php"); ?>
<?php //include_once("../admin/05_modulo_slider_marcas_footer_extnosesion.php"); ?>
<?php //include_once("../admin/08_modulo_instagram_extnosesion.php"); ?>
<?php //include_once("../admin/09_modulo_chat_messenger_facebook.php"); ?>
<?php //include_once("../admin/09_modulo_chat_whatsapp.php"); ?>

<?php include_once("../admin/09_modulo_footer_visitante_extnosesion.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_extnosesion.php"); ?>

</body>

</html>

<script language="javascript">
const precio_venta_producto_formateado = document.getElementById('precio_venta_producto_formateado');

precio_venta_producto_formateado.addEventListener('keyup', (e) => {
    const numero_entrada_sin_formato_precio_venta_producto = e.target.value;
    const numero_formateado_precio_venta_producto = formatearNumero(numero_entrada_sin_formato_precio_venta_producto);
    e.target.value = numero_formateado_precio_venta_producto;
    valor_no_formateado_punto = numero_formateado_precio_venta_producto.replace('.',"").replace('.',"")
    valor_no_formateado_coma = valor_no_formateado_punto.replace(',',"").replace(',',"")
    valor_no_formateado = valor_no_formateado_coma;
    document.getElementById('precio_venta_producto').value = valor_no_formateado;
});

function formatearNumero(numero) {
  // Elimina todos los caracteres que no sean dígitos
  let valorNumerico = String(numero).replace(/\D/g, '');
  // Formatea el número según la configuración regional del navegador
  // Puedes especificar una locale, como 'es-ES' para España o 'en-US' para Estados Unidos
  return valorNumerico === '' ? valorNumerico : Number(valorNumerico).toLocaleString();
}
</script>