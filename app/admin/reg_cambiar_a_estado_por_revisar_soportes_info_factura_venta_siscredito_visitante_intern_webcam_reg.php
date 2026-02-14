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
if (isset($_GET['cod_nota_observacion'])) {
    $cod_info_factura_venta                             = intval($_GET['cod_info_factura_venta']);
    $cod_nota_observacion                               = intval($_GET['cod_nota_observacion']);
    $pagina                                             = addslashes($_GET['pagina']);
    $codigo_estado_revision                             = 1; //POR REVISAR

    $sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET codigo_estado_revision = '$codigo_estado_revision' WHERE (cod_nota_observacion = '$cod_nota_observacion')");
    $resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

    $url_redir = "lista_soportes_info_factura_venta_siscredito_visitante_intern.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_nota_observacion=".$cod_nota_observacion."&pagina=".$pagina;
?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $url_redir ?>">
<?php    
}
?>

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>
</html>


<script>
function obtener_datos_mostrar_imagen_modal(id){

    var cod_nota_observacion = $("#cod_nota_observacion"+id).val();
    var url_img_orig_producto = $("#url_img_orig_producto"+id).val();
    var codigo_estado_revision_actual = $("#codigo_estado_revision"+id).val();
    var nombre_nota_observacion_actual = $("#nombre_nota_observacion"+id).val();

    //$("#mod_"+"cod_nota_observacion").val(id);
    $("#mod_"+"url_img_orig_producto").html('<img class="w-100 mb-4" src="'+url_img_orig_producto+'" width="750px">');
    $("#mod_"+"codigo_estado_revision").html(codigo_estado_revision_actual);
    $("#codigo_estado_revision_actual").val(codigo_estado_revision_actual);
    $("#mod_"+"nombre_nota_observacion_actual").html(nombre_nota_observacion_actual);
    //console.log('<img src="'+url_img_orig_producto+'" width="500px">');
}
</script>