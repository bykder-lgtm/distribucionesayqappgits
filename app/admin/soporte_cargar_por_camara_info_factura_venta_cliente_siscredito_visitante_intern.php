<?php 
$nombre_pagina          = "Compras";
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
<script type='text/javascript' src="../js/html2canvas.js"></script>


<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php //include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php
if (isset($_GET['cod_nota_observacion'])) {

    $cod_nota_observacion                                 = intval($_GET['cod_nota_observacion']);
    $cod_info_factura_venta                               = intval($_GET['cod_info_factura_venta']);
    $cod_tercero                                          = intval($_GET['cod_tercero']);
    $pagina                                               = addslashes($_GET['pagina']);
    $pagina_redirect                                      = $pagina.'?cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina;

    $mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_nota_observacion = '$cod_nota_observacion')";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $nombre_nota_observacion                        = $matriz_consulta['nombre_nota_observacion'];

    $datos_data_info_factura = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $identificacion_tercero                               = $data_info_factura['identificacion_tercero'];
    $nombre1_tercero                                      = $data_info_factura['nombre1_tercero'];
    $nombre2_tercero                                      = $data_info_factura['nombre2_tercero'];
    $apellido1_tercero                                    = $data_info_factura['apellido1_tercero'];
    $apellido2_tercero                                    = $data_info_factura['apellido2_tercero'];
    $nombre_cliente                                       = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero).' - '.$identificacion_tercero;

    $datos_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_info_factura_venta = mysqli_query($conectar, $datos_info_factura_venta);
    $data_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_entidad_crediticia                               = $data_info_factura_venta['cod_entidad_crediticia'];
    $monto_deuda                                          = $data_info_factura_venta['monto_deuda'];

    $datos_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto_temporal = mysqli_query($conectar, $datos_venta_producto_temporal);
    $data_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

    $cod_producto_barra                                   = $data_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                                      = $data_venta_producto_temporal['nombre_producto'];

    $datos_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $datos_entidad_crediticia);
    $data_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                            = $data_entidad_crediticia['nombre_entidad_crediticia'];

    $tab                                                  = 'tbl15_nota_observacion';
    $campo                                                = 'cod_nota_observacion';
    $tipo                                                 = 'eliminar';

    $fecha_impr                                           = date("Ymd");
    $hora_impr                                            = date("His");
    ?>

    <!-- Start Cart -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="contact-form-right">
                    <div class="row p-3 mb-2 bg-primary text-white">
                        <div class="col-md-12">
                            <div style="text-align:center;" class=""><?php echo $nombre_nota_observacion ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!--<div class="row">-->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="contact-form-center">

                    <div class="row">

                        <div class="col-md-12">
                            <div style="text-align:center;" class="">
                                <div style="text-align:center;" id="vista_previa_camara"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div style="text-align:center;" class="">
                                <button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit" onClick="tomar_foto(<?php echo $cod_info_factura_venta ?>, <?php echo $cod_nota_observacion ?>)">Tomar Foto</button>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div style="text-align:center;" class="">
                                <div style="text-align:center;" id="vista_imagen_tomada"><input type="hidden" name="url_img_foto" value="<?php echo $url_img_foto_sesion ?>"><img src="<?php echo $url_img_foto_sesion ?>"/></div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div style="text-align:center;" class="">
                                <div style="text-align:center;" id="url_guardar"></div>
                                <input id="foco" name="foco" type="checkbox">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <!--</div>-->
    </div>
    <!-- End Cart -->

<?php } ?>

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>
</html>

<script type="text/javascript" src="js/webcam.js"></script>

<script language="JavaScript">
Webcam.set({ 
    width: 350, 
    height: 400, 
    dest_width: 1024,
    dest_height: 1024,
    image_format: 'jpeg', 
    jpeg_quality: 90, 
    constraints: { 
        width: 1000, 
        height: 1000, 
        facingMode: 'user' 
        //facingMode: 'environment' 
    } 
});
Webcam.attach( '#vista_previa_camara' );

function tomar_foto(cod_info_factura_venta, cod_nota_observacion) {
    var pagina = "<?php echo $pagina ?>";
    Webcam.snap( function(data_uri) {
        document.getElementById('vista_imagen_tomada').innerHTML = '<img src="../imagenes/loader.gif"/>';
        Webcam.upload( data_uri, '../admin/guardar_soportes_info_factura_venta_siscredito_visitante_intern_webcam_ajax.php?cod_info_factura_venta='+cod_info_factura_venta+'&cod_nota_observacion='+cod_nota_observacion+'&pagina='+pagina, 
            function(code, respuesta) { 
                const vector_respuesta = respuesta.split("__");
                let afectado = vector_respuesta[0];
                let url_img_orig_producto = vector_respuesta[1];
                let cod_nota_observacion = vector_respuesta[2];
                let cod_info_factura_venta = vector_respuesta[3];
                let mensaje = vector_respuesta[4];
                let pagina = vector_respuesta[5];

                //let afectado = respuesta.afectado;
                //let url_img_orig_producto = respuesta.url_img_orig_producto;
                //let mensaje = respuesta.mensaje;
                document.getElementById('vista_imagen_tomada').innerHTML = '<input type="hidden" name="url_img_foto" value="'+url_img_orig_producto+'">' + '<img width="350" height="300" src="'+url_img_orig_producto+'"/>';

                if (afectado != 'NO') {
                    var url_guardar = '<a href=../admin/reg_cambiar_a_estado_por_revisar_soportes_info_factura_venta_siscredito_visitante_intern_webcam_reg.php?cod_nota_observacion='+cod_nota_observacion+'&cod_info_factura_venta='+cod_info_factura_venta+'&pagina='+pagina+' class="btn hvr-hover btn-lg btn-block">Guardar Foto</a>';
                    document.getElementById('url_guardar').innerHTML = url_guardar;
                    //document.getElementById("url_guardar").focus();
                    $("#foco").focus() 

                };
            } 
        ); 
    }); 
}
</script>