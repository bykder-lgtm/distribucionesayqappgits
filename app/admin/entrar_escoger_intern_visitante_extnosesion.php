<?php 
$nombre_pagina          = "Entrar Como";
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

<?php include_once("../admin/03_modulo_css_visitante_modif_extnosesion.php"); ?>
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />
<?php //include_once("../pixel_facebook_js/pixel_facebook.php"); ?>
<!-- -->
<link href="../estilo_css/estilo_formulario_login_css.css" rel="stylesheet">
<link href="../estilo_css/fondo_dasboard_login.css" rel="stylesheet">
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante_extnosesion.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_extnosesion.php"); ?>
    <!-- End Main Top -->
<?php include_once("../admin/modal_previsualizar_entrar_intern_visitante_extnosesion.php"); ?>

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
?>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="ibody">
                        <div class="jumbotron"><h1>Ingresar Como</h1></div>
                        <div class="fcontacto">
                            <a href="#" class="btn btn-lg btn-primary btn-block" onclick="obtener_datos_rol_ingreso_modal('Asesor');" data-toggle="modal" data-target=".abrir_previsualizacion_modal_entrar_intern"><h2>Asesor</h2></a>
                            <a href="#" class="btn btn-lg btn-primary btn-block" onclick="obtener_datos_rol_ingreso_modal('Aliado');" data-toggle="modal" data-target=".abrir_previsualizacion_modal_entrar_intern"><h2>Aliado</h2></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="imagen_fondo_login"></div>

    <!-- End About Page -->
<?php //include_once("../admin/09_modulo_footer_visitante_extnosesion.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_extnosesion.php"); ?>

</body>

</html>

<script>
function obtener_datos_rol_ingreso_modal(tipo_rol){
    var tipo_rol = tipo_rol;
    $("#mod_"+"tipo_rol").html('Ingresar Como '+tipo_rol);
}
</script>

<script src="js/sha1.js"></script>
<script>
function cifrar(){
    var input_pass = document.getElementById("pass");
    input_pass.value = sha1(input_pass.value);
}
</script>