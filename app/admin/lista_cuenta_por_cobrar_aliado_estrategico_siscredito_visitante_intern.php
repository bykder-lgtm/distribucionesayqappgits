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
    <!-- Start Cart  -->
<?php 
$cod_seguridad                               = '25'; //CLIENTE 
$nombre_tipo_tercero_text                    = ucfirst(strtolower('CLIENTE'));
$buscar_por                                  = "nombre1_tercero_identificacion_tercero";
?>
    <!-- Start Cart -->
    <div class="contact-box-main">
        <div class="container">
            <div class="col-lg-12">
                <div class="table-main">
                    <div class="mb-2">

                        <div class="col-12 d-flex shopping-box">
                            <select class="form-control" id="numero_registro_por_pagina" onchange='load(1);' style="width: 80px;">
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                                <option value="500">500</option>
                                <option value="800">800</option>
                                <option value="1000">1000</option>
                                <option value="2000">2000</option>
                                <option value="10000">10000</option>
                                <option value="100000">100000</option>
                            </select>
                            <select class="form-control" name="buscar_por" id="buscar_por" onchange="load(1)" style="width: 180px;">
                                <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
                                $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '6' AND cod_estado = '1') ORDER BY cod_buscar_por ASC");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['nombre_buscar_por'];
                                $nombre = $datos2['titulo_buscar_por'];
                                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                            </select>
                            <input type="text" class="form-control" id="busqueda_ajax" style="width: 200px; height:40px;" placeholder="Buscar Registro" onkeyup='load(1);'><span id="loader"></span>
                            <a href="../admin/reg_siscredito_tercero_cliente_simulador.php?cod_producto_codifcryp=0&cod_seguridad=<?php echo $cod_seguridad ?>&valor_credito=0&cod_entidad_crediticia=0&cod_tipo_cobro=0&cod_meses_credito=0" class="ml-auto btn hvr-hover">Registrar Nueva Cuenta Por Cobrar</a> 
                            <input type="hidden" id="cod_administrador" Value="<?php echo $cod_administrador ?>">
                            <input type="hidden" id="cod_seguridad" Value="<?php echo $cod_seguridad ?>">
                            <input type="hidden" id="tabla" Value="tbl15_tercero">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="outer_div"></div>

    </div>
    <!-- End Cart -->

</body>

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</html>

<script>
$(document).ready(function(){
    load(1);
});

function load(page){
    var busqueda_ajax = $("#busqueda_ajax").val();
    var buscar_por = $("#buscar_por").val();
    var numero_registro_por_pagina = $("#numero_registro_por_pagina").val();
    var cod_administrador = $("#cod_administrador").val();
    var cod_seguridad = $("#cod_seguridad").val();
    var tabla = $("#tabla").val();

    $("#loader").fadeIn('slow');
    $.ajax({
        url:'../admin/busqueda_paginacion_cuenta_por_cobrar_aliado_estrategico_siscredito_visitante_intern_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla, 
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $("#outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}
</script>