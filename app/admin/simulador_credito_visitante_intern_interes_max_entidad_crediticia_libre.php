<?php 
$nombre_pagina          = "Simulador de Credito";
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
$nombre_tipo_origen_simulacion     = "SIMULACION_VALOR_LIBRE";
$cod_categoria                     = 2;
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
                                    <th style="text-align:center;">Simulador de Credito</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="contact-form-right">
                        <form name="formulario_de_actualizacion" method="POST" autocomplete="off" action="../admin/simulador_credito_producto_visitante_intern_interes_max_entidad_crediticia_resultado_get.php">
                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">Escribe el valor del producto de contado *
                                        <input type="text" class="form-control" name="precio_venta_producto_formateado" id="precio_venta_producto_formateado" min='0' value="" placeholder="" required>
                                        <input type="hidden" name="precio_venta_producto" id="precio_venta_producto" min='0' value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">Escribe el nombre del producto *
                                        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div style="text-align:center;" class="">Categoria * <br>
                                        <select id="cod_categoria" name="cod_categoria" class="form-control" required>
                                            <?php if (isset($cod_categoria)) { echo ""; } else { echo ""; }
                                            $consulta2_sql = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE (cod_estado = '1')";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($cod_categoria) and $cod_categoria == $datos2['cod_categoria']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo           = $datos2['cod_categoria'];
                                            $nombre           = $datos2['nombre_categoria'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <!--<input type="number" class="form-control" name="valor_credito" id="valor_credito" value="<?php echo $precio_venta_producto_mas_comision_funcionamiento ?>" placeholder="" required>-->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit"><div id="nombre_boton_accion">Siguiente</div></button>
                                        <input type="hidden" name="nombre_tipo_origen_simulacion" value="<?php echo $nombre_tipo_origen_simulacion ?>">
                                        <input type="hidden" name="cod_producto_codifcryp" value="">
                                        <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
                                        <input type="hidden" name="insertar_datos" value="formulario">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

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