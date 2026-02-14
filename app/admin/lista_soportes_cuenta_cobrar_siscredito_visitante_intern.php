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
$cod_tercero                                          = intval($_GET['cod_tercero']);
$cod_cuentas_cobrar                                   = intval($_GET['cod_cuentas_cobrar']);

$pagina                                               = addslashes($_GET['pagina']);
$pagina_redirect                                      = $pagina.'?cod_tercero='.$cod_tercero.'&pagina='.$pagina;

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

$datos_cuentas_cobrar = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_cuentas_cobrar = mysqli_query($conectar, $datos_cuentas_cobrar);
$data_cuentas_cobrar = mysqli_fetch_assoc($consulta_cuentas_cobrar);

$cod_producto_barra                                   = $data_cuentas_cobrar['cod_producto_barra'];
$nombre_producto                                      = $data_cuentas_cobrar['nombre_producto'];
$cod_entidad_crediticia                               = $data_cuentas_cobrar['cod_entidad_crediticia'];
$monto_deuda                                          = $data_cuentas_cobrar['monto_deuda'];

$datos_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
$consulta_entidad_crediticia = mysqli_query($conectar, $datos_entidad_crediticia);
$data_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

$nombre_entidad_crediticia                            = $data_entidad_crediticia['nombre_entidad_crediticia'];

$tab                                                  = 'tbl15_nota_observacion';
$campo                                                = 'cod_nota_observacion';
$tipo                                                 = 'eliminar';

$fecha_impr                                           = date("Ymd");
$hora_impr                                            = date("His");
if ($cod_seguridad == '1') { $condicion_vendedor = ''; } else { $condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador; }
?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="contact-form-right">
                        <div class="row p-3 mb-2 bg-primary text-white">
                            <div class="col-md-12">
                                <div style="text-align:center;" class=""><?php echo $nombre_cliente ?> | <?php echo $nombre_entidad_crediticia ?> | <?php echo $nombre_producto ?> | <?php echo number_format($monto_deuda, 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-lg-12">
                <div class="table-main">
                    <div class="mb-2">
                        <div class="col-12 d-flex shopping-box"><a href="../admin/reg_soportes_cuenta_cobrar_cliente_siscredito_visitante_intern.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&pagina=<?php echo $pagina_local ?>" class="ml-auto btn hvr-hover">Registrar Nuevo Soporte</a> </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once("../admin/modal_previsualizar_imagen_soporte_aliado_estrategico.php"); ?>

    <!-- Start Cart -->
        <div id="salida_info_actualizada_carrito_compra_ajax">
            <div id="eliminar_ok" style="display:none;">&nbsp;</div>
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="contact-form-right">
                            <div class="row p-3 mb-2 bg-primary text-white">
                                <div class="col-md-4">
                                    <div style="text-align:center;" class="">Observacion</div>
                                </div>
                            <!--
                                <div class="col-md-2">
                                    <div style="text-align:center;" class="">Tipo</div>
                                </div>
                            -->
                                <div class="col-md-2">
                                    <div style="text-align:center;" class="">Fecha | Hora</div>
                                </div>
                                <div class="col-md-2">
                                    <div style="text-align:center;" class="">Usuario</div>
                                </div>
                                <div class="col-md-2">
                                    <div style="text-align:center;" class="">Estado</div>
                                </div>
                                <div class="col-md-2">
                                    <div style="text-align:center;" class="">ID</div>
                                </div>
                            </div>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') ORDER BY cod_nota_observacion DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

    $cod_nota_observacion                           = $matriz_consulta['cod_nota_observacion'];
    $nombre_nota_observacion                        = $matriz_consulta['nombre_nota_observacion'];
    $fecha_ymd                                      = $matriz_consulta['fecha_ymd'];
    $fecha_hora                                     = $matriz_consulta['fecha_hora'];
    $cuenta                                         = $matriz_consulta['cuenta'];
    $cod_tipo_nota_observacion                      = $matriz_consulta['cod_tipo_nota_observacion'];
    $cod_info_factura_venta                         = $matriz_consulta['cod_info_factura_venta'];
    $cod_info_factura_compra                        = $matriz_consulta['cod_info_factura_compra'];
    $cod_info_cotizacion_factura_compra             = $matriz_consulta['cod_info_cotizacion_factura_compra'];
    $cod_info_cotizacion_factura_venta              = $matriz_consulta['cod_info_cotizacion_factura_venta'];
    $cod_info_factura_auditoria                     = $matriz_consulta['cod_info_factura_auditoria'];
    $cod_info_factura_transferencia                 = $matriz_consulta['cod_info_factura_transferencia'];
    $cod_info_factura_transferencia_bodega_entrada  = $matriz_consulta['cod_info_factura_transferencia_bodega_entrada'];
    $cod_info_factura_transferencia_bodega          = $matriz_consulta['cod_info_factura_transferencia_bodega'];
    $cod_movimiento_contable                        = $matriz_consulta['cod_movimiento_contable'];
    $cod_egreso                                     = $matriz_consulta['cod_egreso'];
    $url_img_orig_producto                          = $matriz_consulta['url_img_orig_producto'];
    $url_img_min_producto                           = $matriz_consulta['url_img_min_producto'];
    $cod_posicion                                   = $matriz_consulta['cod_posicion'];
    $active                                         = $matriz_consulta['active'];
    $codigo_estado_revision                         = $matriz_consulta['codigo_estado_revision'];

    if ($active == 1) { $url_img_active = "../imagenes/active.png"; } else { $url_img_active = "../imagenes/inactive.png"; }

    if (($cod_tipo_nota_observacion == 0) && ($url_img_orig_producto <> '')) { //NOTAS Y OBSERVACIONES
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_nota_observacion='.$cod_nota_observacion;
    } elseif (($cod_tipo_nota_observacion == 1) && ($url_img_orig_producto <> '')) { //SOPORTES FACTURA DE VENTA
        $url_redirect_recurso = '../admin/edit_factura_venta.php'.'?cod_info_factura_venta='.$cod_info_factura_venta;
    } elseif (($cod_tipo_nota_observacion == 2) && ($url_img_orig_producto <> '')) { //SOPORTES FACTURA DE COMPRA
        $url_redirect_recurso = '../admin/ver_factura_compra.php'.'?cod_info_factura_compra='.$cod_info_factura_compra;
    } elseif (($cod_tipo_nota_observacion == 3) && ($url_img_orig_producto <> '')) { //SOPORTES COTIZACIONES DE COMPRA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_cotizacion_factura_compra='.$cod_info_cotizacion_factura_compra;
    } elseif (($cod_tipo_nota_observacion == 4) && ($url_img_orig_producto <> '')) { //SOPORTES COTIZACIONES DE VENTA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_cotizacion_factura_venta='.$cod_info_cotizacion_factura_venta;
    } elseif (($cod_tipo_nota_observacion == 5) && ($url_img_orig_producto <> '')) { //SOPORTES AUDITORIA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_auditoria='.$cod_info_factura_auditoria;
    } elseif (($cod_tipo_nota_observacion == 6) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIAS
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia='.$cod_info_factura_transferencia;
    } elseif (($cod_tipo_nota_observacion == 7) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIA ENTRADA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia_bodega_entrada='.$cod_info_factura_transferencia_bodega_entrada;
    } elseif (($cod_tipo_nota_observacion == 8) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIA SALIDA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia_bodega='.$cod_info_factura_transferencia_bodega;
    } elseif (($cod_tipo_nota_observacion == 9) && ($url_img_orig_producto <> '')) { //SOPORTES MOVIMIENTOS CONTABLES
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_movimiento_contable='.$cod_movimiento_contable;
    } elseif (($cod_tipo_nota_observacion == 10) && ($url_img_orig_producto <> '')) { //SOPORTES EGRESOS
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_egreso='.$cod_egreso;
    } else {
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?aaaaaa=';
    }

    $sql_tipo_nota_observacion = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '$cod_tipo_nota_observacion')";
    $consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
    $datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

    $nombre_tipo_nota_observacion                   = $datos_tipo_nota_observacion['nombre_tipo_nota_observacion'];

    $sql_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
    $consulta_estado_revision = mysqli_query($conectar, $sql_estado_revision);
    $datos_estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

    $nombre_estado_revision                         = $datos_estado_revision['nombre_estado_revision'];


    if ($codigo_estado_revision == '0') { // 0 POR CARGAR
        $previsualizar_soporte = '';
        $url_estado_soporte = '<a href="../admin/soporte_por_cargar_cliente_siscredito_visitante_intern.php?cod_nota_observacion='.$cod_nota_observacion.'&cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina.'">'.$nombre_estado_revision.'</a>';
    } 
    elseif ($codigo_estado_revision == '1') { // 1 POR REVISAR
        $previsualizar_soporte = '<a href="#" onclick="obtener_datos_mostrar_imagen_modal('.$cod_nota_observacion.');" data-toggle="modal" data-target=".abrir_previsualizacion_imagen"><img src="../imagenes/pdf_peq.png" class="img-polaroid"></a>';
        $url_estado_soporte = '<a href="../admin/soporte_por_revisar_cliente_siscredito_visitante_intern.php?cod_nota_observacion='.$cod_nota_observacion.'&cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina.'">'.$nombre_estado_revision.'</a>';
    } 
    elseif ($codigo_estado_revision == '2') { // 2 ACEPTADO
        $previsualizar_soporte = '<a href="#" onclick="obtener_datos_mostrar_imagen_modal('.$cod_nota_observacion.');" data-toggle="modal" data-target=".abrir_previsualizacion_imagen"><img src="../imagenes/pdf_peq.png" class="img-polaroid"></a>';
        $url_estado_soporte = '<a href="#">'.$nombre_estado_revision.'</a>';
    }
    else { // 3 RECHAZADO
        $previsualizar_soporte = '<a href="#" onclick="obtener_datos_mostrar_imagen_modal('.$cod_nota_observacion.');" data-toggle="modal" data-target=".abrir_previsualizacion_imagen"><img src="../imagenes/pdf_peq.png" class="img-polaroid"></a>';
        $url_estado_soporte = '<a href="../admin/soporte_rechazado_cliente_siscredito_visitante_intern.php?cod_nota_observacion='.$cod_nota_observacion.'&cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina.'">'.$nombre_estado_revision.'</a>';
    }
?>
<input type='hidden' value='<?php echo $cod_nota_observacion;?>' id='cod_nota_observacion<?php echo $cod_nota_observacion;?>'>
<input type='hidden' value='<?php echo $url_img_orig_producto;?>' id='url_img_orig_producto<?php echo $cod_nota_observacion;?>'>
<input type='hidden' value='<?php echo $codigo_estado_revision;?>' id='codigo_estado_revision<?php echo $cod_nota_observacion;?>'>
<input type='hidden' value='<?php echo $nombre_nota_observacion;?>' id='nombre_nota_observacion<?php echo $cod_nota_observacion;?>'>

                            <div class="row">
                                <div class="col-md-4">
                                    <div style="text-align:center;" class=""><?php echo $nombre_nota_observacion ?></div>
                                </div>
                            <!--
                                <div class="col-md-2">
                                    <div style="text-align:center;" class=""><?php echo $nombre_tipo_nota_observacion ?></div>
                                </div>
                            -->
                                <div class="col-md-2">
                                    <div style="text-align:center;" class=""><?php echo $fecha_ymd ?> | <?php echo $fecha_hora ?></div>
                                </div>
                                <div class="col-md-2">
                                    <div style="text-align:center;" class=""><?php echo $cuenta ?></div>
                                </div>
                                <div class="col-md-2">
                                    <div style="text-align:center;" class=""><?php echo $url_estado_soporte.$previsualizar_soporte ?></div>
                                </div>
                                <div class="col-md-2">
                                    <div style="text-align:center;" class=""><?php echo $cod_nota_observacion ?></div>
                                </div>
                            </div>
                            <hr>
    <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->


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