<?php 
$nombre_pagina          = "FlexiTech - Bienvenidos";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo ($nombre_pagina) ?></title>
    <meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"     content="IE=edge">
    <meta name="viewport"                  content="width=device-width, initial-scale=1.0">
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
    <link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />
    <link rel="stylesheet" href="../estilo_css/estilo_animacion_flexitech.css">
</head>
<body>
    <div class="container">
        <!-- Partículas de fondo -->
        <div class="particles"></div>
        <!-- Logo FlexiTech -->
        <div class="logo-container">
            <div class="logo-symbol">
                <img src="../imagenes/logo-flexitech.png" alt="FlexiTech Logo" class="logo-image">
            </div>
            <div class="logo-text">FLEXITECH</div>
        </div>
        <!-- Texto Bienvenida -->
        <div class="welcome-text">
            <span class="letter">B</span>
            <span class="letter">i</span>
            <span class="letter">e</span>
            <span class="letter">n</span>
            <span class="letter">v</span>
            <span class="letter">e</span>
            <span class="letter">n</span>
            <span class="letter">i</span>
            <span class="letter">d</span>
            <span class="letter">o</span>
            <span class="letter">s</span>
        </div>
        
        <!-- Botón -->
        <div class="button-container">
            <button class="start-button" onclick="redirigirAPagina()"><span class="button-text">Comencemos</span><div class="button-glow"></div>
            </button>
        </div>
        
        <!-- Efectos de luz -->
        <div class="light-effect light-1"></div>
        <div class="light-effect light-2"></div>
        <div class="light-effect light-3"></div>
    </div>
    <script src="../js/script_estilo_animacion_flexitech.js"></script>
    <script>
        function redirigirAPagina() {
            var url_pag_redirec_ini_sesion = "<?php echo $url_pag_redirec_ini_sesion; ?>";
            window.location.href = url_pag_redirec_ini_sesion;
        }
    </script>
</body>
</html>