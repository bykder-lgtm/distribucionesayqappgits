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
if (isset($_REQUEST['cod_producto_codifcryp'])) { 
    $cod_producto_codifcryp            = ($_REQUEST['cod_producto_codifcryp']);
    $cod_producto_codif                = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
    $cod_producto                      = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));

    $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
    precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
    cod_categoria, cod_estado FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $datos_producto = mysqli_fetch_assoc($consulta_producto);

    $cod_producto_barra                = $datos_producto['cod_producto_barra'];
    $nombre_producto                   = $datos_producto['nombre_producto'];
    $und_producto                      = $datos_producto['und_producto'];
    $precio_venta_producto             = $datos_producto['precio_venta_producto'];
    $descripcion_producto              = $datos_producto['descripcion_producto'];
    $url_img_min_producto              = $datos_producto['url_img_min_producto'];
    $url_img_orig_producto             = $datos_producto['url_img_orig_producto'];
    if ($url_img_min_producto=='') { $url_img_min_producto = '../archivador/img_producto/orig/sin_imagen.jpg'; }
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_entidad_crediticia_predeterminada_interes_defect = "SELECT entidad_crediticia_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado_entidad_predeterminada_interes_defect = '1'";
    $consulta_entidad_crediticia_predeterminada_interes_defect = mysqli_query($conectar, $sql_entidad_crediticia_predeterminada_interes_defect) or die(mysqli_error($conectar));
    $matriz_entidad_crediticia_predeterminada_interes_defect = mysqli_fetch_assoc($consulta_entidad_crediticia_predeterminada_interes_defect);

    $entidad_crediticia_interes_ptj                               = $matriz_entidad_crediticia_predeterminada_interes_defect['entidad_crediticia_interes_ptj'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    if (isset($_REQUEST['valor_credito'])) { $valor_credito = addslashes($_REQUEST['valor_credito']); } else { $valor_credito = $precio_venta_producto; }
    if (isset($_REQUEST['cod_entidad_crediticia'])) { $cod_entidad_crediticia = addslashes($_REQUEST['cod_entidad_crediticia']); } else { $cod_entidad_crediticia = '0'; }
    if (isset($_REQUEST['cod_tipo_cobro'])) { $cod_tipo_cobro = addslashes($_REQUEST['cod_tipo_cobro']); } else { $cod_tipo_cobro = '4'; }
    if (isset($_REQUEST['cod_meses_credito'])) { $cod_meses_credito = addslashes($_REQUEST['cod_meses_credito']); } else { $cod_meses_credito = '1'; }

    $precio_venta_producto_mas_comision_funcionamiento            = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
    $valor_credito                                                = $precio_venta_producto_mas_comision_funcionamiento;

    $sql_tipo_cobro = "SELECT cod_tipo_cobro, nombre_tipo_cobro FROM tbl15_tipo_cobro WHERE (cod_tipo_cobro = '$cod_tipo_cobro')";
    $consulta_tipo_cobro = mysqli_query($conectar, $sql_tipo_cobro) or die(mysqli_error($conectar));
    $datos_tipo_cobro = mysqli_fetch_assoc($consulta_tipo_cobro);

    $nombre_tipo_cobro                           = $datos_tipo_cobro['nombre_tipo_cobro'];
    if ($nombre_tipo_cobro == 'MENSUAL') { $numero_tipo_cobro = 1; } else { $numero_tipo_cobro = 2; }

    $sql_meses_credito = "SELECT * FROM tbl15_meses_credito WHERE (cod_meses_credito = '$cod_meses_credito')";
    $consulta_meses_credito = mysqli_query($conectar, $sql_meses_credito) or die(mysqli_error($conectar));
    $datos_meses_credito = mysqli_fetch_assoc($consulta_meses_credito);

    $codigo_meses_credito                        = $datos_meses_credito['codigo_meses_credito'];
    $nombre_meses_credito                        = $datos_meses_credito['nombre_meses_credito'];

    if ($cod_entidad_crediticia == '0') { $condicion_entidad_crediticia = "WHERE (cod_estado = '1')"; } else { $condicion_entidad_crediticia = "WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia') AND (cod_estado = '1')"; }
    
    if ($cod_seguridad = '23') { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj                    = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj                       = 'aliado_estrategico_aval_ptj';
    } elseif ($cod_seguridad = '22') { //ASESOR
        $nombre_compo_interes_ptj                    = 'asesor_interes_ptj';
        $nombre_compo_aval_ptj                       = 'asesor_aval_ptj';
    } else { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj                    = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj                       = 'aliado_estrategico_aval_ptj';
    }
    //$cod_seguridad                               = '25'; //CLIENTE 
    //$nombre_tipo_tercero_text                    = ucfirst(strtolower('CLIENTE'));

    $sql_tipo_cobro = "SELECT aliado_estrategico_interes_ptj FROM tbl15_entidad_crediticia WHERE (cod_estado_entidad_predeterminada_interes_defect = '1')";
    $consulta_tipo_cobro = mysqli_query($conectar, $sql_tipo_cobro) or die(mysqli_error($conectar));
    $datos_tipo_cobro = mysqli_fetch_assoc($consulta_tipo_cobro);

    $aliado_estrategico_interes_ptj     = $datos_tipo_cobro['aliado_estrategico_interes_ptj'];
?>
<!-- Start Shop Page  -->
    <div class="shop-box-inner">

        <div class="container">
            <div class="col-12">
                <div class="single-product-details"><h2>Resultados Simulación del Credito</h2></div>
                <div class="single-product-details"><h2>Nombre del producto: <?php echo $nombre_producto ?></h2></div>
                <div class="single-product-details"><h2>Valor del Credito: $ <?php echo number_format($precio_venta_producto_mas_comision_funcionamiento, 0, ",", ".") ?></h2></div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">

                        <div class="row product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
            <?php
            $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia $condicion_entidad_crediticia ORDER BY cod_posicion ASC";
            $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
            while ($datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia)) {

                $cod_entidad_crediticia                        = $datos_entidad_crediticia['cod_entidad_crediticia'];
                $nombre_entidad_crediticia                     = $datos_entidad_crediticia['nombre_entidad_crediticia'];
                $meses_max_entidad_crediticia                  = $datos_entidad_crediticia['meses_max_entidad_crediticia'];
                $quicenal_max_entidad_crediticia               = $datos_entidad_crediticia['quicenal_max_entidad_crediticia'];
                $url_entidad_crediticia_imag_min               = $datos_entidad_crediticia['url_entidad_crediticia_imag_min'];
                $url_entidad_crediticia_imag_orig              = $datos_entidad_crediticia['url_entidad_crediticia_imag_orig'];

                if (($meses_max_entidad_crediticia <> '0' && $quicenal_max_entidad_crediticia == '0')) { //CUANDO SEA POR MES Y NO QUINCENAL
                    $nombre_tipo_cobro = 'MENSUAL';
                    $numero_tipo_cobro = 1;
                    $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
                    $condicional_mostrar_numero_maximo_cuotas = "AND (cod_meses_credito <= '$meses_max_entidad_crediticia')";
                    $condicional_cod_meses_credito = $numero_cuotas;
                    if ($numero_cuotas > $meses_max_entidad_crediticia) {
                        $numero_cuotas = $meses_max_entidad_crediticia  * $numero_tipo_cobro;
                    } else {
                        $numero_cuotas = $numero_cuotas;
                    }
                } elseif (($meses_max_entidad_crediticia == '0' && $quicenal_max_entidad_crediticia <> '0')) { //CUANDO NO SEA POR MES Y SI QUINCENAL
                    $nombre_tipo_cobro = 'QUINCENAL';
                    $numero_tipo_cobro = 2;
                    $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
                    $condicional_mostrar_numero_maximo_cuotas = "AND (cod_meses_credito <= '$quicenal_max_entidad_crediticia')";
                    $condicional_cod_meses_credito = $numero_cuotas;
                    if ($numero_cuotas > $quicenal_max_entidad_crediticia) {
                        $numero_cuotas = $quicenal_max_entidad_crediticia;
                    } else {
                        $numero_cuotas = $numero_cuotas;
                    }
                } else { //CUANDO SEA POR MES Y QUINCENAL O NINGUNO DE LOS DOS (TIENE PRIORIDAD EL MES)
                    $nombre_tipo_cobro = 'MENSUAL';
                    $numero_tipo_cobro = 1;
                    $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
                    $condicional_mostrar_numero_maximo_cuotas = "AND (cod_meses_credito <= '$meses_max_entidad_crediticia')";
                    $condicional_cod_meses_credito = $numero_cuotas;
                }

                //$interes_ptj                                   = $aliado_estrategico_interes_ptj;
                $interes_ptj                                   = $datos_entidad_crediticia[$nombre_compo_interes_ptj];
                $aval_ptj                                      = $datos_entidad_crediticia[$nombre_compo_aval_ptj];
                $total_pagar                                   = round($precio_venta_producto / ((100/100) - ($interes_ptj / 100)), -3);
                $total_interes                                 = $total_pagar - $precio_venta_producto;
                //$total_interes                                 = $valor_credito * ($interes_ptj / 100);
                //$total_pagar                                   = $valor_credito + $total_interes;
                $cuota_credito                                 = $total_pagar / $numero_cuotas;
                $calculo_diferencia_de_precios                 = $precio_venta_producto_mas_comision_funcionamiento - $total_pagar;
                $calculo_descuento_respecto_al_mayor           = round((($calculo_diferencia_de_precios / $precio_venta_producto_mas_comision_funcionamiento) * 100), 2);

            ?>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" style="text-align:center;">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <img src="<?php echo $url_entidad_crediticia_imag_orig ?>" class="img-thumbnail" alt="Image">
                                                </div>
                                                <div class="why-text">
                                                    <form name="formulario_insersion" method="GET" action="../admin/reg_siscredito_tercero_cliente_simulador_por_cuotas.php">
                                                    <h4>
                                                        <span>
                                                        Valor del credito: $<?php echo number_format($total_pagar, 0, ",", ".") ?>
                                                        </span>
                                                    </h4>
                                                    <span><strong>Cuotas:</strong>
                                                        <select style="width: 70px;" name="cod_meses_credito" id="<?php echo $cod_entidad_crediticia ?>" data="<?php echo $nombre_tipo_cobro ?>" valorcredito="<?php echo $valor_credito ?>" class="form-control-sm" required>
                                                            <?php if (isset($condicional_cod_meses_credito)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
                                                            $consulta2_sql = "SELECT cod_meses_credito, nombre_meses_credito FROM tbl15_meses_credito WHERE (cod_estado = '1')  $condicional_mostrar_numero_maximo_cuotas ORDER BY cod_meses_credito ASC";
                                                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                            if(isset($condicional_cod_meses_credito) AND $condicional_cod_meses_credito == $datos2['cod_meses_credito']) {
                                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                            $codigo = $datos2['cod_meses_credito'];
                                                            $nombre = $datos2['nombre_meses_credito'];
                                                            echo "<option value='".$codigo."' $seleccionado >".$codigo."</option>"; } ?>
                                                        </select>
                                                        </span>
                                                    <h4>
                                                        <span id="cod_entidad_crediticia<?php echo $cod_entidad_crediticia ?>">
                                                        Valor aproximado cuota <?php echo strtolower($nombre_tipo_cobro) ?>: $<?php echo number_format($cuota_credito, 0, ",", ".") ?>
                                                        </span>
                                                    </h4>
                                                        Descuento del <?php echo $calculo_descuento_respecto_al_mayor ?>%
                                                        <br>
                                                        <input type="hidden" name="cod_producto_codifcryp" value="<?php echo $cod_producto_codifcryp ?>" />
                                                        <input type="hidden" name="cod_entidad_crediticia" value="<?php echo $cod_entidad_crediticia ?>" />
                                                        <input type="hidden" name="cod_seguridad" value="<?php echo $cod_seguridad ?>" />
                                                        <input type="hidden" name="valor_credito" value="<?php echo $valor_credito ?>" />
                                                        <input type="hidden" name="cod_tipo_cobro" value="<?php echo $cod_tipo_cobro ?>" />
                                                        <input type="hidden" name="total_pagar" value="<?php echo $total_pagar ?>" />
                                                        <input type="hidden" name="cuota_credito" value="<?php echo $cuota_credito ?>" />
                                                        <input type="hidden" name="numero_cuotas" value="<?php echo $numero_cuotas ?>" />
                                                        <input type="hidden" name="nombre_tipo_cobro" value="<?php echo $nombre_tipo_cobro ?>" />
                                                        <button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit">Solicita tu crédito</button>
                                                        <!--
                                                        <a class="btn hvr-hover btn-lg btn-block" href="../admin/reg_siscredito_tercero_cliente_simulador_por_cuotas.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>&cod_seguridad=<?php echo $cod_seguridad ?>&valor_credito=<?php echo $valor_credito ?>&cod_entidad_crediticia=<?php echo $cod_entidad_crediticia ?>&cod_tipo_cobro=<?php echo $cod_tipo_cobro ?>&cod_meses_credito=<?php echo $cod_meses_credito ?>&total_pagar=<?php echo $total_pagar ?>&cuota_credito=<?php echo $cuota_credito ?>&numero_cuotas=<?php echo $numero_cuotas ?>&nombre_tipo_cobro=<?php echo $nombre_tipo_cobro ?>">Solicita tu crédito</a>
                                                        -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
<?php } ?>

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>

<script language="javascript">
$(document).ready(function(){
    $('select[name="cod_meses_credito"]').change(function(){ 
    //$("input").on('change', function () {
        var numero_cuotas = $(this).val();
        var cod_entidad_crediticia = $(this).attr("id");
        var nombre_tipo_cobro = $(this).attr("data");
        var valor_credito = $(this).attr("valorcredito");
        //var campo = $(this).attr("name");
        var campo = "cod_entidad_crediticia";
        var tipo_ajax = "tbl15_entidad_crediticia";
        var cod_producto_codifcryp = "<?php echo $cod_producto_codifcryp; ?>";
        var pagina = "<?php echo $pagina_local; ?>";

        console.log("numero_cuotas = "+ numero_cuotas);
        console.log("cod_entidad_crediticia = "+ cod_entidad_crediticia);
        console.log("nombre_tipo_cobro = "+ nombre_tipo_cobro);
        console.log("valor_credito = "+ valor_credito);

        var datos_url_ajax = 'cod_entidad_crediticia='+cod_entidad_crediticia+'&'+'valor_credito='+valor_credito+'&'+'numero_cuotas='+numero_cuotas+'&'+'nombre_tipo_cobro='+nombre_tipo_cobro+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_producto_codifcryp='+cod_producto_codifcryp+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/calcular_valor_cuota_simulador_credito_producto_visitante_intern_interes_funcionamiento_resultado_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#'+campo+''+cod_entidad_crediticia).html('<img src="../imagenes/loading.gif">');
            },
            success:function(respuesta){
                var mensaje_cuota_credito = respuesta.mensaje_cuota_credito;
                var total_pagar = respuesta.total_pagar;
                var cuota_credito = respuesta.cuota_credito;
                var numero_cuotas = respuesta.numero_cuotas;
                var mensaje = respuesta.mensaje;
                $('#'+campo+''+cod_entidad_crediticia).html(mensaje_cuota_credito);
            }
        });
    });
});
</script>