<?php 
$nombre_pagina          = "Home";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php 
include_once('../conexiones/conexione.php');
include_once('../admin/detectar_tipo_dispositivo.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_tactil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre) ?></title>
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

<?php include_once("../admin/03_modulo_css_version_tactil.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../menu/05_modulo_menu_version_tactil.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php
?>
    <!-- Start Cart  -->
<form action="../admin/venta_producto_carrito_compra_reg.php" method="post">
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-lg-4 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Iniciar Sesión</h3>
                        </div>

                            <div class="mb-3">
                                <label for="address">Usuario *</label>
                                <input type="text" class="form-control" name="cuenta" id="cuenta" value="" placeholder="Usuario" required>
                                <div class="invalid-feedback"> Ingrese su Usuario. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Contraseña *</label>
                                <input type="text" class="form-control" name="contrasena" id="pass" value="" placeholder="Contraseña" required>
                                <div class="invalid-feedback"> Ingrese su Contraseña. </div>
                            </div>
							<button class="btn btn-lg btn-primary btn-block" type="submit" id="enviar" onclick="cifrar()">Entrar</button>
							<?php if (isset($_GET['error'])) { $error = $_GET['error']; echo '<br><font color="red">'.utf8_decode($error).'.</font>'; } else { } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_version_tactil.php"); ?>

<?php include_once("../admin/10_modulo_js_version_tactil.php"); ?>

<script src="js/sha1.js"></script>
<script>
function cifrar(){
var input_pass = document.getElementById("pass");
input_pass.value = sha1(input_pass.value);
}
</script>

</body>

</html>