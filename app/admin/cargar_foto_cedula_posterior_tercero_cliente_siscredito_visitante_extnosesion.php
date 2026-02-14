<?php 
$nombre_pagina          = "Compras";
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

<?php include_once("../admin/03_modulo_css_visitante_extnosesion.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">
<script type='text/javascript' src="../js/html2canvas.js"></script>
<link href="../estilo_css/formulario_registro_cliente_visitante.css" rel="stylesheet">
<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_extnosesion.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php if (isset($_REQUEST['cod_tercero_codifcryp'])) { 
    $cod_tercero_codifcryp            = ($_REQUEST['cod_tercero_codifcryp']);
    $cod_tercero_codif                = DAXCODIFCRYPTOR::descriptardax($cod_tercero_codifcryp);
    $cod_tercero                      = intval(DAXCODIFCRYPTOR::descodifdax($cod_tercero_codif));
    $parte_foto_cedula                = ($_REQUEST['parte_foto_cedula']);

    $cod_cliente                              = 0;
    $conteo                                   = 0;
    $total_venta                              = 0;
    $incre                                    = 0;
    $smtr_iva_valor                           = 0;

    $sql_consulta = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $query_consulta = mysqli_query($conectar, $sql_consulta) or die(mysqli_error($conectar));
    $datos_consulta = mysqli_fetch_assoc($query_consulta);

    $cod_tercero                   = $datos_consulta['cod_tercero'];
    $nombre_tipo_tercero           = $datos_consulta['nombre_tipo_tercero'];
    $nombre_tipo_identificacion    = $datos_consulta['nombre_tipo_identificacion'];
    $identificacion_tercero        = $datos_consulta['identificacion_tercero'];
    $digito_tercero                = $datos_consulta['digito_tercero'];
    $nombre1_tercero               = $datos_consulta['nombre1_tercero'];
    $nombre2_tercero               = $datos_consulta['nombre2_tercero'];
    $apellido1_tercero             = $datos_consulta['apellido1_tercero'];
    $apellido2_tercero             = $datos_consulta['apellido2_tercero'];
    $direccion_tercero             = $datos_consulta['direccion_tercero'];
    $telefono1_tercero             = $datos_consulta['telefono1_tercero'];
    $telefono2_tercero             = $datos_consulta['telefono2_tercero'];
    $correo_tercero                = $datos_consulta['correo_tercero'];
    $nombre_pais                   = $datos_consulta['nombre_pais'];
    $nombre_departamento           = $datos_consulta['nombre_departamento'];
    $nombre_ciudad                 = $datos_consulta['nombre_ciudad'];
    $nombre_tipo_cliente           = $datos_consulta['nombre_tipo_cliente'];
    $nombre_tipo_regimen           = $datos_consulta['nombre_tipo_regimen'];
    $nombre_tipo_impuesto          = $datos_consulta['nombre_tipo_impuesto'];
    $contacto_tercero              = $datos_consulta['contacto_tercero'];
    $fax_tercero                   = $datos_consulta['fax_tercero'];
    //$cod_administrador             = $datos_consulta['cod_administrador'];
    $cod_estado_existe_usuario     = $datos_consulta['cod_estado_existe_usuario'];
    $nombres_tercero               = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero);

    $sql_usuario_admin = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
    $resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
    $info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
        
    $cedula                        = $info_usuario_admin['cedula'];
    $nombres                       = $info_usuario_admin['nombres'];
    $apellidos                     = $info_usuario_admin['apellidos'];
    $cuenta                        = $info_usuario_admin['cuenta'];
    $usuario                       = $nombres.' '.$apellidos.' | '.$cuenta;
    $nombre_subalterno_concat      = '';
?>
    <!-- Start Cart  -->
    <div class="contact-box-mai">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="contact-info-left">

                        <div class="row">
                            <div class="col-12">
                                <h2 style="text-align:center;" class="noo-sh-title"><?php echo $parte_foto_cedula ?></h2>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12">
                                <div style="text-align:center;" class="shop-cat-bo">
                                    <!--<div>Vista Previa</div>-->
                                    <div style="text-align:center;" id="vista_previa_camara"></div>
                                    <input type="button" value="Tomar Foto" onClick="tomar_foto(<?php echo $cod_tercero ?>, <?php echo $identificacion_tercero ?>, '<?php echo $parte_foto_cedula ?>')">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12">
                                <div style="text-align:center;" class="shop-cat-bo">
                                    <div>Imagen Tomada</div>
                                    <div style="text-align:center;" id="vista_imagen_tomada">
                                    <input type="hidden" name="url_img_foto" value="">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->
<?php } ?>

<?php include_once("../admin/09_modulo_footer_visitante_extnosesion.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_extnosesion.php"); ?>

</body>

</html>


<script type="text/javascript" src="../js/webcam.js"></script>
<script language="JavaScript">
Webcam.set({ 
    width: 240,
    height: 320,
    dest_width: 780,
    dest_height: 940,
    image_format: 'jpeg',
    jpeg_quality: 100,
    force_flash: false,
    flip_horiz: false,
    //crop_width: 240,
    //crop_height: 240
    fps: 100
});
Webcam.attach('#vista_previa_camara');

function tomar_foto(cod_tercero, identificacion_tercero, parte_foto_cedula) {
    Webcam.snap( function(data_uri) {
        document.getElementById('vista_imagen_tomada').innerHTML = '<img src="../imagenes/loader.gif"/>';
        Webcam.upload( data_uri, '../admin/guardar_img_foto_tercero_cliente_siscredito_visitante_extnosesion_webcam_ajax.php?cod_tercero='+cod_tercero+'&identificacion_tercero='+identificacion_tercero+'&parte_foto_cedula='+parte_foto_cedula, function(code, url_foto_ajax) { 
            //var cod_tercero = url_foto_ajax.cod_tercero;
            //var url_img_foto_orig = url_foto_ajax.url_img_foto_orig;
            //var parte_foto_cedula = url_foto_ajax.parte_foto_cedula;

            document.getElementById('vista_imagen_tomada').innerHTML = '<input type="hidden" name="url_img_foto" value="'+url_foto_ajax+'">' + '<img style="width:240px" src="'+url_foto_ajax+'"/>';
            //console.log("code = "+code);
            //console.log("url_img_foto_orig = "+url_img_foto_orig);
            //console.log("parte_foto_cedula = "+parte_foto_cedula);
            //console.log("url_foto_ajax = "+url_foto_ajax);

    } ); } ); 
}
</script>
